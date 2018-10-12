<?php

// make db conection

require('db2.php');

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) ||
        empty($_POST['password'])) {
        $error = "username or password is empty";
    } else {
    //save username $ password in a variable    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 2. prepare query
    $query  = "SELECT username, password "; 
    $query .= "FROM users ";
    $query .= "WHERE username = '$username' AND password = '$password' ";
    // 2. Excute query
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        die("query is wrong");
    }
    // Check how many answers did we get
    $numrows=mysqli_num_rows($result);
    if ($numrows == 1) {
        //Start to use sessions
        session_start();
        //Create session variable
        $_SESSION['login_user']=$username;
        header('Location: Club.php');
        
    } else {
        echo "Login failed";
    }
    
    // 4. free results
    mysqli_free_result($result);
    }
}

// 5. close db connection
mysqli_close($connection);

?>

<?php

require('header.php');
?>

<form action="login.php" method="POST">
<label>Username</label>
<input type ="text" name="username"
       placeholder="username"><br/>
<label>Password</label>
<input type="password" name="password"
       placeholder="password"><br/>
<input type="submit" name="submit"
       value="Login">
</form>
