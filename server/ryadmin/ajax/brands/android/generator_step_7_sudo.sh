#!/bin/bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/platform-tools:/usr/share/adt-bundle-linux-x86_64-20140702/sdk/tools
cd $1
cp -R ../../../../mobile_base/* ./www/
rm ./www/data/brand.json
touch ./www/data/brand.json
echo "{\"result\" : true,\"data\" :{\"id_brand\" : $4}}" >> ./www/data/brand.json