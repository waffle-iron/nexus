#!/usr/bin/env bash
#http://stackoverflow.com/questions/12768907/bash-output-tables
ROOT=".";
TOTAL=$(find $ROOT -type f | wc -l);

for dir in $(ls -A $ROOT);
do
    COUNT=$(find $ROOT/$dir -type f | wc -l)
    echo $dir " :" $COUNT;
done;

echo "Total files: " $TOTAL;

echo "Remember Google App Engine only allows 10,000 files to be uploaded";
appcfg.py resource_limits_info .