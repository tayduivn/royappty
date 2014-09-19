#!/bin/bash
rm ./out.text
touch ./out.text
echo "babilonia" | sudo -S rm -rf $1
echo "[35m[generator 0.0.1][39m Arguments $1 $2 $3 " >> ./out.text
echo "[35m[generator 0.0.1][39m start" >> ./out.text
PATH="/Library/Frameworks/Python.framework/Versions/3.4/bin:/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/opt/X11/bin:/usr/local/Cellar/android-sdk/platform-tools:/urs/local/Cellar/android-sdk/tools"
echo "babilonia" | sudo -S phonegap create $1 --id $2 --name \"$3\">> ./out.text
cd $1
echo "[35m[generator 0.0.1][39m In $1 folder" >> ../out.text
echo "babilonia" | sudo -S phonegap local build android >> ../out.text
echo "[35m[generator 0.0.1][39m Android Build Finished" >> ../out.text
echo "babilonia" | sudo -S phonegap local plugin add https://github.com/phonegap-build/PushPlugin >> ../out.text
echo "[35m[generator 0.0.1][39m Push Plugin Dowloaded" >> ../out.text
echo "babilonia" | sudo -S phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-device.git >> ../out.text
echo "[35m[generator 0.0.1][39m Push Device Dowloaded" >> ../out.text
echo "babilonia" | sudo -S phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-media.git
echo "[35m[generator 0.0.1][39m Push Media Dowloaded" >> ../out.text
echo "babilonia" | sudo -S phonegap local build android >> ../out.text
echo "[35m[generator 0.0.1][39m Android Rebuild Finished" >> ../out.text
cd ..
echo "[35m[generator 0.0.1][39m end" >> ./out.text
cat ./out.text
