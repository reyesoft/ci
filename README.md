# reyesoft/ci

```bash
yarn add --dev reyesoft-ci
composer requiere-dev reyesoft/ci
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
        "lint": "sass-lint -c -q",
        "prettier": "yarn prettier-ts && yarn prettier-md && yarn prettier-scss",
        "prettier-ts": "yarn prettier-ts:show --write",
        "prettier-ts:show": "prettier --single-quote true \"src/**/*.ts\"",
        "prettier-json": "yarn prettier-json:show --write",
        "prettier-json:show": "prettier --parser json --single-quote es5 \"**/*.json\"",
        "prettier-md": "yarn prettier-md:show --write",
        "prettier-md:show": "prettier --parser markdown \"**/*.md\"",
        "prettier-scss": "yarn prettier-scss:show --write",
        "prettier-scss:show": "prettier --parser scss --single-quote es5 \"**/*.scss\"",
        "precommit": "lint-staged",
    },
    "lint-staged": {
        "*.ts": [
            "yarn prettier-ts",
            "yarn lint --fix",
            "git add"
        ],
        "*.md": [
            "yarn prettier-md",
            "git add"
        ],
        "*.scss": [
            "yarn prettier-scss",
            "git add"
        ],
        "package.json": [
            "node ./node_modules/reyesoft-ci/js/scripts/yarn-install.js",
            "git add yarn.lock"
        ]
    }
}
```
