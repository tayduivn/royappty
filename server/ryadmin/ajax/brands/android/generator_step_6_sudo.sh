#!/bin/bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-media.git
phonegap local plugin add https://git-wip-us.apache.org/repos/asf/cordova-plugin-dialogs.git