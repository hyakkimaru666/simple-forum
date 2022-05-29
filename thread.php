<?php
    if(!isset($_GET['id'])){
        header('location: ?x=404');
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

            if(isset($_POST['comment_content'])){
                if(empty($_POST['comment_content'])){
                    echo '<div class="error">You must enter a content before adding a comment!</div>';
                }
                else {
                    $comment_content = validate($_POST['comment_content']);
                    $creator_id = $_SESSION['id'];
                    $request = "INSERT INTO comments (content, thread_id, creator) VALUES ('$comment_content', '$thread_id', '$creator_id')";
                    if($db_connection -> query($request) === true) {
                        echo '<div class="success">Comment added!</div>';
                    }
                    else {
                        echo 'Error: ' . $db_connection -> error;
                    }
                }
            }

            $thread = mysqli_fetch_assoc($result);
            $creator_id = $thread['creator'];
            $request_creator = "SELECT username FROM users WHERE id='$creator_id'";
            $result2 = mysqli_query($db_connection, $request_creator);
            $creator = mysqli_fetch_assoc($result2);
            $time = date("F j, Y g:i a", strtotime($thread['time']));

            echo '<div class="thread"><i>Thread id: ' . $thread['id'] . '</i><hr>';
            echo '<h3>' . $thread['subject'] . '</h3>';
            echo 'posted by: <b>' . $creator['username'] . '</b><hr>';
            echo $thread['content'];
            echo '<hr>' . $time;
            echo '</div>';

            echo '<h3>Comments:</h3>';

            $request = "SELECT * FROM comments WHERE thread_id='$thread_id'";
            $result = mysqli_query($db_connection, $request);
            if(mysqli_num_rows($result) === 0) {
                echo "It looks like there is not comments in this thread :(";
            }
            while($comment = mysqli_fetch_assoc($result)) {
                $creator_id = $comment['creator'];
                $request_creator = "SELECT username FROM users WHERE id='$creator_id'";
                $result2 = mysqli_query($db_connection, $request_creator);
                $creator = mysqli_fetch_assoc($result2);
                $time = date("F j, Y g:i a", strtotime($comment['time']));

                echo '<div class="comment">posted by: <b>' . $creator['username'] . '</b><hr>';
                echo $comment['content'];
                echo '<hr>' . $time;
                echo '</div>';
            }

            if(!isset($_SESSION['id'])) {
                echo '<h3><i>You must be logged in to comment!</i></h3>';
            }
            else {
                echo '<h3>Add comment:</h3>';
                echo '<form action="?x=thread&id=' . $_GET['id'] . '" method="post">';
                echo '<textarea name="comment_content" rows="4" cols="50"></textarea><br>';
                echo '<button type="submit">Add comment</button>';
                echo '</form>';
            }
        }
    }
?>