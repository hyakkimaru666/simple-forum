<?php
    if(isset($_SESSION['id'])) {
        header('location: ?x=main');
    }
    
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])) {
        if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['repassword'])) {
            echo '<div class="error">You must fill the form to register!</div>';
        }
        else {
            $username = validate($_POST['username']);
            $password = md5(validate($_POST['password']));
            $repassword = md5(validate($_POST['repassword']));
            if ($password === $repassword) {
                $request = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($db_connection, $request);
                if(mysqli_num_rows($result) === 1) {
                    echo 'Error: User name is alredy taken!<br>';
                }
                else {
                    $request = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                    if($db_connection -> query($request) === TRUE) {
                        echo 'Registration succesfull!<br>';
                        echo '<a href ="?x=login">Go to login page</a>';
                    }
                    else {
                        echo 'Error: ' . $db_connection -> error;
                    }
                }
            }
            else {
                echo 'Error: You must enter two identical passwords!<br>';
            }
        }
    }
?>
<form action='?x=register' method='post'>
    <input type='text' name='username' placeholder='User name'><br>
    <input type='password' name='password' placeholder='Password'><br>
    <input type='password' name='repassword' placeholder='Repeat password'><br>
    <button type='submit'>Register</button>
</form>