#!/bin/bash
rm ./out.text
touch ./out.text
PATH="/Library/Frameworks/Python.framework/Versions/3.4/bin:/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/opt/X11/bin:/usr/local/Cellar/android-sdk/platform-tools:/urs/local/Cellar/android-sdk/tools"
cd $1
echo "babilonia" | sudo -S phonegap local plugin add https://github.com/phonegap-build/PushPlugin >> /dev/null
echo "[35m[Android Generator 0.0.1][39m Push Plugin Download <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ../out.text
echo "babilonia" | sudo -S phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-device.git >> /dev/null
echo "[35m[Android Generator 0.0.1][39m Push Device Download <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ../out.text
echo "babilonia" | sudo -S phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-media.git >> /dev/null
echo "[35m[Android Generator 0.0.1][39m Push Media Download <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ../out.text
echo "babilonia" | sudo -S phonegap local build android >> /dev/null
echo "[35m[Android Generator 0.0.1][39m Android Rebuild <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ../out.text
cd ..
echo "[35m[Android Generator 0.0.1][39m Finished" >> ./out.text
cat ./out.text
