<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <!-- Internal CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .form-container h5 {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group input,
        .form-group select {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 1rem;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .form-container .form-group {
            margin-bottom: 20px;
        }

        .form-container .form-group:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto form-container">
                <h5 class="text-center">Add Doctor Here!</h5>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Doctor's Name" required>
                    </div>
                    <div class="form-group">
                        <select name="speciality" class="form-control" required>
                            <option value="not selected">-Select Speciality-</option>
                            <?php 
                                include('../includes/connection.php');
                                $query = "select speciality from specialities";
                                $query_run = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <option value="<?php echo $row['speciality']; ?>"><?php echo $row['speciality']; ?></option>
                                    <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Enter Email ID" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile No." required>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary" value="Add Doctor" name="add_doctor">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>