############################################################
# Royappty
# Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
# Last Modification: 10-02-2014
# Version: 1.0
# licensed through CC BY-NC 4.0
############################################################

apt-get install php5-gd
apt-get install unzip
apt-get install g++
apt-get install ia32-libs
apt-get install default-jre
apt-get install default-jdk
apt-get install ant
apt-get install npm
apt-get install nodejs
npm install -g phonegap
apt-get install nodejs-legacy  
cd /etc/apt/sources.list.d
echo "deb http://old-releases.ubuntu.com/ubuntu/ raring main restricted universe multiverse" >ia32-libs-raring.list
apt-get update
apt-get install ia32-libs


wget http://dl.google.com/android/adt/adt-bundle-linux-x86_64-20140702.zip
unzip adt-bundle-linux-x86_64-20140702.zip
mv adt-bundle-linux-x86_64-20140702 /usr/share/
echo "PATH=$PATH:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools" >> ~/.bashrc
rm adt-bundle-linux-x86_64-20140702.zip

chmod 777 ../ryadmin/ajax/brands/android/generator_step_*
chmod 777 ../ryadmin/ajax/brands/ios/generator_step_*
chmod -R 777 ../resources
chmod -R 777 /usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools/


android update sdk -u
