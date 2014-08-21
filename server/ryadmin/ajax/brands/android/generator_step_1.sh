#!/bin/bash
rm ./out.text
touch ./out.text
echo "[35m[Android Generator 0.0.1][39m Connecting to Server <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ./out.text
echo "babilonia" | sudo -S rm -rf $1
echo "[35m[Android Generator 0.0.1][39m Delete old Android App <span class='pull-right'>[<span style='color:green'>OK</span>]</span> " >> ./out.text
echo "[35m[Android Generator 0.0.1][39m Phonegap Create APP <span class='pull-right'>[<span style='color:black'>START</span>]</span> " >> ./out.text
cat ./out.text
