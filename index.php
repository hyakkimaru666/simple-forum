<?php
    session_start();
    include 'db_connect.php';
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $request = "SELECT * FROM users WHERE id='$user_id'";
        $result = mysqli_query($db_connection, $request);
        $user = mysqli_fetch_assoc($result);
        $username = $user['username'];
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset='utf8'>
        <title><?=$site_title?></title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <center><h1>Simple-forum</h1>
        <i>by Dominik Gryszkiewicz</i></center>
        <hr>
        <div id='menu'>
            <center><a href='?x=main'>Home page</a>
            <?php
                if(!isset($_SESSION['id'])) {
                    echo ' | <a href="?x=login">Login page</a> | <a href="?x=register">Registration</a>';
                }
                else {
                    echo ' | <a href="?x=accountsettings">Account settings</a>';
                }
            ?>
           <hr>
           </center>

            <?php
                if (isset($_SESSION['id'])) {
                    echo "You are logged in as: <b>$username</b><br>";
                    echo '<a href="?x=logout">Log out</a><hr>';
                }
            ?>    
        </div>

        <?php
            if(isset($_GET['msg'])){
                if($_GET['msg'] == "threadadded") {
                    echo '<div class="success">Thread added!</div>';
                }
            }
        ?>

        <?php
        if(isset($_GET['x'])){
            switch($_GET['x']) {
                default:
                    include('404.php');
                    break;
                case 'main':
                    include('main.php');
                    break;
                case 'login':
                    include('login.php');
                    break;
                case 'logout':
                    include('logout.php');
                    break;
                case 'register':
                    include('register.php');
                    break;
                case 'thread':
                    include('thread.php');
                    break;
                case 'addthread':
                    include('addthread.php');
                    break;
                case 'accountsettings':
                    include('accountsettings.php');
                    break;
            }
        }
        else {
            include('main.php');
        }
        ?>
    </body>
</html>