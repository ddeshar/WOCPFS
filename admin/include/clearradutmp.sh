#!/bin/sh
service freeradius stop
rm /var/log/freeradius/radutmp
rm /var/log/freeradius/radwtmp
touch /var/log/freeradius/radutmp
touch /var/log/freeradius/radwtmp
chmod 600 /var/log/freeradius/radutmp
chmod 644 /var/log/freeradius/radwtmp
chown freerad:freerad /var/log/freeradius/radutmp
chown freerad:freerad /var/log/freeradius/radwtmp
service freeradius start
