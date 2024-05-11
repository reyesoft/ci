#!/bin/sh

./vendor/bin/php-cs-fixer fix \
    --config=./resources/rules/php-cs-fixer.php \
    --allow-risky=yes \
    --dry-run \
    --stop-on-violation &&

exit $?
