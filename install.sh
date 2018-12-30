#!/bin/sh
#
#####################################################################
## Edit Your's mysql_PASSWORD, mysql_DB, radius_secret and LAN_IP ###
#####################################################################
#
mysql_USER='root'
#
mysql_PASSWORD='123456'
mysql_DB='radius'
#
radius_secret='testing123'
#
LAN_IP='192.168.100.1'
#####################################################################
########################### End Edit ########@#######################
#####################################################################
#
pkg add gsed-4.2.2_1.txz
rehash
#
gsed -i "s/mysql_USER/$mysql_USER/g" setup.sh
gsed -i "s/mysql_PASSWORD/$mysql_PASSWORD/g" setup.sh
gsed -i "s/mysql_DB/$mysql_DB/g" setup.sh
gsed -i "s/LAN_IP/$LAN_IP/g" setup.sh
#
gsed -i "s/mysql_USER/$mysql_USER/g" admin/include/config.inc.php
gsed -i "s/mysql_PASSWORD/$mysql_PASSWORD/g" admin/include/config.inc.php
gsed -i "s/mysql_DB/$mysql_DB/g" admin/include/config.inc.php
#
gsed -i "s/mysql_USER/$mysql_USER/g" admin/kickuser/config.inc.php 
gsed -i "s/mysql_PASSWORD/$mysql_PASSWORD/g" admin/kickuser/config.inc.php 
gsed -i "s/mysql_DB/$mysql_DB/g" admin/kickuser/config.inc.php 
#
gsed -i "s/mysql_USER/$mysql_USER/g" admin/backupdb.php
gsed -i "s/mysql_PASSWORD/$mysql_PASSWORD/g" admin/backupdb.php
gsed -i "s/mysql_DB/$mysql_DB/g" admin/backupdb.php
#
gsed -i "s/mysql_USER/$mysql_USER/g" admin/restore.php
gsed -i "s/mysql_PASSWORD/$mysql_PASSWORD/g" admin/restore.php
gsed -i "s/mysql_DB/$mysql_DB/g" admin/restore.php
#
gsed -i "s/radius_secret/$radius_secret/g" admin/kickuser/del_user_remain.php 
gsed -i "s/radius_secret/$radius_secret/g" admin/user_online.php
gsed -i "s/radius_secret/$radius_secret/g" admin/user_kick.php
gsed -i "s/radius_secret/$radius_secret/g" admin/kick.php
gsed -i "s/radius_secret/$radius_secret/g" admin/del_user_remain.php
gsed -i "s/radius_secret/$radius_secret/g" admin/del_user.php
gsed -i "s/radius_secret/$radius_secret/g" admin/clearuser.php
#
gsed -i "s/LAN_IP/$LAN_IP/g" customcaptiveportalpage/error.html
gsed -i "s/LAN_IP/$LAN_IP/g" customcaptiveportalpage/portal.html
gsed -i "s/LAN_IP/$LAN_IP/g" customcaptiveportalpage/logout.php
#
gsed -i 's/autoboot_delay="3"/autoboot_delay="1"/g' /boot/loader.conf
#echo  'kern.ipc.nmbclusters="131072" ' >> /boot/loader.conf
#
sh setup.sh
#