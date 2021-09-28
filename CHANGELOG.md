# USE CHANGELOG_JS AND CHANGELOG_PHP, please

# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed
- Added eslint rules and tsconfig rule. []() 

## [2.0.0] - 2019-12-25

### Added
- Add tslint-config-prettier

### Changed
- Fix ts-lint rules to work with prettier

## [1.2.0] - 2019-12-25

### Changed 
- New version of PHPSTAN.
- New version of PHP Mess Detector. 
- New version of PHPUnit.
- Maybe you need add this
```
    ignoreErrors:
        ## phpstan 0.11 to 0.12
        - '#has no typehint specified\.$#'
        - '#has no return typehint specified\.$#'
        - '#with no typehint specified\.$#'
        - '#with no value type specified in iterable#'
        - '#has no value type specified in iterable#'
```

## Removed
- Remove `\NunoMaduro\Larastan\LarastanServiceProvider::class`.

## [1.1.3] - 2019-12-25

### Changed
- PHP CS FIXER phpdoc_to_comment rule disabled.

## [1.1.2] - 2019-12-25

### Fixed
- Removed PHP CS FIXER rules contained on presets.

### Changed 
- PHP CS FIXER rule single_line_throw disabled. 
