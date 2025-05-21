<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hospital Bed Management System</title>

    <!-- CSS -->
    <link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

    <!-- JavaScripts -->
    <script type="text/javascript" src="style/js/jquery.js"></script>
    <script type="text/javascript" src="style/js/jNice.js"></script>

    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Header Styling */
        #header {
            background: linear-gradient(90deg, #008B8B, #5a2364);
            color: white;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #header h1 {
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
        }

        /* Home Button Styling */
        .home-btn {
            padding: 10px 20px;
            background-color: #ffffff;
            color: #008B8B;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .home-btn:hover {
            background-color: #8e44ad;
            color: #ffffff;
        }

        /* Navigation Links (Optional) */
        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #f4f4f9;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div id="header">
        <!-- Home Button -->
        <a href="../index.php" class="home-btn">Home</a>

        <!-- Header Title -->
        <h1>Bed Booking System</h1>

        <!-- Navigation Links (Optional) -->
        <div class="nav-links">
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Help</a>
        </div>
    </div>

    <!-- Main Content -->
    <div id="wrapper">
        <!-- Navigation Bar -->
        <!-- Navigation bar content can go here -->
    </div>
</body>
</html>