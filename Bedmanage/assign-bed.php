<?php
session_start();
require_once('connect.php');
if (!isset($_SESSION['user_id'])) {
    Redirect('index.php');
} else {
    $error = "";
    $error2 = "";
    $msg = "<div class='success-msg' id='success-msg'>Bed Assigned Successfully</div>";
    $msg2 = "<div class='success-msg' id='success-msg'>Bed Has Been Unassigned Successfully</div>";
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

    /* Form Styling */
    form.jNice {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 500px;
        margin: 30px auto;
        color: #333;
    }

    form.jNice h3 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #5a2364;
        text-align: center;
    }

    form.jNice fieldset {
        border: none;
        padding: 0;
        margin: 0;
    }

    form.jNice p {
        margin-bottom: 15px;
    }

    form.jNice label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    form.jNice select,
    form.jNice input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    form.jNice input[type="submit"] {
        background: #FF4742;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
        border: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    form.jNice input[type="submit"]:hover {
        background: #e43e3a;
        transform: scale(1.05);
    }

    /* Success and Error Message Styling */
    .success-msg {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .error {
        color: red;
        font-size: 14px;
        margin-top: 10px;
        text-align: center;
    }

    /* Button Container Styling */
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

<script>
    // Remove success or error messages after 5 seconds
    setTimeout(() => {
        const successMsg = document.getElementById('success-msg');
        if (successMsg) {
            successMsg.style.display = 'none';
        }
    }, 5000);

    // Show error message if required fields are not filled
    function validateForm(form) {
        const patient = form.patient ? form.patient.value : "none";
        const bed = form.bed ? form.bed.value : "none";

        if (patient === "none" || bed === "none") {
            alert("Please fill in all the required details!");
            return false;
        }
        return true;
    }
</script>

<ul id="mainNav">
    <li><a href="dashboard.php" class="active">Dashboard</a></li>
    <li><a href="patients.php">Patients</a></li>
    <li><a href="beds.php">Beds</a></li>
    <li class="logout"><a href="logout.php">Logout</a></li>
</ul>

<div id="containerHolder">
    <div id="container">
        <h2>Assign/Unassign Beds</h2>

        <div id="main">
            <form method="post" class="jNice" name="frm1" onsubmit="return validateForm(this);">
                <h3>Assign Beds</h3>
                <?php
                if (isset($_POST['assign'])) {
                    $patient = $_POST['patient'];
                    $bed = $_POST['bed'];

                    if ($patient == "none") {
                        $error = "<div class='error'>Please select a patient</div>";
                    } elseif ($bed == "none") {
                        $error = "<div class='error'>Please select a bed</div>";
                    } else {
                        $result5 = mysqli_query($server, "SELECT num FROM beds WHERE bed_id='$bed'");
                        $row5 = mysqli_fetch_assoc($result5);
                        if ($row5['num'] > 0) {
                            $update_pat_to_bed = mysqli_query($server, "INSERT INTO pat_to_bed (pat_id, bed_id) VALUES ('$patient', '$bed')");
                            if ($update_pat_to_bed) {
                                $update_beds = mysqli_query($server, "UPDATE beds SET num = num - 1 WHERE bed_id='$bed'");
                                if ($update_beds) {
                                    echo $msg;
                                } else {
                                    $error = "<div class='error'>Error updating bed count: " . mysqli_error($server) . "</div>";
                                }
                            } else {
                                $error = "<div class='error'>Error assigning bed: " . mysqli_error($server) . "</div>";
                            }
                        } else {
                            $error = "<div class='error'>Beds are not available</div>";
                        }
                    }

                    if ($error != "") {
                        echo $error;
                    }
                }
                ?>
                <fieldset>
                    <p><label>Patient:</label>
                        <select name="patient">
                            <option value="none">[--------SELECT--------]</option>
                            <?php
                            $result = mysqli_query($server, "SELECT p.pat_id, p.name FROM patient p LEFT JOIN pat_to_bed pb ON p.pat_id = pb.pat_id WHERE pb.bed_id IS NULL ORDER BY p.pat_id DESC");
                            while ($row = mysqli_fetch_row($result)) {
                                $rn = $row[0];
                                if (strlen($rn) == 1) $rn = "000" . $rn;
                                elseif (strlen($rn) == 2) $rn = "00" . $rn;
                                elseif (strlen($rn) == 3) $rn = "0" . $rn;
                                echo "<option value='$row[0]'>$rn - $row[1]</option>";
                            }
                            ?>
                        </select>
                    </p>
                    <p><label>Bed:</label>
                        <select name="bed">
                            <option value="none">[--------SELECT--------]</option>
                            <?php
                            $result2 = mysqli_query($server, "SELECT * FROM beds ORDER BY bed_id DESC");
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo "<option value='$row2[bed_id]'>Bed $row2[bed_id] - $row2[type]</option>";
                            }
                            ?>
                        </select>
                    </p>
                    <input type="submit" value="Assign Bed" name="assign" />
                </fieldset>
            </form>

            <form method="post" class="jNice" name="frm2">
                <h3>Unassign Beds</h3>
                <?php
                if (isset($_POST['unassign'])) {
                    $ptb = trim($_POST['ptb']);

                    if ($ptb == "none") {
                        $error2 = "<div class='error'>Please select a relationship</div>";
                    } else {
                        $result6 = mysqli_query($server, "SELECT bed_id FROM pat_to_bed WHERE pat_id='$ptb'");
                        if ($result6 && mysqli_num_rows($result6) > 0) {
                            $row6 = mysqli_fetch_assoc($result6);
                            $bed_id = $row6['bed_id'];

                            mysqli_query($server, "DELETE FROM pat_to_bed WHERE pat_id='$ptb'");
                            mysqli_query($server, "UPDATE beds SET num = num + 1 WHERE bed_id='$bed_id'");

                            echo $msg2;
                        } else {
                            $error2 = "<div class='error'>Invalid patient ID or no bed assigned to this patient</div>";
                        }
                    }

                    if ($error2 != "") {
                        echo $error2;
                    }
                }
                ?>
                <fieldset>
                    <p><label>Patient - Bed Relationship:</label>
                        <select name="ptb">
                            <option value="none">[--------SELECT--------]</option>
                            <?php
                            $result3 = mysqli_query($server, "SELECT p.pat_id, p.name, pb.bed_id FROM patient p JOIN pat_to_bed pb ON p.pat_id = pb.pat_id WHERE pb.bed_id > 0 ORDER BY p.pat_id ASC");
                            while ($row3 = mysqli_fetch_row($result3)) {
                                $rn = $row3[0];
                                if (strlen($rn) == 1) $rn = "000" . $rn;
                                elseif (strlen($rn) == 2) $rn = "00" . $rn;
                                elseif (strlen($rn) == 3) $rn = "0" . $rn;
                                echo "<option value='$row3[0]'>Bed $row3[2] to $rn - $row3[1]</option>";
                            }
                            ?>
                        </select>
                    </p>
                    <input type="submit" value="Unassign Bed" name="unassign" />
                </fieldset>
            </form>
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