# author: prakashm88
# description: Script for auto installation of GenieWPMatrimony plugin
# name: install-genie-wp-matrimony-ubuntu-dev.sh

#!/bin/bash -e
echo "================================="
echo "Genie WP Matrimony Tools Install Script"
echo "================================="
cwd=$(pwd)
if [ "$EUID" -ne 0 ]
  then echo "Please run the script as root or sudo !"
  exit
else 
	echo "Start installation (press enter) ?"
	read -e confirmation
fi
echo "============================="
echo "Downloading necessary tools: "
echo "============================="
apt-get install apache2 php libapache2-mod-php mysql-server mysql-client php-mysql perlbrew wget tar zip unzip pv composer subversion phpunit git
wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info
chmod +x wp-cli.phar
mv wp-cli.phar /usr/local/bin/wp
echo "================================="
echo "Downloading tools completed, not run the following command to install test scripts"
echo "./install-wp-tests.sh gwpmdb gwpmuser gwpmpass localhost latest true"
echo "================================="