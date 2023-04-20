<html>
<head>
        <title>Search Results</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    </head>
<h1> Status Posting System </h1>
<div class="content">
    <?php
    include('sqlGetter.php');
    function logic()
    {
        $searchQuery = $_GET['Search'];

        if (strlen($searchQuery) <= 0) {
            throw new Exception("The search string is empty, please enter a keyword to search.<br><br>");
        }

        $searchQuery = strtolower($searchQuery);

        // DB SQL connection
        require_once('../../conf/mysqlcredentials.inc.php');
        $sqlConn = OpenSQLCon($dbhost, $dbuser, $dbpass, $db);

        if (!checkForTable($sqlConn, $db, $dbtable)) {
            throw new Exception("No status found. Please go to the post status page to post one.<br>" . 
            "<p><a href='http://jgh4138.cmslamp14.aut.ac.nz/assign1/poststatusform.php'>Post status</a></p>");
        }

        $sqlQuery = "SELECT * FROM statusTable
                WHERE status LIKE '%$searchQuery%'
                ORDER BY status ASC;";

        $sqlResult = mysqli_query($sqlConn, $sqlQuery);

        // Display Results
        while ($sqlArray = mysqli_fetch_array($sqlResult)) {
            echo "<p> ";
            echo "---------------------------------------------<br>";
            echo "<label class=\"labels\">Status:</label><label class=\"output_block\">" . $sqlArray['status'] . "</label><br>";
            echo "<label class=\"labels\">Status code:</label> <label class=\"output_block\">" . $sqlArray['statusCode'] . "</label><br>";
            echo "<br>";
            echo "<label class=\"labels\">Share:</label><label class=\"output_block\">" . $sqlArray['share'] . "</label><br>";
            echo "<label class=\"labels\">Date:</label><label class=\"output_block\">" . $sqlArray['date'] . "</label><br>";
            $out = $sqlArray['allowLike'] ? "Allow Like; " : "";
            $out = $out . ($sqlArray['allowComments'] ? "Allow Comment; " : "");
            $out = $out . ($sqlArray['allowShare'] ? "Allow Share; " : "");
            echo "<label class=\"labels\">Permission:</label><label class=\"output_block\">" . $out . "</label><br>";
            echo "---------------------------------------------";
            echo "</p>";
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
    <a href="http://jgh4138.cmslamp14.aut.ac.nz/assign1/searchstatusform.html" class="left-link">
        Search status
    </a>
        <a href="http://jgh4138.cmslamp14.aut.ac.nz/assign1/index.html" class="right-link">Return to Home Page</a>
    </p>
</div>

</html>