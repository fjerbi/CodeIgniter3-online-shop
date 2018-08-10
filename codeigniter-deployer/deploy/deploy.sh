#!/bin/bash

## Part of CodeIgniter Deployer
##
## @author     Kenji Suzuki <https://github.com/kenjis>
## @license    MIT License
## @copyright  2015 Kenji Suzuki
## @link       https://github.com/kenjis/codeigniter-deployer

cd `dirname $0`

date=`date +"%Y%m%d%H%M%S"`
log="logs/production-$date.log"
php ../vendor/bin/dep deploy -vvv --ansi production 2>&1 | tee $log
