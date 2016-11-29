#!/bin/bash
echo "my script Installing Composer"
COMPOSER_CMD=$(which composer)
$COMPOSER_CMD instal
php bin/console cache:warmup
# $COMPOSER_CMD update
echo "create file less7_test.json use sys_get_temp_dir()"
php -r 'tempnam(sys_get_temp_dir(),"less7_test.json");'
echo "add to file data use sys_get_temp_dir().'less7_test.json','{\"0\":\"ewewe\",\"1\":\"yyyyu\",\"2\":\"fdfdf\"}'"
php -r 'file_put_contents(sys_get_temp_dir()."/less7_test.json","{\"0\":\"ewewe\",\"1\":\"yyyyu\",\"2\":\"fdfdf\"}");'
