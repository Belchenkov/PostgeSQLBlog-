<?php

$dbhost = 'localhost';
$dbport = 5432;
$dbname = 'acme';
$dbuser = 'postgres';
$dbpass = 'postgre';

$con = pg_connect("host=".$dbhost." port=".$dbport." dbname=".$dbname." user=".$dbuser." password=".$dbpass);
