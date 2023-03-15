<?php

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "user";
    $dbpass = "1234";
    $db = "assignment1";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db, 3306);

    return $conn;
}

$sqlConn = OpenCon();

$sqlQuery = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'assignment1' AND TABLE_NAME = 'status';";
$sqlResult = mysqli_query($sqlConn, $sqlQuery);

if ($sqlResult->num_rows == 0) {
    $sqlQuery = "CREATE TABLE status (
                        statusCode VARCHAR(50) unique,
                        status VARCHAR(50),
                        share VARCHAR(50),
                        date VARCHAR(50),
                        allowLike BOOLEAN,
                        allowComments BOOLEAN,
                        allowShare BOOLEAN
                    );";
    $sqlResult = mysqli_query($sqlConn, $sqlQuery);
}


$statusCode = $_POST['statuscode'];
$status = $_POST['status'];
$share = $_POST['share'];
$date = $_POST['date'];
$allowLike = isset($_POST['allowlike']) ? 1 : 0;
$allowComments = isset($_POST['allowcomments']) ? 1 : 0;
$allowShare = isset($_POST['allowshare']) ? 1 : 0;


// $statusCode Check
if ($statusCode[0] == 'S' && strlen($statusCode) == 5) {
    for ($i = 1; $i < strlen($statusCode); $i++) {
        if ($statusCode[$i] < '0' || $statusCode[$i] > '9') {
            echo "Status code must start with 'S' and followed by numbers. Please provide a new status code.";
            exit();
        }
    }
} else {
    echo "Status code must start with 'S' and followed by numbers and be length of 5. Please provide a new status code.";
    exit();
}

$sqlQuery = "SELECT statuscode FROM status WHERE statuscode = '$statusCode';";
$sqlResult = mysqli_query($sqlConn, $sqlQuery);
if ($sqlResult->num_rows > 0) {
    echo "Status code already exists. Please provide next status code.";
    exit();
}

// $status Check
if (strlen($status) <= 0 || preg_match("/[^a-zA-Z0-9\s,.!?]/", $status)) {
    echo "Your  status  is  in  a  wrong  format!  The  status  can  only  contain  
        alphanumericals and spaces, comma, period, exclamation point and question mark 
        and cannot be blank!";
    exit();
}

// $date Check
if (!DateTime::createFromFormat('Y-m-d', $date)) {
    echo "The date is invalid.";
    exit();
}

$sqlQuery = "INSERT INTO status (statusCode, status, date, share, allowLike, allowComments, allowShare) 
                VALUES ('$statusCode', '$status', '$date', '$share', '$allowLike', '$allowComments', '$allowShare');";
$sqlResult = mysqli_query($sqlConn, $sqlQuery);

echo "Status code: $statusCode <br>";
echo "Status: $status <br>";
echo "Success!<br><br>";
echo "<a href='index.html'>Return to Home Page</a>";

?>