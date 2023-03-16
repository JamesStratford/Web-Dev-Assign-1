<?php

include('sqlGetter.php');

function logic() {
    require_once('../../conf/mysqlcredentials.inc.php');
    $sqlConn = OpenSQLCon($dbhost, $dbuser, $dbpass, $db);
    
    $sqlQuery = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = '$dbtable';";
    $sqlResult = mysqli_query($sqlConn, $sqlQuery);
    
    if ($sqlResult->num_rows != 0) {
        $sqlQuery = "DROP TABLE statusTable;";
        $sqlResult = mysqli_query($sqlConn, $sqlQuery);
    }
    $sqlConn->close();

    // Redirect to main page.
    header("Location: http://jgh4138.cmslamp14.aut.ac.nz/assign1/index.html");
}

try {
    logic();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>