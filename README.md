# reyesoft/ci

```bash
yarn add --dev reyesoft-ci
composer require-dev reyesoft/ci
```

## Backend

### Tools

* cs-fixer

### Install

`composer.json`

```json
{
    "scripts": {
        "ci-double-spaces": [
            "sh vendor/reyesoft/ci/tools/find-double-spaces.sh app",
            "sh vendor/reyesoft/ci/tools/find-double-spaces.sh tests"
        ],
        "ci-php-cs-fixer": "sh vendor/reyesoft/ci/php/scripts/php-cs-fixer.sh",
        "phpstan": [
            "@phpstan-src",
            "@phpstan-tests"
        ],
        "phpstan-src": "./vendor/bin/phpstan analyse -l 7 -c resources/rules/phpstan.src.neon app ./bootstrap/*.php config",
        "phpstan-tests": "./vendor/bin/phpstan analyse -l 7 -c resources/rules/phpstan.tests.neon tests",
        "coverage": [
            "ulimit -Sn 50000 && phpdbg -d memory_limit=-1 -qrr ./vendor/bin/phpunit",
            "php ./vendor/reyesoft/ci/tools/coverage-checker.php"
        ]
    },
    "extra": {
        "coverage": {
            "file": "./bootstrap/cache/clover.xml",
            "thresholds": {
                "global": {
                    "lines": 46
                },
                "/app/Boxer": {
                    "lines": 78
                }
            }
        }
    }
}
```

## Front End

### Tools

* tslint
* sass-lint
* prettier (ts, md and json files)

## Install
### NX with Angular

`package.json`
#### Yarn

```json
{
    "sasslintConfig": "resources/.sass-lint.yml",
    "scripts": {
        "lint": "yarn affected:lint && yarn lint:style",
        "lint:style": "yarn stylelint \"apps/*/**/*.{css,scss,sass}\"",
        "fix": "yarn affected:lint --fix && yarn prettier:fix && yarn lint:style --fix",
        "prettier:fix": "prettier apps/*/**/*.{ts,sass,scss,md} libs/*/**/*.{ts,sass,scss,md} --write",
        "prettier:check": "bash node_modules/reyesoft-ci/parallel.bash -s \"yarn prettier apps/**/*.{sass,scss,md} libs/**/*.{sass,scss,md} -l\" \"yarn prettier apps/*/src/**/*.ts libs/**/*.ts -l\"",
        "precommit": "lint-staged",
    },
    "lint-staged": {
        "*.ts": [
            "yarn eslint --fix",
            "git add"
        ],
        "*.{ts,md,scss,sass}": [
            "yarn prettier:fix",
            "git add"
        ],
        "package.json": [
            "node ./node_modules/reyesoft-ci/js/scripts/yarn-install.js",
            "git add yarn.lock"
        ]
    }
}
```

#### Npm

```json
{
    "sasslintConfig": "resources/.sass-lint.yml",
    "scripts": {
        "lint": "npm run affected:lint && npm run lint:style",
        "lint:style": "npm run stylelint \"apps/*/**/*.{css,scss,sass}\"",
        "fix": "npm run affected:lint --fix && npm run prettier:fix && npm run lint:style --fix",
        "prettier:fix": "prettier apps/*/**/*.{ts,sass,scss,md} libs/*/**/*.{ts,sass,scss,md} --write",
        "prettier:check": "bash node_modules/reyesoft-ci/parallel.bash -s \"npm run prettier apps/**/*.{sass,scss,md} libs/**/*.{sass,scss,md} -l\" \"npm run prettier apps/*/src/**/*.ts libs/**/*.ts -l\"",
        "precommit": "lint-staged",
    },
    "lint-staged": {
        "*.ts": [
            "npm run eslint --fix",
            "git add"
        ],
        "*.{ts,md,scss,sass}": [
            "npm run prettier:fix",
            "git add"
        ]
    }
}
```
### Only Angular

#### Yarn
```json
{
    "sasslintConfig": "resources/.sass-lint.yml",
    "scripts": {
        "lint": "yarn lint && yarn lint:style",
        "lint:style": "yarn stylelint \**/*.{css,scss,sass}\"",
        "fix": "yarn affected:lint --fix && yarn prettier:fix && yarn lint:style --fix",
        "prettier:fix": "prettier **/*.{ts,sass,scss,md} --write",
        "prettier:check": "bash node_modules/reyesoft-ci/parallel.bash -s \"yarn prettier **/*.{sass,scss,md} -l\" \"yarn prettier **/*.ts -l\"",
        "precommit": "lint-staged",
    },
    "lint-staged": {
        "*.ts": [
            "yarn eslint --fix",
            "git add"
        ],
        "*.{ts,md,scss,sass}": [
            "yarn prettier:fix",
            "git add"
        ],
        "package.json": [
            "node ./node_modules/reyesoft-ci/js/scripts/yarn-install.js",
            "git add yarn.lock"
        ]
    }
}
```

#### Npm

```json
{
    "sasslintConfig": "resources/.sass-lint.yml",
    "scripts": {
        "lint": "npm run lint && npm run lint:style",
        "lint:style": "npm run stylelint \**/*.{css,scss,sass}\"",
        "fix": "npm run affected:lint --fix && npm run prettier:fix && npm run lint:style --fix",
        "prettier:fix": "prettier **/*.{ts,sass,scss,md} --write",
        "prettier:check": "bash node_modules/reyesoft-ci/parallel.bash -s \"yarn prettier **/*.{sass,scss,md} -l\" \"yarn prettier **/*.ts -l\"",
        "precommit": "lint-staged",
    },
    "lint-staged": {
        "*.ts": [
            "npm run eslint --fix",
            "git add"
        ],
        "*.{ts,md,scss,sass}": [
            "npm run prettier:fix",
            "git add"
        ]
    }
}
```

`yarn fix` for various projects: `ng lint project1 --fix && ng lint project2 --fix && yarn prettier:fix`
