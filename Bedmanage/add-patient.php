<?php
session_start();
require_once('connect.php');
if (!isset($_SESSION['user_id'])) {
    Redirect('index.php');
} else {
    $error = "";
    $msg = "<br><span class=msg>Patient Added Successfully</span><br><br>";
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

    /* Sidebar Styling */
    .sideNav {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .sideNav li a {
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        text-decoration: none;
        margin: 10px 0;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #5a2364;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sideNav li a:hover {
        background-color: #8f8749;
        color: #fff;
    }

    /* Breadcrumb Heading */
    h2 {
        margin-top: 20px;
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

    form.jNice input[type="text"],
    form.jNice input[type="number"],
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
        <h2>Add New Patient</h2>

        <div id="main">
            <form method="post" class="jNice">
                <h3>Registration Form</h3>
                <?php
                if (isset($_POST['save'])) {
                    $name = trim($_POST['name']);
                    $age = trim($_POST['age']);
                    $sex = $_POST['sex'];
                    $bg = trim($_POST['bg']);
                    $phone = trim($_POST['phone']);

                    if ($name == "") {
                        $error = "<br><span class=error>Please enter a name</span><br><br>";
                    } elseif ($age == "") {
                        $error = "<br><span class=error>Please enter the age</span><br><br>";
                    } elseif ($age < 1) {
                        $error = "<br><span class=error>Please enter a value greater than zero for age</span><br><br>";
                    } elseif (!is_numeric($age)) {
                        $error = "<br><span class=error>Age must be a number</span><br><br>";
                    } elseif ($sex == "none") {
                        $error = "<br><span class=error>Please select the sex</span><br><br>";
                    } elseif ($bg == "") {
                        $error = "<br><span class=error>Please enter a blood group</span><br><br>";
                    } elseif ($phone == "") {
                        $error = "<br><span class=error>Please enter the phone number</span><br><br>";
                    } else {
                        mysqli_query($server, "INSERT INTO patient (name, age, sex, blood_group, phone) VALUES ('$name', '$age', '$sex', '$bg', '$phone')");
                        echo $msg;
                    }

                    if ($error != "") {
                        echo $error;
                    }
                }
                ?>
                <fieldset>
                    <p><label>Patient Name:</label><input type="text" name="name" class="text-long" autofocus value="" /></p>
                    <p><label>Age:</label><input type="number" name="age" class="text-long" value="" /></p>
                    <p><label>Sex:</label>
                        <select name="sex">
                            <option value="none">[--------SELECT--------]</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transexual">Transexual</option>
                            <option value="Other">Other</option>
                        </select>
                    </p>
                    <p><label>Blood Group:</label><input type="text" name="bg" class="text-long" value="" /></p>
                    <p><label>Phone Number:</label><input type="text" name="phone" class="text-long" value="" /></p>
                    <input type="submit" value="Save" name="save" />
                </fieldset>
            </form>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="add-patient.php">Add New Patient</a>
                <a href="patients.php">View All Patients</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once('footer.php');
?>