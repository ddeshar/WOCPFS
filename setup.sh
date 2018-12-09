#!/bin/sh
#
clear
echo "";
echo "";
echo "   ###############################################################";
echo "   ##               Script Installation Software                ##";
echo "   ##             Authentication Server For Admin               ##";
echo "   ##    BUU2PFS-v1.0 + MySQL-5.6.41 For pfSense-2.4.4-amd64    ##";
echo "   ###############################################################";
echo "   ##        Create By : Mr.Karun  Bunkhrob. 25/05/2014         ##";
echo "   ###############################################################";
echo "   ##             E-Mail  : jeddeshar@gmail.com                 ##";
echo "   ##             Website : ddeshar.com.np                      ##";
echo "   ###############################################################";
echo "   ###  Modify by : Dipendra Deshar : 2018-09-12 At 11.00 P.M. ###";
echo "   ###############################################################";
echo "   ##################     For Freeradius-3      ##################";
echo "   ###############################################################";
echo "   ############ Fix : Case-Sensitive and Group Expire ############";
echo "   ###############################################################";
echo "";
echo "";

sleep 7
chmod +x *.sh
#
pkg install -y pkg
#
pkg install -y php72-mysqli nano freeradius3
#
pkg add gsed-4.2.2_1.txz
rehash
#
clear
echo "";
echo "";
echo "|======================================================|";
echo "|=======| Install MySQL-5.6.41 Database Server |=======|";
echo "|======================================================|";
sleep 3
#
pkg add mysql56-server-5.6.41.txz
#
#gsed -i "s/no/yes/g" /usr/local/etc/pkg/repos/FreeBSD.conf
#gsed -i "s/no/yes/g" /usr/local/etc/pkg/repos/pfSense.conf
#
pkg install -y  htop zip
rehash
#
/usr/local/bin/mysql_install_db --user=mysql --basedir=/usr/local --datadir=/var/db/mysql
chmod 777 /var/db/mysql
mv /usr/local/etc/rc.d/mysql-server /usr/local/etc/rc.d/mysql-server.sh
gsed -i 's/mysql_enable="NO"/mysql_enable="YES"/g' /usr/local/etc/rc.d/mysql-server.sh
chmod 755 /usr/local/etc/rc.d/mysql-server.sh
cp -rf mysql-server.sh /usr/local/etc/rc.d/mysql-server.sh
#
##cp -rf php.ini  /usr/local/lib/
##killall -9 php-fpm; killall -9 nginx; /etc/rc.restart_webgui
#
echo '###' >> /etc/rc.conf
echo 'mysql_enable="YES"' >> /etc/rc.conf
echo '###' >> /etc/rc.conf
#echo 'php_fpm_enable="YES"' >> /etc/rc.conf
#echo '###' >> /etc/rc.conf
#echo 'nginx_enable="YES"' >> /etc/rc.conf
#echo '###' >> /etc/rc.conf
echo 'radiusd_enable="YES"' >> /etc/rc.conf
echo '###' >> /etc/rc.conf
#
/usr/local/etc/rc.d/mysql-server.sh start
#
/usr/local/bin/mysqladmin -u mysql_USER password 'mysql_PASSWORD'
#
cp -Rf mysql_relaunch.sh /usr/local/bin/
chmod +x /usr/local/bin/mysql_relaunch.sh
#
cp -Rf  radiusd_relaunch.sh /usr/local/bin/
cp -Rf  radiusd_relaunch.sh /usr/local/etc/rc.d/
chmod +x /usr/local/bin/radiusd_relaunch.sh
chmod +x /usr/local/etc/rc.d/radiusd_relaunch.sh
#
clear
echo "";
echo "";
echo "|======================================================|";
echo "|=======| Copy & Install BUU Management System |=======|";
echo "|======================================================|";
sleep 3
cp -Rf admin /usr/local/www/
cp -Rf phpMyAdmin /usr/local/www/
cp -Rf captiveportal /usr/local/
chmod -R 755 /usr/local/www/admin
chmod -R 777 /usr/local/www/admin/backup
chmod -R 777 /usr/local/www/admin/upload
chmod -R 755 /usr/local/www/phpMyAdmin
#
echo 'CREATE DATABASE mysql_DB DEFAULT CHARACTER SET utf8' | mysql -umysql_USER -pmysql_PASSWORD
mysql -umysql_USER -pmysql_PASSWORD mysql_DB < radius3.sql
#
echo 'CREATE DATABASE phpmyadmin CHARACTER SET utf8' | mysql -umysql_USER -pmysql_PASSWORD
mysql -umysql_USER -pmysql_PASSWORD phpmyadmin < create_tables.sql
#
cp -rf user-kick.sh /usr/local/etc/rc.d/
cp -rf del_radutmp.sh /usr/local/etc/rc.d/
cp -rf cleansquid.sh /sbin/
#
chmod +x /usr/local/etc/rc.d/user-kick.sh
chmod +x /usr/local/etc/rc.d/del_radutmp.sh
chmod +x /sbin/cleansquid.sh
#
#cp -rf radius_accounting.inc /usr/local/captiveportal/
#
cp -rf /usr/local/etc/raddb/mods-config/sql/main/mysql/queries.conf  /usr/local/etc/raddb/mods-config/sql/main/mysql/queries.conf.bak
cp -rf queries.conf /usr/local/etc/raddb/mods-config/sql/main/mysql/
#
/usr/local/etc/rc.d/mysql-server.sh stop
rm -rf /var/db/mysql/ib_*
rm -rf /var/db/mysql/aria_*
#
mv /usr/local/etc/my.cnf /usr/local/etc/my.cnf.bak
mv /usr/local/my.cnf /usr/local/my.cnf.bak
cp -rf my.cnf /usr/local/
cp -rf my.cnf /usr/local/etc/
/usr/local/etc/rc.d/mysql-server.sh start
#
#echo '###' >> /etc/crontab
#echo '*/1      *      *       *       *       root  /usr/local/bin/radiusd_relaunch.sh' >> /etc/crontab
#echo '###' >> /etc/crontab
#echo '*/5      *      *       *       *       root  /usr/local/bin/mysql_relaunch.sh' >> /etc/crontab
#echo '###' >> /etc/crontab
#
clear
echo "";
echo "";
echo "|====================================================|";
echo "|=====| Success Install WiFi Hotspot System   |======|";
echo "|====================================================|";
echo "|                                                    |";
echo "|              Go to BU2 Web Management              |";
echo "|                                                    |";
echo "|          http://LAN_IP/admin/                      |";
echo "|                                                    |";
echo "|            UserLogin = administrator               |";
echo "|             Password = password                    |";
echo "|                                                    |";
echo "|====================================================|";
echo "|==========| Please wait for reboot OS  |============|";
echo "|====================================================|";
echo "";
echo "";
echo "";
sleep 9
#
reboot