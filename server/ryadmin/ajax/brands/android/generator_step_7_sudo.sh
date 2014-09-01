#!/bin/bash
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