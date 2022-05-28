<?php
    $request = 'SELECT * FROM threads';
    $result = mysqli_query($db_connection, $request);
    while($thread = mysqli_fetch_array($result)) {
        $creator_id = $thread['creator'];
        $request_creator = "SELECT username FROM users WHERE id='$creator_id'";
        $result2 = mysqli_query($db_connection, $request_creator);
        $creator = mysqli_fetch_assoc($result2);

        echo 'Thread id: ' . $thread['id'];
        echo '<h3><a href="?x=thread&id=' . $thread['id'] . '">' . $thread['subject'] . '</a></h3>';
        echo 'posted by: ' . $creator['username'] . '<hr>';
    }  
?>