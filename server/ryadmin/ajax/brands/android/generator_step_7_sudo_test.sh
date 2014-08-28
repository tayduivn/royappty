#!/bin/bash
rm ./www/config.xml
touch ./www/config.xml

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>" >> ./www/config.xml
echo "<widget id=\"$2\" version=\"1.0.0\" xmlns=\"http://www.w3.org/ns/widgets\" xmlns:gap=\"http://phonegap.com/ns/1.0\">" >> ./www/config.xml
echo "<name>$5</name>" >> ./www/config.xml
echo "<description>" >> ./www/config.xml
echo $6 >> ./www/config.xml
echo "</description>" >> ./www/config.xml
echo "<author email=\"support@phonegap.com\" href=\"http://phonegap.com\">" >> ./www/config.xml
echo "Royappty" >> ./www/config.xml
echo "</author>" >> ./www/config.xml
echo "<preference name=\"permissions\" value=\"none\" />" >> ./www/config.xml
echo "<preference name=\"phonegap-version\" value=\"3.5.0\" />" >> ./www/config.xml
echo "<preference name=\"orientation\" value=\"default\" />" >> ./www/config.xml
echo "<preference name=\"target-device\" value=\"universal\" />" >> ./www/config.xml
echo "<preference name=\"fullscreen\" value=\"true\" />" >> ./www/config.xml
echo "<preference name=\"webviewbounce\" value=\"true\" />" >> ./www/config.xml
echo "<preference name=\"prerendered-icon\" value=\"true\" />" >> ./www/config.xml
echo "<preference name=\"stay-in-webview\" value=\"false\" />" >> ./www/config.xml
echo "<preference name=\"ios-statusbarstyle\" value=\"black-opaque\" />" >> ./www/config.xml
echo "<preference name=\"detect-data-types\" value=\"true\" />" >> ./www/config.xml
echo "<preference name=\"exit-on-suspend\" value=\"false\" />" >> ./www/config.xml
echo "<preference name=\"show-splash-screen-spinner\" value=\"true\" />" >> ./www/config.xml
echo "<preference name=\"auto-hide-splash-screen\" value=\"true\" />" >> ./www/config.xml
echo "<preference name=\"disable-cursor\" value=\"false\" />" >> ./www/config.xml
echo "<preference name=\"android-minSdkVersion\" value=\"7\" />" >> ./www/config.xml
echo "<preference name=\"android-installLocation\" value=\"auto\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.battery-status\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.camera\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.media-capture\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.console\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.contacts\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.device\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.device-motion\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.device-orientation\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.dialogs\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.file\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.file-transfer\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.geolocation\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.globalization\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.inappbrowser\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.media\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.network-information\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.splashscreen\" />" >> ./www/config.xml
echo "<gap:plugin name=\"org.apache.cordova.vibration\" />" >> ./www/config.xml
echo "<icon src=\"icon.png\" />" >> ./www/config.xml
echo "<icon gap:platform=\"android\" gap:qualifier=\"ldpi\" src=\"res/icon/android/icon-36-ldpi.png\" />" >> ./www/config.xml
echo "<icon gap:platform=\"android\" gap:qualifier=\"mdpi\" src=\"res/icon/android/icon-48-mdpi.png\" />" >> ./www/config.xml
echo "<icon gap:platform=\"android\" gap:qualifier=\"hdpi\" src=\"res/icon/android/icon-72-hdpi.png\" />" >> ./www/config.xml
echo "<icon gap:platform=\"android\" gap:qualifier=\"xhdpi\" src=\"res/icon/android/icon-96-xhdpi.png\" />" >> ./www/config.xml
echo "<gap:splash gap:platform=\"android\" gap:qualifier=\"port-ldpi\" src=\"res/screen/android/screen-ldpi-portrait.png\" />" >> ./www/config.xml
echo "<gap:splash gap:platform=\"android\" gap:qualifier=\"port-mdpi\" src=\"res/screen/android/screen-mdpi-portrait.png\" />" >> ./www/config.xml
echo "<gap:splash gap:platform=\"android\" gap:qualifier=\"port-hdpi\" src=\"res/screen/android/screen-hdpi-portrait.png\" />" >> ./www/config.xml
echo "<gap:splash gap:platform=\"android\" gap:qualifier=\"port-xhdpi\" src=\"res/screen/android/screen-xhdpi-portrait.png\" />" >> ./www/config.xml
echo "<access origin=\"*\" />" >> ./www/config.xml
echo "</widget>" >> ./www/config.xml