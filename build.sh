#!/usr/bin/env bash
gulp;
rm -rf ./app/cache;
composer clear-cache;
composer dump-autoload;
php app/console cache:clear;
php app/console assets:install web --symlink;
say "Build Complete" -v "Victoria" -r 220;