<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_GET['del']))
{
  $rid=$_GET['del'];
  $query=mysqli_query($con,"delete from tblambulance  where ID='$rid'");
  echo "<script>alert('Data Deleted');</script>";
}

?>



<!DOCTYPE html>
<head>
<title> Manage Ambulance </title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<?php include_once('includes/header.php');?>
<!--header end-->
<!--sidebar start-->
<?php include_once('includes/sidebar.php');?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     Manage Ambulance
    </div>
    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th data-breakpoints="xs">S.NO</th>
            <th>Type of Ambulance</th>
            <th>Ambulance Reg No.</th>
             <th>Name of Driver</th>
              <th>Phone Number of Driver</th>
            <th>Creation Date</th>
            <th data-breakpoints="xs">Action</th>
           
           
          </tr>
        </thead>
        <?php
$ret=mysqli_query($con,"select * from  tblambulance");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
        <tbody>
          <tr data-expanded="true">
                  <td><?php echo $cnt;?></td>
                  <?php   $atype=$row['AmbulanceType'];  
                 if($atype=="1"){ ?>
                  <td>Basic Life Support (BLS) Ambulances</td>
                <?php } elseif($atype=="2"){ ?>
                  <td>Advanced Life Support (ALS) Ambulances</td>
                <?php } elseif($atype=="3"){ ?>
                   <td>Non-Emergency Patient Transport Ambulances</td>
                   <?php } elseif($atype=="4"){ ?>
                     <td>Boat Ambulance</td>
                     <?php } ?>
                 
                  <td><?php  echo $row['AmbRegNum'];?></td>
                  <td><?php  echo $row['DriverName'];?></td>
                  <td><?php  echo $row['DriverContactNumber'];?></td>
                  <td><?php  echo $row['CreationDate'];?></td>
                  <td><a href="edit-ambulance.php?editid=<?php echo $row['ID'];?>" class="btn btn-primary">Edit</a> 
                    <a href="manage-ambulance.php?del=<?php echo $row['ID'];?>" class="btn btn-danger">Delete</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
 </tbody>
            </table>
            
            
          
    </div>
  </div>
</div>
</section>
 <!-- footer -->
		 <?php include_once('includes/footer.php');?>  
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
<?php }  ?>