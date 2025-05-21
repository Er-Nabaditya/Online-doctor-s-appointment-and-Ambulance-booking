<?php 
  session_start();
  if(isset($_SESSION['email'])){
  if(isset($_POST['add_doctor'])){
    include('../includes/connection.php');
    $query = "insert into doctors values(null,'$_POST[name]','$_POST[speciality]','$_POST[email]',null,$_POST[mobile])";
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script type='text/javascript'>
              alert('Doctor Added successfully...');
            window.location.href = 'admin_dashboard.php';  
          </script>";
    }
    else{
      echo "<script type='text/javascript'>
              alert('Error...please try again.');
            window.location.href = 'admin_dashboard.php';  
          </script>";
    }
  }

  if(isset($_POST['add_speciality'])){
    include('../includes/connection.php');
    $query = "insert into specialities values(null,'$_POST[speciality]')";
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script type='text/javascript'>
              alert('Speciality Added successfully...');
            window.location.href = 'admin_dashboard.php';  
          </script>";
    }
    else{
      echo "<script type='text/javascript'>
              alert('Error...please try again.');
            window.location.href = 'admin_dashboard.php';  
          </script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment Booking System</title>
  <!-- External CSS File -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- Bootstrap Files -->
  <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
  <script src="../bootstrap-5/js/bootstrap.min.js"></script>
  <!-- jQuery Files -->
  <script src="../includes/jquery_latest.js"></script>
  <!-- Internal CSS -->
  <style>
    /* General Styling */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    .header {
      background-color: #007bff;
      color: white;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .header h2 {
      margin: 0;
      font-size: 2rem;
    }

    nav ul {
      display: flex;
      justify-content: center;
      padding: 0;
      margin: 0;
      background-color: #343a40;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    nav ul li {
      list-style-type: none;
      margin: 10px;
    }

    nav ul li a {
      text-decoration: none;
      font-size: 1.2rem;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    nav ul li a:hover {
      background-color: #007bff;
      color: white;
    }

    .container-fluid {
      margin-top: 20px;
    }

    .container h5 {
      font-size: 1.5rem;
      color: #343a40;
    }

    .btn {
      font-size: 1rem;
      padding: 10px 20px;
      margin: 5px;
      border-radius: 5px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    #main_container {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #main_container h3 {
      color: #007bff;
      font-size: 1.8rem;
    }

    #main_container h5 {
      color: #343a40;
      font-size: 1.2rem;
    }

    dl dt {
      font-weight: bold;
      color: #007bff;
      margin-top: 10px;
    }

    dl dd {
      margin-left: 20px;
      color: #6c757d;
    }

    footer {
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 10px 0;
      margin-top: 20px;
    }
  </style>

</head>

<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="" href="../index.php">Home</a> <!-- Home Button -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <div class="container-fluid header">
    <h2>Online Appointment Booking System</h2>
  </div>

  <div class="container text-center mt-3">
    <h5>Welcome Admin Panel : Mr <?php echo $_SESSION['name'];?></h5>
  </div>
  <hr>
  <div class="container-fluid">
    <nav>
      <ul>
        <li><a class="btn btn-primary" href="admin_dashboard.php">Dashboard</a></li>
        <li><a class="btn btn-success" id="add_doctor">Add Doctor</a></li>
        <li><a class="btn btn-warning" id="view_doctor">View Doctor</a></li>
        <li><a class="btn btn-info" id="add_speciality">Add Speciality</a></li>
        <li><a class="btn btn-secondary" id="view_speciality">View Speciality</a></li>
         <li><a class="btn btn-warning" href="patientappo.php" id="patientappo">View Patient</a></li>
        <li><a  class="btn btn-danger" href="../logout.php">Logout</a></li>
      </ul>
    </nav>
  </div>
  <hr>
  
  <div class="row">
    <div class="col-md-8 m-auto" id="main_container">
      <h3>Welcome to Admin dashboard Page!</h3><hr>
      <h5>Admin can perform the following operations -</h5>
      <dl>
        <dt>1. Add Doctors</dt>
        <dd>Admin can add a new doctor to the panel.</dd>
        <dt>2. view Doctors</dt>
        <dd>Admin can view all the doctors and he can also edit and delete any doctor.</dd>
        <dt>3. Add Speciality</dt>
        <dd>Admin can add a new specility to the hospital.</dd>
        <dt>4. View Speciality</dt>
        <dd>Admin can view all the specilities and he can also edit and delete any specility.</dd>
        <dt>5. Logout</dt>
        <dd>Admin can logout himself from the admin panel.</dd>
      </dl>
    </div>
  </div>

  <!-- jQuery -->
  <script type="text/javascript">
    $(document).ready(function(){
      $("#add_doctor").click(function(){
        $("#main_container").load("add_doctor.php");
        });
    });

    $(document).ready(function(){
      $("#view_doctor").click(function(){
        $("#main_container").load("view_doctor.php");
        });
    });

    $(document).ready(function(){
      $("#add_speciality").click(function(){
        $("#main_container").load("add_speciality.php");
        });
    });

    $(document).ready(function(){
      $("#view_speciality").click(function(){
        $("#main_container").load("view_speciality.php");
        });
    });
  </script>

</body>

</html>
<?php
    }
    else{
        header('Location:login.php');
    }
?>