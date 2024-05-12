#!/bin/sh

echo "php-cs-fixer..." &&
./vendor/bin/php-cs-fixer fix \
    --config=resources/rules/php-cs-fixer.php \
    --allow-risky=yes

## php cs fixer fix this problem automatically
# echo "double spaces..." &&
# sh vendor/reyesoft/ci/tools/find-double-spaces.sh app/
# sh vendor/reyesoft/ci/tools/find-double-spaces.sh tests/

echo "documentor:generate..." &&
php artisan documentor:generate --silent

echo

git status -s 2> /dev/null

echo -e "\n 💡  Don't forget to run \n    composer ci \n"
