#!/bin/sh
# This file is Clearing radutmp automatically
# Modify by : Dipendra Deshar
rm -rf /var/log/radutmp
rm -rf /var/log/radwtmp
touch /var/log/radutmp
touch /var/log/radwtmp
chown freeradius:freeradius /var/log/radutmp
chown freeradius:freeradius /var/log/radwtmp

#exit 0