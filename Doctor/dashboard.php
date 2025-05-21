<?php 
  session_start();
  if(isset($_SESSION['email'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Dashboard</title>
  <!-- External CSS File -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- Bootstrap Files -->
  <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
  <script src="../bootstrap-5/js/bootstrap.min.js"></script>
  <!-- jQuery Files -->
  <script src="../includes/jquery_latest.js"></script>
  <!-- Internal CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #5a2364;
    }

    .navbar-brand {
      color: #fff !important;
      font-size: 1.5rem;
      font-weight: bold;
    }

    .navbar-nav .nav-link {
      color: #fff !important;
      font-size: 1.2rem;
    }

    .navbar-nav .nav-link:hover {
      color: #d1c4e9 !important;
    }

    .header {
      background-color: #8e44ad;
      color: #fff;
      padding: 20px;
      text-align: center;
      border-bottom: 5px solid #5a2364;
    }

    nav ul {
      display: flex;
      justify-content: center;
      padding: 0;
      margin: 0;
    }

    nav ul li {
      list-style-type: none;
      margin: 10px;
    }

    nav ul li a {
      text-decoration: none;
      font-size: 1.2rem;
      padding: 10px 20px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    nav ul li a.btn-primary {
      background-color: #5a2364;
      color: #fff;
    }

    nav ul li a.btn-primary:hover {
      background-color: #8e44ad;
    }

    nav ul li a.btn-success {
      background-color: #27ae60;
      color: #fff;
    }

    nav ul li a.btn-success:hover {
      background-color: #2ecc71;
    }

    nav ul li a.btn-warning {
      background-color: #f39c12;
      color: #fff;
    }

    nav ul li a.btn-warning:hover {
      background-color: #f1c40f;
    }

    nav ul li a.btn-danger {
      background-color: #e74c3c;
      color: #fff;
    }

    nav ul li a.btn-danger:hover {
      background-color: #c0392b;
    }

    #main_container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    h3 {
      color: #5a2364; /* Changed heading color to purple */
      font-weight: bold;
    }

    h5 {
      color: #333;
    }

    dl dt {
      font-weight: bold;
      color: #5a2364;
    }

    dl dd {
      margin-left: 20px;
      color: #555;
    }

    .highlight {
      color: #e74c3c; /* Red color for emphasis */
      font-weight: bold;
      font-size: 1.5rem; /* Larger font size */
      background-color: #f9e79f; /* Light yellow background */
      padding: 5px 10px;
      border-radius: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th, table td {
      border: 1px solid #ddd; /* Made table column borders visible */
      padding: 10px;
      text-align: center;
    }

    table th {
      background-color: #5a2364;
      color: #fff;
      text-transform: uppercase;
    }

    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    table tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Doctor Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a> <!-- Home Button -->
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid header">
    <h2>Online Appointment Booking System</h2>
  </div>

  <div class="container text-center mt-3">
    <h5>Doctor Name: <span class="highlight"><?php echo $_SESSION['name']; ?></span></h5>
  </div>
  <hr>
  <div class="container-fluid">
    <nav>
      <ul>
        <li><a class="btn btn-primary" href="dashboard.php">Dashboard</a></li>
        <li><a class="btn btn-success" id="view_appointments">View Appointments</a></li>
        <li><a class="btn btn-warning" href="edit_profile.php">Edit Profile</a></li>
        <li><a class="btn btn-danger" href="../logout.php">Logout</a></li>
      </ul>
    </nav>
  </div>
  <hr>

  <div class="container" id="main_container">
    <h3>Welcome to Doctor Dashboard Page!</h3>
    <hr>
    <h5>Doctor can perform the following operations -</h5>
    <dl>
      <dt>1. Check Appointments</dt>
      <dd>Doctor can view all the appointments for the day and he can also delete any appointments.</dd>
      <dt>2. Edit Profile</dt>
      <dd>Doctor can edit his/her profile.</dd>
      <dt>3. Logout</dt>
      <dd>Admin can logout himself from the admin panel.</dd>
    </dl>
  </div>

  <!-- jQuery -->
  <script type="text/javascript">
    $(document).ready(function(){
      $("#view_appointments").click(function(){
        $("#main_container").load("appointments.php");
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