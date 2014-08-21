#!/bin/bash
rm ./out.text
touch ./out.text
PATH="/Library/Frameworks/Python.framework/Versions/3.4/bin:/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/opt/X11/bin:/usr/local/Cellar/android-sdk/platform-tools:/urs/local/Cellar/android-sdk/tools"

echo "babilonia" | sudo -S phonegap create $1 --id $2 --name \"$3\" >> /dev/null
echo "[35m[Android Generator 0.0.1][39m Phonegap Create APP <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ./out.text
echo "[35m[Android Generator 0.0.1][39m Android Build APP <span class='pull-right'>[<span style='color:black'>START</span>]</span> " >> ./out.text

cat ./out.text
