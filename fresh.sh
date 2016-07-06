#!/usr/bin/env bash

echo "Emptying ./vendor";
rm -rf ./vendor/*;

echo "Clearing Composer Cache";
composer clear-cache

echo "Emptying ./node_modules";
rm -rf ./node_modules/*;

echo "Emptying ./bower_components";
rm -rf ./bower_components/*;

echo "Reinstalling node packages";
npm install;

echo "Reinstalling composer packages";
composer install;

echo "Generating Composer Autoload files";
composer dump-autoload;

echo "Reinstalling bower packages";
bower install;

echo "Clearing Symfony's Cache...";
app/console cache:clear;

echo "Warming up Symfony's Cache...";
app/console cache:warmup;

echo "Installing Assetic Assets";
app/console assets:install web --symlink;
