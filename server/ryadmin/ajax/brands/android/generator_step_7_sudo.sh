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
cp ../../../../../resources/mobile-app/$1/android_config.xml ./www/config.xml
cp ../../../../../resources/mobile-app/$1/app_icon.png ./www/icon.png
cp ../../../../../resources/mobile-app/$1/app_icon.png ./platforms/android/res/drawable/icon.png
cp ../../../../../resources/mobile-app/$1/icon-36-ldpi.png ./www/res/icon/android/icon-36-ldpi.png
cp ../../../../../resources/mobile-app/$1/icon-36-ldpi.png ./platforms/android/res/drawable-ldpi/icon.png
cp ../../../../../resources/mobile-app/$1/icon-48-mdpi.png ./www/res/icon/android/icon-48-mdpi.png
cp ../../../../../resources/mobile-app/$1/icon-48-mdpi.png ./platforms/android/res/drawable-mdpi/icon.png
cp ../../../../../resources/mobile-app/$1/icon-72-hdpi.png ./www/res/icon/android/icon-72-hdpi.png
cp ../../../../../resources/mobile-app/$1/icon-72-hdpi.png ./platforms/android/res/drawable-hdpi/icon.png
cp ../../../../../resources/mobile-app/$1/icon-96-xhdpi.png ./www/res/icon/android/icon-96-xhdpi.png
cp ../../../../../resources/mobile-app/$1/icon-96-xhdpi.png ./platforms/android/res/drawable-xhdpi/icon.png

cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-land-hdpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-land-ldpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-land-mdpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-land-xhdpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-port-hdpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-port-ldpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-port-mdpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-port-xhdpi/screen.png
cp ../../../../../resources/mobile-app/$1/app_bg.png ./platforms/android/res/drawable-xhdpi/screen.png
