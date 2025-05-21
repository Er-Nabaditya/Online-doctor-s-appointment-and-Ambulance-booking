<?php

session_start();
require_once('../TCPDF-main/tcpdf.php'); // Include TCPDF library

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['prescription']) && !empty($_POST['prescription'])) {
        $prescription = trim($_POST['prescription']);
        $appointment_id = $_SESSION['appointment_id'];
        $doctor_name = $_SESSION['doctor_name'];
        $patient_name = $_SESSION['patient_name'];
        $appointment_date = $_SESSION['appointment_date'];
        $appointment_time = $_SESSION['appointment_time'];
        $patient_age = $_SESSION['patient_age'];
        $patient_gender = $_SESSION['patient_gender'];
        $patient_address = $_SESSION['patient_address'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'oabs');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch doctor email and phone from the database
        $doctor_query = "SELECT email, mobile FROM doctors WHERE name = ?";
        $doctor_stmt = $conn->prepare($doctor_query);
        $doctor_stmt->bind_param('s', $doctor_name);
        $doctor_stmt->execute();
        $doctor_result = $doctor_stmt->get_result();

        if ($doctor_result->num_rows > 0) {
            $doctor_data = $doctor_result->fetch_assoc();
            $doctor_email = $doctor_data['email'];
            $doctor_phone = $doctor_data['mobile'];
        } else {
            echo "<script>alert('Doctor details not found.'); window.location.href = 'dashboard.php';</script>";
            exit();
        }

        // Insert prescription into the database
        $sql = "INSERT INTO prescriptions (appointment_id, doctor_name, patient_name, appointment_date, appointment_time, prescription, patient_age, patient_gender, patient_address) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issssssss', $appointment_id, $doctor_name, $patient_name, $appointment_date, $appointment_time, $prescription, $patient_age, $patient_gender, $patient_address);

        if ($stmt->execute()) {
            // Generate PDF
            $pdf = new TCPDF();
            $pdf->SetCreator('Doctor');
            $pdf->SetAuthor($doctor_name);
            $pdf->SetTitle('Prescription');
            $pdf->SetHeaderData('', 0, '', '');
            $pdf->setHeaderFont(['helvetica', '', 12]);
            $pdf->setFooterFont(['helvetica', '', 10]);
            $pdf->SetMargins(15, 27, 15);
            $pdf->SetAutoPageBreak(TRUE, 25);
            $pdf->AddPage();

            // Add content with improved design
            $html = "
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
        }
        .border-wrapper {
            border: 10px solid #007bff;
            padding: 30px;
            border-radius: 15px;
            box-sizing: border-box;
            background-color: #f4faff;
        }
        .heading {
            text-align: center;
            font-size: 45px;
            font-weight: bold;
            color: #ff5733;
            margin-bottom: 30px;
        }
        .doctor-details {
            display: flex;
            justify-content: space-between;
            background-color: #e9f0ff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 40px;
            border: 1px solid #cce0ff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .doctor-details div {
            font-size: 14px;
            color: #555;
        }
        .doctor-details div strong {
            color: #007bff;
        }
        hr {
            border: 2px solid #007bff;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .prescription-details {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>

    <div class='border-wrapper'>
        <div class='heading'>Online Appointment System</div>
        <div class='doctor-details'>
            <div><strong>Doctor:</strong> $doctor_name</div>
            <div><strong>Email:</strong> $doctor_email</div>
            <div><strong>Phone:</strong> $doctor_phone</div>
        </div>
        <hr>
        <h3 style='color: #007bff;'>Patient Details</h3>
        <table>
            <tr>
                <th>Patient Name</th>
                <td>$patient_name</td>
            </tr>
            <tr>
                <th>Age</th>
                <td>$patient_age</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>$patient_gender</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>$patient_address</td>
            </tr>
            <tr>
                <th>Appointment Date</th>
                <td>$appointment_date</td>
            </tr>
            <tr>
                <th>Appointment Time</th>
                <td>$appointment_time</td>
            </tr>
        </table>
        <h3 style='color: #007bff;'>Prescription Details</h3>
        <p class='prescription-details'>$prescription</p>
        <div class='footer'>
            <p>“The good physician treats the disease; the great physician treats the patient who has the disease.”</p>
        </div>
    </div>
";

            $pdf->writeHTML($html, true, false, true, false, '');

            // Save PDF to the "doctor/prescription" directory
            $directory = __DIR__ . "/prescription";
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }
            $sanitized_patient_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $patient_name);
            $file_name = "prescription_{$sanitized_patient_name}_{$appointment_id}.pdf";
            $file_path = $directory . "/" . $file_name;

            $pdf->Output($file_path, 'F'); // Save the PDF file

            // Success alert and redirect to doctor dashboard
            echo "<script>alert('Prescription saved successfully!'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to save prescription. Please try again.'); window.location.href = 'dashboard.php';</script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<script>alert('Prescription cannot be empty.'); window.location.href = 'prescription.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'prescription.php';</script>";
}
?>