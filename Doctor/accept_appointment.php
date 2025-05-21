<?php
session_start();
include('../includes/connection.php');

// Get the appointment ID from the URL
if (isset($_GET['aid'])) {
    $appointment_id = $_GET['aid'];

    // Fetch appointment details
    $query = "SELECT * FROM appointments WHERE id = '$appointment_id'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $appointment = mysqli_fetch_assoc($result);

        // Redirect to the prescription page with appointment details
        $_SESSION['appointment_id'] = $appointment['id'];
        $_SESSION['patient_name'] = $appointment['name'];
        $_SESSION['doctor_name'] = $appointment['doctor'];
        $_SESSION['department'] = $appointment['speciality'];
        $_SESSION['appointment_time'] = $appointment['appointment'];
        $_SESSION['appointment_date'] = $appointment['date'];
        $_SESSION['patient_age'] = $appointment['age'];
        $_SESSION['patient_gender'] = $appointment['gender'];
        $_SESSION['patient_address'] = $appointment['address'];

        header('Location: prescription.php');
        exit();
    } else {
        echo "<script>alert('Invalid Appointment ID'); window.location.href = 'appointments.php';</script>";
    }
} else {
    echo "<script>alert('No Appointment ID Provided'); window.location.href = 'appointments.php';</script>";
}
?>