apt-get install php5-gd
apt-get install unzip
apt-get install g++
apt-get install ia32-libs
apt-get install default-jre
apt-get install default-jdk
apt-get install ant
git clone https://github.com/joyent/node.git
cd node
git checkout v0.10.31
./configure
make
make install
npm update npm -g
npm install n -g
n stable
cd ..
wget http://dl.google.com/android/adt/adt-bundle-linux-x86_64-20140702.zip
unzip adt-bundle-linux-x86_64-20140702.zip
mv adt-bundle-linux-x86_64-20140702 /usr/share/
echo "PATH=$PATH:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools" >> ~/.bashrc
rm adt-bundle-linux-x86_64-20140702.zip
rm -rf node/

chmod 777 ../ryadmin/ajax/brands/android/generator_step_*
chmod 777 ../ryadmin/ajax/brands/ios/generator_step_*
chmod -R 777 ../resources
chmod -R 777 /usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools/
