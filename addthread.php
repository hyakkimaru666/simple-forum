<?php
    if(!isset($_SESSION['id'])) {
        echo '<div class="error">You must be logged in to add post!</div>';
        exit();
    }
    else {
        if(isset($_POST['subject']) && isset($_POST['content'])) {
            if(empty($_POST['subject']) || empty($_POST['content'])) {
                echo '<div class="error">You must enter subject and content to add a thread!</div>';
            }
            else {
                $subject = validate($_POST['subject']);
                $content = validate($_POST['content']);
                $creator = $_SESSION['id'];
                $request = "INSERT INTO threads (subject, content, creator) VALUES ('$subject', '$content', '$creator')";
                if($db_connection -> query($request) === true) {
                    header('Location: ?x=main&msg=threadadded');
                }
                else {
                    echo '<div class="error">Error: ' . $db_connection -> error . '</div>';
                }
            }
        }
        echo '<h3>Add thread:</h3>';
        echo '<form action="?x=addthread" method="post">';
        echo '<input type="text" name="subject" placeholder="Subject"><br>';
        echo '<textarea name="content" rows="4" cols="50"></textarea><br>';
        echo '<button type="submit">Add thread</button>';
        echo '</form>';
    }
?>