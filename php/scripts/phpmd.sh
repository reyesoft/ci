#!/bin/sh

./vendor/bin/php-cs-fixer fix \
    --config=./resources/rules/php-cs-fixer.dist.php \
    --dry-run --stop-on-violation &&

exit $?
