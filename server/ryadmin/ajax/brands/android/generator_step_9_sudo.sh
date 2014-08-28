#!/bin/bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
rm ../../../../../resources/mobile-app/$1/$1-debug.apk 
cp platforms/android/ant-build/$1-debug.apk  ../../../../../resources/mobile-app/$1/
cd ..
rm -rf ./$1