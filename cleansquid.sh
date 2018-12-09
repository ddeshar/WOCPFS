#!/bin/sh
#################################################################
######## This file is Clearing Squid cache automatically ########
### Created by : Mr.Karun Bunkhrob : 2014-08-30 At 01.49 P.M. ###
#### Modify by : Dipendra Deshar : 2018-09-12 At 11.00 P.M. ###
#################################################################
################ Delete Squid Cache Full  #######################
#################################################################
/usr/local/etc/rc.d/squid.sh stop
sleep 5
mv /var/squid/cache /var/squid/cache2
mkdir -p /var/squid/cache
cd /var/squid/
chown squid:proxy cache
chmod 777 /var/squid/cache
squid -z
sleep 5
/usr/local/etc/rc.d/squid.sh start
sleep 9
/usr/local/etc/rc.d/squid.sh restart
rm -rf /var/squid/cache2
exit 0
