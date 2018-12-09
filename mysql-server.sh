#!/bin/sh
#
# $FreeBSD: branches/2018Q3/databases/mysql56-server/files/mysql-server.in 466505 2018-04-04 20:45:14Z mmokhi $
#

# PROVIDE: mysql
# REQUIRE: LOGIN
# KEYWORD: shutdown

#
# Add the following line to /etc/rc.conf to enable mysql:
# mysql_enable (bool):	Set to "NO" by default.
#			Set it to "YES" to enable MySQL.
# mysql_limits (bool):	Set to "NO" by default.
#			Set it to yes to run `limits -e -U mysql`
#			just before mysql starts.
# mysql_dbdir (str):	Default to "/var/db/mysql"
#			Base database directory.
# mysql_confdir (str):	Default to "/usr/local/etc/mysql"
#			Base configuration directory.
# mysql_optfile (str):	Server-specific option file.
#			Set it in the rc.conf or default behaviour of
#			`mysqld_safe` itself, will be picking
#			${mysql_confdir}/my.cnf if it exists.
# mysql_pidfile (str):	Custum PID file path and name.
#			Default to "${mysql_dbdir}/${hostname}.pid".
# mysql_args (str):	Custom additional arguments to be passed
#			to mysqld_safe (default empty).
#

. /etc/rc.subr

name="mysql"
rcvar=mysql_enable

load_rc_config $name

: ${mysql_enable="YES"}
: ${mysql_limits="NO"}
: ${mysql_dbdir="/var/db/mysql"}
: ${mysql_confdir="/usr/local/etc/mysql"}
if [ -f "${mysql_confdir}/my.cnf" ]; then
: ${mysql_optfile="${mysql_confdir}/my.cnf"}
elif [ -f "${mysql_dbdir}/my.cnf" ]; then
: ${mysql_optfile="${mysql_dbdir}/my.cnf"}
fi
if [ ! -z "${mysql_optfile}" ]; then
mysql_extra="--defaults-extra-file=${mysql_optfile}"
fi

mysql_user="mysql"
mysql_limits_args="-e -U ${mysql_user}"
: ${hostname:=`/bin/hostname`}
pidfile=${mysql_pidfile:-"${mysql_dbdir}/${hostname}.pid"}
command="/usr/sbin/daemon"
command_args="-c -f /usr/local/bin/mysqld_safe ${mysql_extra} --basedir=/usr/local --datadir=${mysql_dbdir} --pid-file=${pidfile} --user=${mysql_user} ${mysql_args}  "
procname="/usr/local/libexec/mysqld"
start_precmd="${name}_prestart"
start_postcmd="${name}_poststart"
mysql_install_db="/usr/local/bin/mysql_install_db"
mysql_install_db_args="${mysql_extra} --basedir=/usr/local --datadir=${mysql_dbdir} --force"

mysql_create_auth_tables()
{
	eval $mysql_install_db $mysql_install_db_args >/dev/null 2>/dev/null
        [ $? -eq 0 ] && chown -R ${mysql_user}:${mysql_user} ${mysql_dbdir}
}

mysql_prestart()
{
	if [ ! -d "${mysql_dbdir}/mysql/." ]; then
		mysql_create_auth_tables || return 1
	fi
	if checkyesno mysql_limits; then
		eval `/usr/bin/limits ${mysql_limits_args}` 2>/dev/null
	else
		return 0
	fi
}

mysql_poststart()
{
	local timeout=15
	while [ ! -f "${pidfile}" -a ${timeout} -gt 0 ]; do
		timeout=$(( timeout - 1 ))
		sleep 1
	done
	return 0
}

run_rc_command "$1"
