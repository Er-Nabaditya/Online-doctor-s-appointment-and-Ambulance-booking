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

    /* Container Styling */
    #containerHolder {
        margin-top: 50px;
        text-align: center;
    }

    /* Sidebar Styling */
    .sideNav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sideNav li a {
        font-size: 20px;
        font-weight: bold;
        color: #fff;
        text-decoration: none;
    }

    .sideNav li a:hover {
        color: #FF4742;
    }

    /* Breadcrumb Heading */
    h2 {
        margin-top: 20px;
        text-transform: uppercase;
        font-size: 32px;
        color: #fff;
    }

    hr {
        width: 50%;
        margin: 10px auto;
        border: 1px solid #fff;
    }

    /* Statistics Table Styling */
    table {
        margin: 20px auto;
        width: 80%;
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

    table tr:hover {
        background-color: #f2f2f2;
    }

    /* Logout Button Styling */
    .logout a {
        background-color: #FF4742;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .logout a:hover {
        background-color: #8f8749;
    }
</style>

<ul id="mainNav">
    <li><a href="dashboard.php" class="active">Dashboard</a></li>
    <li><a href="patients.php">Patients</a></li>
    <li><a href="beds.php">Beds</a></li>
    <li class="logout"><a href="logout.php">Logout</a></li>
</ul>

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a>Welcome, <?php echo $_SESSION['name']; ?></a></li>
            </ul>
        </div>

        <h2>Dashboard</h2>
        <hr>

        <div id="main">
            <h3>Statistics</h3>
            <table>
                <?php
                // Total patients
                $result = mysqli_query($server, "SELECT COUNT(pat_id) FROM patient");
                $row = mysqli_fetch_row($result);

                // Total beds (constant)
                $resultTotalBeds = mysqli_query($server, "SELECT sum(num) FROM beds");
                $rowTotalBeds = mysqli_fetch_row($resultTotalBeds);


                // Occupied beds
                $result4 = mysqli_query($server, "SELECT COUNT(DISTINCT bed_id) FROM pat_to_bed WHERE bed_id IS NOT NULL");
                $row4 = mysqli_fetch_row($result4);
               

                // Vacant beds
                $row6[0] = $rowTotalBeds[0] - $row4[0];
                // Total Beds
                $row8[0] = $rowTotalBeds[0]+$row4[0];

                // Admitted patients (patients assigned to a bed)
                $result3 = mysqli_query($server, "SELECT COUNT(pat_id) FROM pat_to_bed WHERE bed_id IS NOT NULL");
                $row3 = mysqli_fetch_row($result3);

                // Unassigned patients (patients who never got a bed)
                $result7 = mysqli_query($server, "SELECT COUNT(pat_id) FROM pat_to_bed WHERE bed_id IS NULL");
                $row7 = mysqli_fetch_row($result7);
                $row7[0] = $row[0] - $row3[0];

                echo "<tr>
                        <th>Patients</th>
                        <th>Beds</th>
                      </tr>
                      <tr>
                        <td>Total - $row[0]</td>
                       
                        <td>Total Bed - $row8[0]</td>
                      </tr>
                      <tr>
                        <td>Admitted - $row3[0]</td>
                        <td>Occupied - $row4[0]</td>
                      </tr>
                      <tr>
                        <td>Unassigned - $row7[0]</td>
                         <td>Available - $rowTotalBeds[0]</td>
                      </tr>
                      ";
                ?>
            </table>
        </div>
    </div>
</div>

<?php
require_once('footer.php');
?>