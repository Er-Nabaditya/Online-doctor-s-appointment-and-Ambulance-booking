<?php
session_start();
require_once('connect.php');
if (!isset($_SESSION['user_id'])) {
    Redirect('index.php');
} else {
    $error = "";
    $msg = "<br><span class=msg>Bed Added Successfully</span><br><br>";
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

    form.jNice select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    form.jNice select:focus {
        border-color: #5a2364;
        box-shadow: 0 0 5px rgba(90, 35, 100, 0.5);
        outline: none;
    }

    form.jNice input[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #5a2364;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    form.jNice input[type="submit"]:hover {
        background-color: #8f8749;
        transform: scale(1.05);
    }

    /* Buttons for Add and View */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .action-buttons a {
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #5a2364;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .action-buttons a:hover {
        background-color: #8f8749;
        transform: scale(1.05);
    }

    /* Error and Success Message Styling */
    .error {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }

    .msg {
        color: green;
        font-size: 14px;
        margin-top: 10px;
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
        <h2>Add New Bed</h2>

        <div id="main">
            <form method="post" class="jNice">
                <h3>Registration Form</h3>
                <?php
                if (isset($_POST['save'])) {
                    $type = $_POST['type'];
                    $ward = $_POST['ward'];
                    $num = $_POST['num'];

                    if ($type == "none") {
                        $error = "<br><span class=error>Please select a type</span><br><br>";
                    } elseif ($ward == "none") {
                        $error = "<br><span class=error>Please select a ward</span><br><br>";
                    } else {
                        mysqli_query($server, "INSERT INTO beds (type,ward,num) VALUES ('$type','$ward','$num')");
                        echo $msg;
                    }

                    if ($error != "") {
                        echo $error;
                    }
                }
                ?>
                <fieldset>
                    <p><label>Type:</label>
                        <select name="type">
                            <option value="none">[--------SELECT--------]</option>
                            <option value="Manual">Manual</option>
                            <option value="Bariatric">Bariatric</option>
                            <option value="Full-Electric">Full-Electric</option>
                            <option value="Semi-Electric">Semi-Electric</option>
                            <option value="Low Bed">Low Bed</option>
                        </select>
                    </p>
                    <p><label>Ward:</label>
                        <select name="ward">
                            <option value="none">[--------SELECT--------]</option>
                            <option value="Postnatal">Postnatal</option>
                            <option value="Pregnancy">Pregnancy</option>
                            <option value="Critical Care">Critical Care</option>
                            <option value="Orthopaedic">Orthopaedic</option>
                            <option value="Psychiatric">Psychiatric</option>
                            <option value="Accidents And Emergency">Accidents And Emergency</option>
                            <option value="Paediatric">Paediatric</option>
                        </select>
                    </p>
                    <p><label>Number of bed:</label>
                        <select name="num">
                            <option value="none">[-------SELECT------]</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                    </p>
                    <input type="submit" value="Save" name="save" />
                </fieldset>
            </form>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="add-bed.php">Add New Bed</a>
                <a href="beds.php">View All Beds</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once('footer.php');
?>