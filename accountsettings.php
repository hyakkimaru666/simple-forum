<?php
    if(!isset($_SESSION['id'])) {
        echo '<div class="error">You must be logged in to view this page!</div>';
    }
    else {
        if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['renew_password'])) {
            $old_password = md5(validate($_POST['old_password']));
            $new_password = md5(validate($_POST['new_password']));
            $renew_password = md5(validate($_POST['renew_password']));
            if($new_password != $renew_password) {
                echo '<div class="error">You repeated new password wrong!</div>';
            }
            else {
                if($user['password'] != $old_password) {
                    echo '<div class="error">Old password is different!</div>';
                }
                else {
                    $request = "UPDATE users SET password='$new_password' WHERE id='$user_id'";
                    if($db_connection -> query($request) === true) {
                        echo '<div class="success">Password changed!</div>';
                    }
                    else {
                        echo '<div class="error">Error: ' . $db_connection -> error . '</div>';
                    }
                }
            }
        }
        echo '<h3>Change your password:</h3>';
        echo '<form action="?x=accountsettings" method="post">';
        echo '<input type="password" name="old_password" placeholder="Old password"><br>';
        echo '<input type="password" name="new_password" placeholder="New password"><br>';
        echo '<input type="password" name="renew_password" placeholder="Repeat new password"><br>';
        echo '<button type="submit">Change password</button>';
        echo '</form>';
    }
?>