#!/bin/bash

DIR=$(cd $(dirname "$0"); pwd)
cd $DIR
phonegap build ios
cp www/splash.png platforms/ios/Floristería\ la\ Galería/Resources/splash/Default~iphone.png
cp www/splash.png platforms/ios/Floristería\ la\ Galería/Resources/splash/Default-568h\@2x~iphone.png
cp www/splash.png platforms/ios/Floristería\ la\ Galería/Resources/splash/Default\@2x~iphone.png
open platforms/ios/*.xcodeproj
osascript -e 'ignoring application responses' -e 'tell application "Terminal" to quit' -e "end ignoring"
