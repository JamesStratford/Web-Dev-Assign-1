<html>

<head>
    <title>Post status</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<style>
    .labels {
        display: inline-block;
        width: 100px;
        text-align: left;
    }

    .input_bar {
        display: inline-block;
        width: 500px;
        text-align: left;
    }

    .statusCode_bar {
        display: inline-block;
        width: 50px;
        text-align: left;
    }

    body {
        background-color: #feffb4;
    }
</style>

<h1> Status Posting System </h1>

<body>
    <form action="http://jgh4138.cmslamp14.aut.ac.nz/assign1/poststatusprocess.php" method="post">
        <?php
        include('sqlGetter.php');

        function logic()
        {
            // DB SQL connection
            require_once('../../conf/mysqlcredentials.inc.php');
            $sqlConn = OpenSQLCon($dbhost, $dbuser, $dbpass, $db);

            // If table exists... 
            if (checkForTable($sqlConn, $db, $dbtable)) {
                // This logic is taking the last known status code and incrementing it by 1
                $sqlQuery = "SELECT * FROM statusTable ORDER BY statusCode DESC LIMIT 1;";
                $sqlResult = mysqli_query($sqlConn, $sqlQuery);
                $sqlArray = mysqli_fetch_array($sqlResult);
                $statusCode = $sqlArray['statusCode'];
                $nextStatusCode = substr($statusCode, 1, 4) + 1;
                $nextStatusCode = sprintf("%04d", $nextStatusCode);
                // ------------------------------------------------
        
                echo '<p>';
                echo '<label for="statuscode" class="labels">Status code:</label>';
                echo '<input type="text" name="statuscode" maxlength="5" class="statusCode_bar" value="S' . $nextStatusCode . '" required /><br>';
                echo '</p>';
            } else {
                echo '<p>';
                echo '<label for="statuscode" class="labels">Status code:</label>';
                echo '<input type="text" name="statuscode" maxlength="5" value="S0000" class="statusCode_bar" required /><br>';
                echo '</p>';
            }

            $sqlConn->close();
        }

        try {
            logic();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <p>
            <label for="statuscode" class="labels">Status:</label> <input type="text" name="status" maxlength="140"
                class="input_bar" required /><br>
        </p>
        <p>
            <label for="share" class="labels">Share:</label>
            <input type='radio' name='share' value='public' required /><label for="public" class="labels">Public</label>
            <input type='radio' name='share' value='friends' /><label for="friends" class="labels">Friends</label>
            <input type='radio' name='share' value='onlyme' /><label for="onlyme" class="labels">Only me</label>
        </p>
        <p>
            <?php
            $date = new DateTime();
            echo '<label for="date" class="labels">Date:</label> ';
            echo '<input type="date" value="' . $date->format("Y-m-d") . '" name="date" size="30" maxlength="140"
                    class="input_bar" required /><br>';
            ?>
        </p>
        <p>
            <label for="share" class="labels">Share:</label>
            <input type='checkbox' name='allowlike' value='true' /><label for="allowlike">Allow Like</label>
            <input type='checkbox' name='allowcomments' value='true' /><label for="allowcomments">Allow
                Comments</label>
            <input type='checkbox' name='allowshare' value='true' /><label for="allowshare">Allow Share</label>
        </p>
        <p>
            <input type='submit' value='Post' />
        </p>

    </form>

    <a href="http://jgh4138.cmslamp14.aut.ac.nz/assign1/index.html">Return to Home Page</a>
</body>

</html>