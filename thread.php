<?php
    if(!isset($_GET['id'])){
        header('location: ?x=main');
    }
    else {
        $thread_id = $_GET['id'];
        $request = "SELECT * FROM threads WHERE id='$thread_id'";
        $result = mysqli_query($db_connection, $request);
        if(mysqli_num_rows($result) === 0) {
            echo 'It looks like there is no such thread. Maybe it got deleted :(<br>';
            echo '<a href="?x=main">Go back to the home page</a>';
            exit();
        }
        else {
            $thread = mysqli_fetch_assoc($result);
            $creator_id = $thread['creator'];
            $request_creator = "SELECT username FROM users WHERE id='$creator_id'";
            $result2 = mysqli_query($db_connection, $request_creator);
            $creator = mysqli_fetch_assoc($result2);

            echo 'Thread id: ' . $thread['id'];
            echo '<h3>' . $thread['subject'] . '</h3>';
            echo 'posted by: ' . $creator['username'] . '<hr>';
            echo validate($thread['content']);
            echo '<hr>';
        }
    }
?>