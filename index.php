<?php


if(isset($_POST['book_appointment'])){
    include('includes/connection.php');

    // Check if the selected time slot is already booked for the doctor on that date
    $query1 = "SELECT * FROM appointments WHERE doctor = '$_POST[doctor]' AND date = '$_POST[date]' AND time = '$_POST[time]'";
    $query_run1 = mysqli_query($connection, $query1);
    $noa = mysqli_num_rows($query_run1);

    // Check for unique email, mobile, and time
    $query2 = "SELECT * FROM appointments WHERE email = '$_POST[email]' OR mobile = '$_POST[mobile]' OR (date = '$_POST[date]' AND time = '$_POST[time]')";
    $query_run2 = mysqli_query($connection, $query2);
    $nou = mysqli_num_rows($query_run2);

    if($noa > 0){
        echo "<script type='text/javascript'>
                alert('Appointment not available for this time slot.');
                window.location.href = 'index.php';  
            </script>";
        exit;
    } else if($nou > 0){
        echo "<script type='text/javascript'>
                alert('Email, Mobile, or Time already exists. Please use unique details.');
                window.location.href = 'index.php';  
            </script>";
        exit;
    } else {
        // Insert the appointment with manual time selection
        $query = "INSERT INTO appointments 
        (name, age, gender, address, email, mobile, date, time, status, speciality, doctor)
        VALUES (
          '$_POST[name]',
          $_POST[age],
          '$_POST[gender]',
          '$_POST[address]',
          '$_POST[email]',
          '$_POST[mobile]',
          '$_POST[date]',
          '$_POST[time]',
          'pending',
          '$_POST[speciality]',
          '$_POST[doctor]'
        )";
        $query_run = mysqli_query($connection, $query);
        if($query_run){
            echo "<script type='text/javascript'>
                    alert('Appointment Booked for: {$_POST['date']} at {$_POST['time']}');
                    window.location.href = 'index.php';  
                </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('Error...please try again.');
                    window.location.href = 'index.php';  
                </script>";
        }
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
  <link rel="stylesheet" href="css/style.css">
  <!-- Bootstrap Files -->
  <link rel="stylesheet" href="bootstrap-5/css/bootstrap.min.css">
  <script src="bootstrap-5/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .header {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
      padding: 50px 0;
      text-align: center;
    }
    .header h2 {
      font-size: 3em;
      margin-bottom: 20px;
    }
    .btnone, .btntwo, .btnadmin, .btndoctor {
      color: white;
      text-decoration: none;
      margin: 10px;
      padding: 10px 20px;
      border-radius: 5px;
      background-color: #28a745;
      display: inline-block;
    }
    .btnone:hover, .btntwo:hover, .btnadmin:hover, .btndoctor:hover {
      background-color: #218838;
      color: white;
      text-decoration: none;
    }
    .marquee {
      background-color: #ff4742;
      color: white;
      padding: 10px 0;
      font-size: 1.2em;
      text-align: center;
    }
    .form-container {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 30px;
    }
    .form-container h4 {
      margin-bottom: 20px;
      font-size: 1.5em;
      color: #333;
    }
    .card {
      background-color: #ffffff;
      color: black;
      padding: 20px;
      height: auto;
      margin-bottom: 25px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .card img {
      width: 50px;
      height: 50px;
      margin-bottom: 10px;
    }
    .card-title {
      font-size: 1.5em;
      margin-bottom: 10px;
      color: #333;
    }
    .card-text {
      font-size: 1.2em;
      color: #555;
    }
    footer {
      background-color: #343a40;
      color: white;
      padding: 20px 0;
      text-align: center;
      margin-top: 30px;
    }
    footer a {
      color: #17a2b8;
      text-decoration: none;
    }
    footer a:hover {
      color: #0dcaf0;
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      background: linear-gradient(to right, #e0f7fa, #ede7f6);
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }
    header {
      width: 100%;
      background: linear-gradient(to right, #26a69a, #7e57c2);
      display: flex;
      justify-content: space-evenly;
      padding: 20px 0;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .nav-button {
      background: transparent;
      border: none;
      text-align: center;
      color: white;
      cursor: pointer;
      transition: transform 0.3s, filter 0.3s;
    }
    .nav-button:hover {
      transform: scale(1.1);
      filter: brightness(1.2);
      color:white;
    }
    .nav-button img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      border: 2px solid white;
      margin-bottom: 5px;
    }
    .nav-button span {
      display: block;
      font-size: 0.95em;
      font-weight: 500;
    }
    @media (max-width: 768px) {
      header {
        flex-wrap: wrap;
      }
      .nav-button {
        margin: 10px;
      }
    }
    a{
      text-decoration: none;
      color: #e0f7fa;
    }
  </style>
</head>

<body>
  <!--  Header part -->
<header>
    <button class="nav-button">
     <a href="admin/login.php"> <img src="https://img.icons8.com/ios-filled/100/ffffff/admin-settings-male.png" alt="Admin">
      <span>Admin</span>
    </a>
    </button>
    <button class="nav-button">
     <a href="doctor/dashboard.php"> <img src="https://img.icons8.com/ios-filled/100/ffffff/doctor-male.png" alt="Doctor">
      <span>Doctor</span>
    </a>
    </button>
    <button class="nav-button">
      <a href="Bedmanage/index.php"><img src="https://img.icons8.com/ios-filled/100/ffffff/hospital-bed.png" alt="Bed Booking">
      <span>Bed Booking</span>
    </a>
    </button>
    <button class="nav-button">
     <a href="Ambulance_booking/index.php"> <img src="https://img.icons8.com/ios-filled/100/ffffff/ambulance.png" alt="Ambulance">
      <span>Ambulance</span>
    </a>
    </button>
  </header>

  <div class="container-fluid marquee">
   <marquee behavior="" direction=""> <b>This is an Online Appointment Booking System Project mainly for doctors and patients, where a patient can book their appointment before visiting the hospital.</b></marquee>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto form-container">
        <h4 class="text-center">Book Your Appointment Here!</h4>
        <form action="" method="POST">
          <div class="row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Patient Name" name="name" required>
            </div>
            <div class="col">
              <input type="number" class="form-control" placeholder="Patient Age" name="age" min="0" required>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <select class="form-control" name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Address" name="address" required>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <input type="email" class="form-control" placeholder="Email ID" name="email" required>
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Mobile No" name="mobile" required>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <input type="date" class="form-control" placeholder="Select Date" name="date" id="date" required>
            </div>
            <div class="col">
              <input type="time" class="form-control" name="time" id="time" required>
              <small id="currentTime" style="color:#007bff;"></small>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <select class="form-control" name="speciality" id="speciality" required>
                <option value="not selected">Select Speciality</option>
              </select>
            </div>
            <div class="col">
              <select class="form-control" name="doctor" id="doctor" required>
                <option value="not selected">Select Doctor</option>
              </select>
            </div>
          </div>
          <div class="row mt-3 mb-5">
            <div class="col-md-3 m-auto">
              <input type="submit" class="btn btn-success mt-3" value="Book Appointment" name="book_appointment">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg">
        <div class="card">
          <img src="images/location.svg" alt="Address Icon">
          <div class="card-body">
            <h5 class="card-title">Our Address:</h5>
            <p class="card-text">F-34, Near Senapti's Boys Hostel, Kalinga Vihar, Patrapada, Bhubaneswar.</p>
          </div>
        </div>
      </div>
      <div class="col-lg">
        <div class="card">
          <img src="images/phone.svg" alt="Phone Icon">
          <div class="card-body">
            <h5 class="card-title">Phone No:</h5>
            <p class="card-text">+91 6370652632</p>
          </div>
        </div>
      </div>
      <div class="col-lg">
        <div class="card">
          <img src="images/email.svg" alt="Email Icon">
          <div class="card-body">
            <h5 class="card-title">Email:</h5>
            <p class="card-text">bhutianabaditya@gmail.com</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Online Appointment Booking System. All Rights Reserved. | <a href="#">Privacy Policy</a></p>
  </footer>

  <script type="text/javascript" src="includes/jquery_latest.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    // Set min date to today for the date input
    var today = new Date();
    var yyyy = today.getFullYear();
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var dd = String(today.getDate()).padStart(2, '0');
    var minDate = yyyy + '-' + mm + '-' + dd;
    $("#date").attr("min", minDate);

    // Restrict time input between 08:00 and 20:00
    $("#time").attr("min", "08:00");
    $("#time").attr("max", "20:00");

    // Prevent booking outside allowed time range
    $("form").on("submit", function(e){
        var timeVal = $("#time").val();
        if(timeVal < "08:00" || timeVal > "20:00") {
            alert("You can only book a slot between 08:00 and 20:00.");
            e.preventDefault();
        }
    });

    // Show current time below the time input
    function showCurrentTime() {
      var now = new Date();
      var h = now.getHours().toString().padStart(2, '0');
      var m = now.getMinutes().toString().padStart(2, '0');
      var s = now.getSeconds().toString().padStart(2, '0');
      $("#currentTime").text("Current Time: " + h + ":" + m + ":" + s);
    }
    showCurrentTime();
    setInterval(showCurrentTime, 1000);

    function loadData(type, spcl){
      $.ajax({
        url: "load-doctor.php",
        type: "POST",
        data: {type: type, spcl: spcl},
        success: function(data){
          if(type == "doctorData"){
            $("#doctor").html(data);
          } else {
            $("#speciality").append(data);
          }
        }
      });
    }
    loadData();
    $("#speciality").on("change", function(){
      var spcl = $("#speciality").val();
      loadData("doctorData", spcl);
    });
  });
  </script>
</body>
</html>