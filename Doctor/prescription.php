<?php


session_start();

// Check if appointment details are available
if (!isset($_SESSION['appointment_id'])) {
    echo "<script>alert('No appointment selected.'); window.location.href = 'appointments.php';</script>";
    exit();
}

// Fetch appointment details from the session
$doctor_name = isset($_SESSION['doctor_name']) ? $_SESSION['doctor_name'] : '';
$department = isset($_SESSION['department']) ? $_SESSION['department'] : '';
$appointment_time = isset($_SESSION['appointment_time']) ? $_SESSION['appointment_time'] : '';
$appointment_date = isset($_SESSION['appointment_date']) ? $_SESSION['appointment_date'] : '';
$patient_name = isset($_SESSION['patient_name']) ? $_SESSION['patient_name'] : '';
$patient_age = isset($_SESSION['patient_age']) ? $_SESSION['patient_age'] : '';
$patient_gender = isset($_SESSION['patient_gender']) ? $_SESSION['patient_gender'] : '';
$patient_address = isset($_SESSION['patient_address']) ? $_SESSION['patient_address'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Prescription Template</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f4f8;
      padding: 30px;
    }

    .prescription {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      border-bottom: 2px solid #ccc;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .doctor-info h2 {
      margin: 0;
      color: #007BFF;
    }

    .clinic-info {
      text-align: right;
    }

    .patient-info {
      margin-bottom: 20px;
    }

    .patient-info h3 {
      margin-bottom: 10px;
      color: #333;
    }

    .patient-info p {
      margin: 5px 0;
    }

    .prescription-details {
      border-top: 1px dashed #aaa;
      padding-top: 15px;
    }

    .rx {
      font-size: 28px;
      font-weight: bold;
      color: #28a745;
    }

    .med-list {
      margin-top: 10px;
    }

    .med-list li {
      margin-bottom: 8px;
    }

    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 12px;
      color: #555;
      border-top: 1px solid #ccc;
      padding-top: 10px;
    }
    .prescription-form {
      margin-top: 25px;
    }
    .prescription-form label {
      font-weight: 500;
      color: #333;
    }
    .prescription-form textarea {
      width: 100%;
      height: 120px;
      margin-top: 10px;
      padding: 12px;
      font-size: 1em;
      border: 1.5px solid #b0bec5;
      border-radius: 8px;
      resize: vertical;
      background: #f7fafc;
      transition: border-color 0.2s;
    }
    .prescription-form textarea:focus {
      border-color: #007bff;
      outline: none;
    }
    .prescription-form button {
      margin-top: 18px;
      padding: 12px 0;
      width: 100%;
      font-size: 1.1em;
      color: #fff;
      background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      letter-spacing: 1px;
      box-shadow: 0 2px 8px rgba(0,123,255,0.08);
      transition: background 0.2s, transform 0.2s;
    }
    .prescription-form button:hover {
      background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
      transform: translateY(-2px) scale(1.02);
    }
    @media (max-width: 600px) {
      .prescription {
        padding: 15px 5px 15px 5px;
      }
      .header {
        flex-direction: column;
        text-align: left;
      }
      .clinic-info {
        text-align: left;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="prescription">
    <div class="header">
      <div class="doctor-info">
        <h2><?php echo htmlspecialchars($doctor_name); ?></h2>
        <p><?php echo htmlspecialchars($department); ?></p>
      </div>
      <div class="clinic-info">
        <p><strong>Clinic Name:</strong>MediSync Clinic</p>
        <p><strong>Contact:</strong> +91-6370652632</p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($appointment_date); ?></p>
        <p><strong>Time:</strong> <?php echo htmlspecialchars($appointment_time); ?></p>
      </div>
    </div>

    <div class="patient-info">
      <h3>Patient Details</h3>
      <p><strong>Name:</strong> <?php echo htmlspecialchars($patient_name); ?></p>
      <p><strong>Age:</strong> <?php echo htmlspecialchars($patient_age); ?></p>
      <p><strong>Gender:</strong> <?php echo htmlspecialchars($patient_gender); ?></p>
      <p><strong>Address:</strong> <?php echo htmlspecialchars($patient_address); ?></p>
    </div>

    <div class="prescription-details">
      <p class="rx">℞</p>
      <form class="prescription-form" action="save_prescription.php" method="POST">
        <label for="prescription">Prescription:</label>
        <textarea id="prescription" name="prescription" placeholder="Write your prescription here..." required></textarea>
        <button type="submit">Save Prescription</button>
      </form>
    </div>

    <div class="footer">
      <p>This prescription is computer generated and does not require a signature.</p>
    </div>
  </div>

</body>
</html>