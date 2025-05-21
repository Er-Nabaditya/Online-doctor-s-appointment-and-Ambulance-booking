<?php


  session_start();
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
  <!-- Internal CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 90%;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #5a2364;
      margin-bottom: 20px;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th, table td {
      border: 1px solid #ddd;
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

    .btn-accept {
      background: linear-gradient(90deg, #00c6ff 0%, #0072ff 100%);
      color: #fff;
      border: none;
      padding: 7px 18px;
      border-radius: 5px;
      font-weight: bold;
      font-size: 15px;
      box-shadow: 0 2px 8px rgba(0,123,255,0.08);
      transition: background 0.2s, transform 0.2s;
      margin-right: 5px;
    }

    .btn-accept:hover {
      background: linear-gradient(90deg, #0072ff 0%, #00c6ff 100%);
      transform: translateY(-2px) scale(1.04);
      color: #fff;
    }

    .btn-completed {
      background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
      color: #fff;
      border: none;
      padding: 7px 18px;
      border-radius: 5px;
      font-weight: bold;
      font-size: 15px;
      cursor: not-allowed;
      opacity: 1;
      box-shadow: 0 2px 8px rgba(67,233,123,0.12);
    }

    .btn-reject {
      background: linear-gradient(90deg, #ff5858 0%, #f857a6 100%);
      color: #fff;
      border: none;
      padding: 7px 18px;
      border-radius: 5px;
      font-weight: bold;
      font-size: 15px;
      transition: background 0.2s, transform 0.2s;
      margin-left: 5px;
    }

    .btn-reject:hover {
      background: linear-gradient(90deg, #f857a6 0%, #ff5858 100%);
      transform: translateY(-2px) scale(1.04);
      color: #fff;
    }

    .btn-rejected {
      background: linear-gradient(90deg, #ff5858 0%, #f857a6 100%);
      color: #fff;
      border: none;
      padding: 7px 18px;
      border-radius: 5px;
      font-weight: bold;
      font-size: 15px;
      cursor: not-allowed;
      opacity: 1;
      box-shadow: 0 2px 8px rgba(255,88,88,0.12);
    }

    .rejected-row {
      background: #ffeaea !important;
    }

    .no-data {
      text-align: center;
      color: #888;
      font-size: 18px;
      margin-top: 20px;
    }
    .block{
      color:gray;
    }
    .sno{
      color:black;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Today's Appointments</h1>
    <?php 
        include('../includes/connection.php');
        $today = date('y-m-d');
        // Add a "status" column in appointments table: 'pending', 'completed', 'rejected'
        $query = "SELECT a.*, 
                    (SELECT COUNT(*) FROM prescriptions p WHERE p.appointment_id = a.id) AS prescription_exists 
                  FROM appointments a 
                  WHERE a.doctor = '{$_SESSION['name']}' AND a.date = '$today'";
        $query_run = mysqli_query($connection, $query);
        $sno = 1;

        if (mysqli_num_rows($query_run) > 0): 
    ?>
      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th scope="col" class="block">S.No</th>
            <th scope="col" class="block">Patient Name</th>
            <th scope="col" class="block">Age</th>
            <th scope="col" class="block">Mobile No</th>
            <th scope="col" class="block">Email ID</th>
            <th scope="col" class="block">Appointment Time</th>
            <th scope="col" class="block">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($query_run)): ?>
            <?php
              // If you have a status column, use it. Otherwise, add it to your appointments table.
              $isRejected = (isset($row['status']) && $row['status'] === 'rejected');
            ?>
            <tr<?php if($isRejected) echo ' class="rejected-row"'; ?>>
              <th scope="row" class="sno"><?php echo $sno; ?></th> 
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['age']; ?></td>
              <td><?php echo $row['mobile']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['time']; ?></td>
              <td>
                <?php if($isRejected): ?>
                  <span class="btn btn-rejected" disabled>Rejected</span>
                <?php elseif($row['prescription_exists'] > 0): ?>
                  <span class="btn btn-completed" disabled>Completed</span>
                <?php else: ?>
                  <a class="btn btn-accept" href="accept_appointment.php?aid=<?php echo $row['id']; ?>">Accept</a>
                  <a class="btn btn-reject" href="reject_appointment.php?aid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to reject this appointment?');">Reject</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php 
              $sno++;
            endwhile; 
          ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="no-data">No appointments found for today.</p>
    <?php endif; ?>
  </div>
</body>

</html>