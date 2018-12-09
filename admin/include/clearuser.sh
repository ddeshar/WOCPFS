#Start clear user#
rm -rf /var/log/radius/radutmp
rm -rf /var/log/radius/radwtmp
touch /var/log/radius/radutmp
touch /var/log/radius/radwtmp
chmod 600 /var/log/radius/radutmp
chmod 644 /var/log/radius/radwtmp
chown radiusd:radiusd /var/log/radius/radutmp
chown radiusd:radiusd /var/log/radius/radwtmp
service radiusd start
#End clear user#