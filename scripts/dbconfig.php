<?php

	/* Localhost */
	/*$dbhost = 'localhost';
	$dbport = '8889';
	$dbuser = 'root';
	$dbpassword = 'root';
	$dbdatabase = 'capstonesite2014';*/
	
	/* Test Server */
	$dbhost = '127.0.0.1';
	$dbport = '1433';
	$dbuser = 'warn4934';
	$dbpassword = '5c5ea08bdfd57b4';
	$dbdatabase = 'warn4934';
	
	/* Live 
	$dbhost = '127.0.0.1';
	$dbport = '8889';
	$dbuser = 'root';
	$dbpassword = 'root';
	$dbdatabase = 'capstonesite2014'; */

	$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbdatabase);
?>