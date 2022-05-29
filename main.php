<?php
    if(isset($_SESSION['id'])) {
        echo '<a href="?x=addthread">Add thread</a><hr>';
    }
    
    $request = 'SELECT * FROM threads ORDER BY id DESC';
    $result = mysqli_query($db_connection, $request);
    while($thread = mysqli_fetch_array($result)) {
        $creator_id = $thread['creator'];
        $request_creator = "SELECT username FROM users WHERE id='$creator_id'";
        $result2 = mysqli_query($db_connection, $request_creator);
        $creator = mysqli_fetch_assoc($result2);
        $time = date("F j, Y g:i a", strtotime($thread['time']));

        echo '<div class="thread"><i>Thread id: ' . $thread['id'] . '</i><hr>';
        echo '<h3><a href="?x=thread&id=' . $thread['id'] . '">' . $thread['subject'] . '</a></h3>';
        echo 'posted by: <b>' . $creator['username'] . '</b>';
        echo '<hr>' . $time;
        echo '</div>';
    }  
?>