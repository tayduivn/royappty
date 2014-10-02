#!/bin/bash
#############################################################
# Royappty
# Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
# Last Modification: 10-02-2014
# Version: 1.0
# licensed through CC BY-NC 4.0
#############################################################

PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
cp -R ../../../../mobile_base/* ./www/
rm ./www/data/brand.json
cp ../../../../../resources/mobile-app/$1/brand.json ./www/data/brand.json
cp ../../../../../resources/mobile-app/$1/ios_config.xml ./www/config.xml
cp ../../../../../resources/mobile-app/$1/app_icon.png ./www/icon.png
cp ../../../../../resources/mobile-app/$1/app_icon.png ./www/res/icon/ios/icon-57-2x.png
cp ../../../../../resources/mobile-app/$1/app_icon.png ./www/res/icon/ios/icon-57.png
cp ../../../../../resources/mobile-app/$1/app_icon.png ./www/res/icon/ios/icon-72-2x.png
cp ../../../../../resources/mobile-app/$1/app_icon.png ./www/res/icon/ios/icon-72.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./www/splash.png
