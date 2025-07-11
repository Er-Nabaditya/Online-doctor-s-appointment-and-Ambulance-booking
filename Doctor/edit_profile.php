<?php 
session_start();
include('../includes/connection.php');
if(isset($_POST['update_profile'])){
    $query = "update doctors set name = '$_POST[name]',email = '$_POST[email]',mobile = $_POST[mobile] where id = $_SESSION[uid]";
    $query_result = mysqli_query($connection,$query);
    if($query_result){
        echo "<script type='text/javascript'>
                alert('Doctor updated successfully...');
            window.location.href = 'dashboard.php';  
            </script>";
    }
    else{
        echo "<script type='text/javascript'>
                alert('Error...Plz try again.');
                window.location.href = 'dashboard.php';
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
    <!-- External CSS File -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.min.js"></script>
    <!-- jQuery Files -->
    <script src="../includes/jquery_latest.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #5a2364;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            margin-top: 20px;
        }

        h5 {
            color: #333;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #5a2364;
            box-shadow: 0 0 5px rgba(90, 35, 100, 0.5);
        }

        .btn-primary {
            background-color: #5a2364;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #8e44ad;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            display: flex;
            justify-content: center;
            padding: 0;
        }

        nav ul li {
            list-style-type: none;
            margin: 15px;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 1.2rem;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container-fluid header">
        <h2>Online Appointment Booking System</h2>
    </div>

    <div class="container text-center mt-3">
        <h5>Doctor Panel!</h5>
    </div>
    <hr>
    <div class="container-fluid">
        <nav>
        <ul>
            <li><a class="btn btn-danger" href="dashboard.php">Go to Dashboard</a></li>
        </ul>
        </nav>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4 m-auto form-container">
        <h5 class="text-center mt-3">Edit Your Profile!</h5>
        <form action="" method="POST">
            <?php 
                $query = "select * from doctors where id = $_SESSION[uid]";
                $query_run = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($query_run)){
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="mobile" value="<?php echo $row['mobile']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update Profile" name="update_profile">
            </div>
            <?php
                }
            ?>
        </form>
        </div>
    </div>
</body>
</html>