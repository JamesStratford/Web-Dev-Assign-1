<html>

<head>
    <title>Post status</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<div class="content">
    <h1>Posting Status</h1>

    <body>
        <?php
        include('sqlGetter.php');

        function logic()
        {
            require_once('../../conf/mysqlcredentials.inc.php');
            $sqlConn = OpenSQLCon($dbhost, $dbuser, $dbpass, $db);

            $sqlQuery = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = '$dbtable';";
            $sqlResult = mysqli_query($sqlConn, $sqlQuery);

            if ($sqlResult->num_rows == 0) {
                $sqlQuery = "CREATE TABLE statusTable (
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
            
            $allowLike = isset($_POST['allowlike']) ? 1 : 0; // True / False
            $allowComments = isset($_POST['allowcomments']) ? 1 : 0;
            $allowShare = isset($_POST['allowshare']) ? 1 : 0;


            // $statusCode Check
            if ($statusCode[0] == 'S' && strlen($statusCode) == 5) {
                for ($i = 1; $i < strlen($statusCode); $i++) {
                    if ($statusCode[$i] < '0' || $statusCode[$i] > '9') {
                        throw new Exception("Status code must start with 'S' and followed by numbers. Please provide a new status code.");
                    }
                }
            } else {
                throw new Exception("Status code must start with 'S' and followed by numbers and be length of 5. Please provide a new status code.");
            }

            $sqlQuery = "SELECT statuscode FROM statusTable WHERE statuscode = '$statusCode';";
            $sqlResult = mysqli_query($sqlConn, $sqlQuery);
            if ($sqlResult->num_rows > 0) {
                throw new Exception("Status code already exists. Please provide next status code.");
            }

            // $status Check
            if (strlen($status) <= 0 || preg_match("/[^a-zA-Z0-9\s,.!?]/", $status)) {
                throw new Exception("Your  status  is  in  a  wrong  format!  The  status  can  only  contain  
            alphanumericals and spaces, comma, period, exclamation point and question mark 
            and cannot be blank!");
            }

            // $date Check
            if (!DateTime::createFromFormat('Y-m-d', $date)) {
                throw new Exception("The date is invalid.");
            }

            $sqlQuery = "INSERT INTO statusTable (statusCode, status, date, share, allowLike, allowComments, allowShare) 
                    VALUES ('$statusCode', '$status', '$date', '$share', '$allowLike', '$allowComments', '$allowShare');";
            $sqlResult = mysqli_query($sqlConn, $sqlQuery);
            if (!$sqlResult) {
                throw new Exception("Error inserting into table.");
            }
            echo "Status code: $statusCode <br>";
            echo "Status: $status <br>";
            echo "Success!<br><br>";

            $sqlConn->close();
        }
        try {
            logic();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        ?>
        <p>
            <a href="http://jgh4138.cmslamp14.aut.ac.nz/assign1/index.html" class="left-link">Return to Home Page</a>
        </p>
    </body>
</div>
<html>