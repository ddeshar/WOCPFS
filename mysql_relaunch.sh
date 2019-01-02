#!/bin/sh
#
####################################################################
################# Script Check MySQL Server Status #################
################## Scritp By : Mr.Karun  Bunkhrob ##################
####################################################################
##################### Create Date : 12/06/2016 #####################
###### Modify by : Dipendra Deshar : 2018-09-12 At 11.00 P.M. ######
####################################################################
#
service mysql-server.sh status > /dev/null 
if [ $? != 0 ]; then 
        service mysql-server.sh start 

fi
####################################################################
########################### End Script #############################
####################################################################