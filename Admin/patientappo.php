<?php
session_start();

// Database connection
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Database selection
$db = mysqli_select_db($con, "oabs");
if (!$db) {
    die("Database selection failed: " . mysqli_error($con));
}

// Query to fetch appointments
$query = "SELECT * FROM appointments";
$result = mysqli_query($con, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Appointments</title>
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
            color: #333;
            margin-bottom: 20px;
        }

        .home-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px 20px;
            text-align: center;
            background-color: #5a2364;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .home-btn:hover {
            background-color: #8f3b8a;
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

        .no-data {
            text-align: center;
            color: #888;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient Appointments</h1>
        <a href="admin_dashboard.php" class="home-btn">Home</a>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Speciality</th>
                        <th>Doctor</th>
                        <th>Appointment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td><?php echo $row['speciality']; ?></td>
                            <td><?php echo $row['doctor']; ?></td>
                            <td><?php echo $row['appointment']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">No appointments found.</p>
        <?php endif; ?>
    </div>
</body>
</html>