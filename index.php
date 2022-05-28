<?php
    session_start();
    include 'config/db_connect.php';
    include 'functions.php';
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
        <meta charset="utf8">
        <title><?=$site_title?></title>
    </head>
    <body>
        <div id='menu'>
            <b>Menu</b><br>
            <a href='?x=main'>Home page</a>
            <?php
                if(!isset($_SESSION['id'])) {
                    echo ' | <a href="?x=login">Login page</a> | <a href="?x=register">Registration</a>';
                }
            ?>
           <hr>

            <?php
                if (isset($_SESSION['id'])) {
                    echo "You are logged in as: <b>$username</b><br>";
                    echo '<a href="?x=logout">Log out</a><hr>';
                }
            ?>    
        </div>

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
            }
        }
        else {
            include('main.php');
        }
        ?>
    </body>
</html>