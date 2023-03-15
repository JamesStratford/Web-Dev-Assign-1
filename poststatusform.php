<html>
<style>
    .labels {
        display: inline-block;
        width: 75px;
        text-align: left;
    }

    .input_bar {
        display: inline-block;
        width: 500px;
        text-align: left;
    }

    .input_bar {
        display: inline-block;
        width: 500px;
        text-align: left;
    }

    body {
        background-color: #feffb4;
    }
</style>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<head>
    <title>My Website</title>
    <style>
        .center {
            text-align: center;
        }
    </style>
</head>
<h1> Status Posting System </h1>

<body>
    <form action="poststatusprocess.php" method="post">
        <p>
            <label for="statuscode" class="labels">Status code:</label> <input type='text' name='statuscode'
                maxlength='5' class="input_bar" required /><br>
        </p>
        <p>
            <label for="statuscode" class="labels">Status:</label> <input type='text' name='status' maxlength='140'
                class="input_bar" required /><br>
        </p>
        <p>
            <label for="share" class="labels">Share:</label>
            <input type='radio' name='share' value='public' /><label for="public" class="labels">Public</label>
            <input type='radio' name='share' value='friends' /><label for="friends" class="labels">Friends</label>
            <input type='radio' name='share' value='onlyme' /><label for="onlyme" class="labels">Only me</label>
        </p>
        <p>
            <label for="date" class="labels">Date:</label> <input type='date' name='date' size='30' maxlength='140'
                class="input_bar" required /><br>
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
    
    <a href="/index.html">Return to Home Page</a>
</body>

</html>