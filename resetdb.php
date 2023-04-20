<?php

include('sqlGetter.php');

function logic() {
    require_once('../../conf/mysqlcredentials.inc.php');
    $sqlConn = OpenSQLCon($dbhost, $dbuser, $dbpass, $db);
    if (checkForTable($sqlConn, $db, $dbtable)) {
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