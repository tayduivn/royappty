#!/bin/bash
#############################################################
# Royappty
# Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
# Last Modification: 10-02-2014
# Version: 1.0
# licensed through CC BY-NC 4.0
#############################################################

PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-device.git
phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-splashscreen.git
