#!/bin/bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
rm ../../../../mobile_apps/$1-debug.apk  
mv platforms/android/ant-build/$1-debug.apk  ../../../../mobile_apps/
cd ..
rm -rf ./$1