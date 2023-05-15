#!/bin/sh

## preparing to cs-fixer v3
./vendor/bin/php-cs-fixer fix \
    --config=./resources/rules/php-cs-fixer.php \
    --dry-run --stop-on-violation &&

exit $?
