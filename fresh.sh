#!/usr/bin/env bash
rm -rf ./vendor/*;
rm -rf ./node_modules//*
npm install;
composer install;
bower install;
