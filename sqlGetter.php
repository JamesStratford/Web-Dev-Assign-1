<?php

// Include file with sql details
function OpenSQLCon($dbhost, $dbuser, $dbpass, $db)
{
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

    return $conn;
}


?>