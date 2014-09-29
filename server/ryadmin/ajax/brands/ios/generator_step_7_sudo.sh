#!/bin/bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
cp -R ../../../../mobile_base/* ./www/
rm ./www/data/brand.json
cp ../../../../../resources/mobile-app/$1/brand.json ./www/data/brand.json
cp ../../../../../resources/mobile-app/$1/ios_config.xml ./www/config.xml
cp ../../../../../resources/mobile-app/$1/app_icon.png ./www/icon.png
cp ../../../../../resources/mobile-app/$1/app_icon.png ./platforms/ios/res/drawable/icon.png
cp ../../../../../resources/mobile-app/$1/icon-36-ldpi.png ./www/res/icon/ios/icon-57.png
cp ../../../../../resources/mobile-app/$1/icon-48-mdpi.png ./www/res/icon/ios/icon-72.png
cp ../../../../../resources/mobile-app/$1/icon-72-hdpi.png ./www/res/icon/ios/icon-57-2x.png
cp ../../../../../resources/mobile-app/$1/icon-96-xhdpi.png ./www/res/icon/ios/icon-72-2x.png

cp ../../../../../resources/mobile-app/$1/screen-iphone-portrait.png ./www/splash.png
