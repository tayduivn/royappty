#!/bin/bash
DIR=$(cd $(dirname "$0"); pwd)
cd $DIR
phonegap build ios
open platforms/ios/*.xcodeproj
osascript -e "ignoring application responses" -e 'tell application "Terminal" to quit' -e "end ignoring"