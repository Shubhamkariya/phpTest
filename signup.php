<!DOCTYPE html>
<html>
<head>
    <title>Signup Form</title>
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
        input[type="email"],
        input[type="number"],
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
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <form action="signup.php" method="POST">
            <label for="name"><b>Name</b></label>
            <input type="text" id="name" name="name" required>

            <label for="email"><b>Email</b></label>
            <input type="email" id="email" name="email" required>

            <label for="phone"><b>Phone No</b></label>
            <input type="text" id="mobile" name="mobile" pattern="[0-9]{10}" required title="Please enter a 10-digit mobile number">

            <label for="password"><b>Password</b></label>
            <input type="password" id="password" name="password" required>

            
            <button type="submit">Sign Up</button>
        </form>
        <p style="text-align: center;">Already have an account? <a href="login.php">Login</a></p>

    </div>
</body>
</html>

<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['email'];
    $phone = $_POST['mobile'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (name,username,phone,password) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($connection, $query, array($name, $username, $phone, $password));

    if ($result) {
    
        echo "<script>alert('Registration successful. Click OK to go to the login page.'); window.location.href = 'login.php';</script>";
    } else {
        $error_message = pg_last_error($connection);
        echo "PostgreSQL query error: " . $error_message;

    }

    pg_free_result($result);
}
