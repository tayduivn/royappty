#!/bin/bash
rm ./out.text
touch ./out.text
PATH="/Library/Frameworks/Python.framework/Versions/3.4/bin:/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/opt/X11/bin:/usr/local/Cellar/android-sdk/platform-tools:/urs/local/Cellar/android-sdk/tools"
cd $1
echo "[35m[Android Generator 0.0.1][39m Android Generator Success <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ../out.text
echo "[35m[Android Generator 0.0.1][39m Delete Temporary files <span class='pull-right'>[<span style='color:green'>OK</span>]</span>" >> ../out.text
echo "[35m[Android Generator 0.0.1][39m Saving APK <span class='pull-right'>[<span style='color:green'>OK</span>]</span>" >> ../out.text

echo "babilonia" | sudo -S mv platforms/android/ant-build/$1-debug.apk  ../../../../mobile_apps/
cd ..
echo "babilonia" | sudo -S rm -rf ./$1

cat ./out.text
