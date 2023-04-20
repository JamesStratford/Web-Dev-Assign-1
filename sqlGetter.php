<?php

// Include file with sql details
function OpenSQLCon($dbhost, $dbuser, $dbpass, $db)
{
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

    return $conn;
}

function checkForTable($conn, $db, $table)
{
    $sqlQuery = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = '$table';";
    $sqlResult = mysqli_query($conn, $sqlQuery);

    return mysqli_num_rows($sqlResult) > 0;
}


?>