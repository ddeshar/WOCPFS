<?php
	# configuration for database
	$_config['database']['hostname'] = "localhost";
	$_config['database']['username'] = "root";
	$_config['database']['password'] = "mysql";
	$_config['database']['database'] = "radius3";

	// $_config['database']['hostname'] = "localhost";
	// $_config['database']['username'] = "mysql_USER";
	// $_config['database']['password'] = "mysql_PASSWORD";
	// $_config['database']['database'] = "mysql_DB";
	
	# connect the database server
	$link = new mysqldb();
	$link->connect($_config['database']);
	$link->selectdb($_config['database']['database']);
	$link->query("SET NAMES 'utf8'");
	
	@session_start();
?>
