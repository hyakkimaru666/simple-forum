<?php
    if(isset($_SESSION['id'])) {
        header('location: ?x=main');
    }

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = validate($_POST['username']);
        $password = md5(validate($_POST['password']));
        if (empty($username) || empty($password)) {
            echo 'To login enter user name and password!<br>';
        }
        else {
            $request = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($db_connection, $request);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if($row['username'] === $username && $row['password'] === $password){
                    echo 'Logged in succesfully!<br>';
                    $_SESSION['id'] = $row['id'];
                    header('location: ?x=main');
                }
                else {
                    echo 'Wrong username or password!<br>';
                }
            }
            else {
                echo 'Wrong username or password!<br>';
            }
        }
    }
?>

<form action='?x=login' method='post'>
    <input type='text' name='username' placeholder='User name'><br>
    <input type='password' name='password' placeholder='Password'><br>
    <button type='submit'>Log in</button> 
</form>