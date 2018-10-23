<?php
require_once('DB.php');

// database connection setup section

$username = 'user';
$password = 'seekrit';
$hostspec = 'localhost';
$database = 'phpbook';

// select one of these three values for $phptype

// $phptype = 'pgsql';
// $phptype = 'oci8';
$phptype = 'mysql';

// check for Oracle 8 - data source name syntax is different

if ($phptype != 'oci8'){
    $dsn = "$phptype://$username:$password@$hostspec/$database";
} else {
    $net8name = 'www';
    $dsn = "$phptype://$username:$password@$net8name";
}

// establish the connection

$db = DB::connect($dsn);
if (DB::isError($db)) {
    die ($db->getMessage( ));
}
?>
