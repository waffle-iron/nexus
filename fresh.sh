#!/usr/bin/env bash
echo "Emptying ./vendor";
rm -rf ./vendor/*;

echo "Emptying ./node_modules";
rm -rf ./node_modules/*;

echo "Emptying ./bower_components";
rm -rf ./bower_components/*;

echo "Reinstalling node packages";
npm install;

echo "Reinstalling composer packages";
composer install;

echo "Reinstalling bower packages";
bower install;
