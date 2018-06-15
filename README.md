# reyesoft/ci

```bash
yarn add --dev reyesoft-ci
composer requiere-dev reyesoft/ci
```

## Backend

### Tools

* cs-fixer

### Install

`composer.json`

```json
{
    "scripts": {
        "ci-php-cs-fixer": "sh vendor/reyesoft/ci/php/scripts/php-cs-fixer.sh",
    }
}
```

## Front End

### Tools

* tslint
* sass-lint
* prettier (ts, md and json files)

### Install

`package.json`

```json
{
    "sasslintConfig": "resources/.sass-lint.yml",
    "scripts": {
        "lint": "ng lint && sass-lint -c -q",
        "fix": "ng lint --fix && yarn prettier:fix",
        "prettier:fix": "prettier **/*.{ts,sass,scss,md} --write",
        "prettier:check": "bash node_modules/reyesoft-ci/parallel.bash -s \"yarn prettier **/*.{sass,scss,md} -l\" \"yarn prettier **/*.ts -l\"",
        "precommit": "lint-staged",
    },
    "lint-staged": {
        "*.ts": [
            "yarn tslint --fix",
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

`yarn fix` for various projects: `ng lint project1 --fix && ng lint project2 --fix && yarn prettier:fix`
