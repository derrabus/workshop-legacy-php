<?php

// database connection setup section

$username = getenv('DATABASE_USERNAME');
$password = getenv('DATABASE_PASSWORD');
$hostspec = getenv('DATABASE_HOST');
$database = getenv('DATABASE_NAME');
$phptype = 'mysqli';

$dsn = "$phptype://$username:$password@$hostspec/$database";

// establish the connection

$db = DB::connect($dsn);
if (DB::isError($db)) {
    die ($db->getMessage( ));
}

$db->query('SET NAMES utf8mb4');
