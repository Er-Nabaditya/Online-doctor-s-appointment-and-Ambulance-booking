<?php
session_start();
require_once('connect.php');
if (!isset($_SESSION['user_id'])) {
    Redirect('index.php');
} else {
    require_once('header.php');
}
?>

<style>
    /* General Body Styling */
    body {
        background: linear-gradient(135deg, #5a2364, #8f8749);
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        color: #fff;
    }

    /* Navigation Bar Styling */
    #mainNav {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        list-style: none;
        padding: 0;
    }

    #mainNav li {
        margin: 0 15px;
    }

    #mainNav a {
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    #mainNav a.active {
        background-color: #FF4742;
        color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #mainNav a:hover {
        background-color: #8f8749;
        color: #fff;
    }

    /* Breadcrumb Heading */
    h2 {
        margin-top: 50px;
        text-transform: uppercase;
        font-size: 32px;
        color: #fff;
        text-align: center;
    }
h3{
    margin-top: 50px;
        text-transform: uppercase;
        font-size: 17px;
        color: #fff;
        text-align: center;
}
    /* Table Styling */
    table {
        margin: 20px auto;
        width: 90%;
        border-collapse: collapse;
        font-size: 18px;
        color: #333;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    table th, table td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
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
        background-color: #f2f2f2;
    }

    /* Buttons at the Bottom */
    .button-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 30px 0;
    }

    .button-container a {
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #5a2364;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .button-container a:hover {
        background-color: #8f8749;
        transform: scale(1.05);
    }
</style>

<ul id="mainNav">
    <li><a href="dashboard.php" class="active">Dashboard</a></li>
    <li><a href="patients.php" class="active">Patients</a></li>
    <li><a href="beds.php" class="active">Beds</a></li>
    <li class="logout"><a href="logout.php" class="active">Logout</a></li>
</ul>

<div id="containerHolder">
    <div id="container">
        <h2>View All Patients</h2>

        <div id="main">
            <h3>Patient Records</h3>
            <table>
                <tr>
                    <th><b>Patient ID</b></th>
                    <th><b>Name</b></th>
                    <th><b>Age</b></th>
                    <th><b>Sex</b></th>
                    <th><b>Blood Group</b></th>
                    <th><b>Status</b></th>
                </tr>
                <?php
                $result = mysqli_query($server, "
                    SELECT 
                        p.pat_id, 
                        p.name, 
                        p.age, 
                        p.sex, 
                        p.blood_group, 
                        pb.bed_id 
                    FROM 
                        patient p 
                    LEFT JOIN 
                        pat_to_bed pb ON p.pat_id = pb.pat_id 
                    ORDER BY 
                        p.pat_id ASC
                ");
                while ($row = mysqli_fetch_assoc($result)) {
                    $status = "";
                    if ($row['bed_id'] === NULL) {
                        $status = "Unassigned";
                    } elseif ($row['bed_id'] > 0) {
                        $status = "Admitted <font color=#c66653>{Bed " . $row['bed_id'] . "}</font>";
                    } else {
                        $status = "<font color=#33CC99>Discharged</font>";
                    }

                    $rn = $row['pat_id'];
                    if (strlen($rn) == 1) $rn = "000" . $rn;
                    elseif (strlen($rn) == 2) $rn = "00" . $rn;
                    elseif (strlen($rn) == 3) $rn = "0" . $rn;

                    echo "<tr>
                            <td>$rn</td>
                            <td>{$row['name']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['sex']}</td>
                            <td>{$row['blood_group']}</td>
                            <td>$status</td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <!-- Buttons at the bottom -->
        <div class="button-container">
            <a href="patients.php">View All Patients</a>
            <a href="add-patient.php">Add New Patient</a>
            <a href="assign-bed.php">Assign/Unassign Beds</a>
        </div>
    </div>
</div>

<?php
require_once('footer.php');
?>