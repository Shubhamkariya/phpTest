

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            inline-size: -webkit-fill-available;
            }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <p>Please enter your credentials to log in.</p>
        <form action="login.php" method="POST">
            <label for="username"><b>Username or Email</b></label>
            <input type="text" id="username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Log In</button>
        </form>
        <p style="text-align: center;">Don't have an account? <a href="signup.php">Register</a></p>

    </div>
</body>
</html>


<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = $1 OR phone =$1  AND password = $2";
    $result = pg_query_params($connection, $query, array($username, $password));

    if (pg_num_rows($result) == 1) {
        
        header("Location: newquiz.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username or password'); window.location.href = 'login.php';</script>";
    }

    pg_free_result($result);
}
?>


