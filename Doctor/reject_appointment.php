<?php

session_start();
include('../includes/connection.php');

if (isset($_GET['aid'])) {
    $aid = intval($_GET['aid']);
    // Update the status to 'rejected'
    $query = "UPDATE appointments SET status='rejected' WHERE id=$aid";
    if (mysqli_query($connection, $query)) {
        echo "<script>
            if(confirm('Appointment rejected successfully. Click OK to go to Dashboard or Cancel to stay on Appointments.')) {
                window.location.href='dashboard.php';
            } else {
                window.location.href='appointments.php';
            }
        </script>";
    } else {
        echo "<script>
            alert('Failed to reject appointment.');
            window.location.href='appointments.php';
        </script>";
    }
} else {
    header('Location: appointments.php');
}
?>