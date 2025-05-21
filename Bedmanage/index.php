<?php
session_start(); // Start the session at the very beginning

require_once('header.php');
require_once('connect.php'); // Ensure this file initializes $server
$error = "";

// Handle form submission
if (isset($_POST['save'])) {
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];

    if ($uname == "") {
        $error = "<br><span class=error>Please enter the username</span><br><br>";
    } elseif ($pword == "") {
        $error = "<br><span class=error>Please enter the password</span><br><br>";
    } else {
        $result = mysqli_query($server, "SELECT * FROM users WHERE uname='$uname' AND pword='$pword'");
        if (mysqli_num_rows($result) == 0) {
            $error = "<br><span class=error>Invalid Username/Password</span><br><br>";
        } else {
            $row = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            header("Location: dashboard.php"); // Corrected redirection
            exit(); // Ensure no further code is executed after redirection
        }
    }
}
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        /* General Body Styling */
        body {
            background: linear-gradient(135deg, #5a2364, #8f8749);
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        /* Marquee Styling */
        marquee {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px 0;
            font-size: 16px;
            font-weight: bold;
        }

        /* Container Styling */
        #containerHolder {
            margin-top: 50px;
            text-align: center;
        }

        /* Horizontal Line Styling */
        hr {
            width: 50%;
            margin: 20px auto;
            border: 1px solid #fff;
        }

        /* Headings Styling */
        h3 {
            margin-top: 20px;
            text-transform: uppercase;
            color: #fff;
            font-size: 25px;
        }

        h2 {
            text-transform: uppercase;
            font-size: 40px;
            color: #fff;
        }

        /* Fieldset Styling */
        fieldset {
            border: none;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            display: inline-block;
            width: 400px;
            color: #333;
        }

        /* Input Fields Styling */
        input[type="text"], input[type="password"] {
            margin-top: 10px;
            width: 100%;
            height: 45px;
            border-radius: 8px;
            outline: none;
            border: 1px solid #ccc;
            padding-left: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #5a2364;
            box-shadow: 0 0 8px rgba(90, 35, 100, 0.5);
            background-color: #f9f9f9;
        }

        /* Label Styling */
        label {
            margin-right: 10px;
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        /* Button Styling */
        .btnn {
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            background-color: #5a2364;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btnn:hover {
            background-color: #8f8749;
            transform: scale(1.05);
        }

        /* Error Message Styling */
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <marquee class="mt-3"><b>This is an Online Bed Allocation System. Using this, you can allocate beds to patients efficiently.</b></marquee>

    <div id="containerHolder">
        <div id="container">
            <!-- Breadcrumb Heading -->
            <h2>User Login</h2>
            <hr>
            <div id="main">
                <form method="post" class="jNice" name="frm1">
                    <h3>Login Form</h3>
                    <?php
                        if ($error != "") {
                            echo $error;
                        }
                    ?>
                    <fieldset>
                        <p><label>Username:</label><input type="text" name="uname" class="text-long" /></p>
                        <p><label>Password:</label><input type="password" name="pword" class="text-long" /></p>
                        <input class="btnn" type="submit" value="Log In" name="save" />
                    </fieldset>
                </form>
                <br /><br />
            </div>
            <!-- // #main -->
        </div>
    </div>

    <?php
        require_once('footer.php');
    ?>
</body>
</html>