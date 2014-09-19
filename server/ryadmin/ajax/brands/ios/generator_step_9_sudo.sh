#!/bin/bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
cp ../../../../../resources/defaults/ios-builder.command ./
chmod 777 ./ios-builder.command

rm ../../../../../resources/mobile-app/$1/$1-ios.tar.gz
tar -zcvf $1-ios.tar.gz ./
cp $1-ios.tar.gz  ../../../../../resources/mobile-app/$1/
cd ..
rm -rf ./$1