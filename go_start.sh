#!/bin/bash
echo "Installing Composer"
COMPOSER_CMD=$(which composer)
$COMPOSER_CMD instal
php bin/console cache:warmup
# $COMPOSER_CMD update
#$COMPOSER_CMD dumpautoload -o