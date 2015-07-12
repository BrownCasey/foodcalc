<?php
// connect.php to foodcalc database
require_once("/var/www/food_constants.php");

if(($connection = @mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD)) === false)
    print "could not connect to the server";
    
if(@mysql_select_db(DB_NAME, $connection) === false)
    print "could not connect to the database";
    
?>
