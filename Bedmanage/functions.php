<?php
$db_hostname='localhost';
$db_database='oabs';
$db_username='root';
$db_password='';
$server=mysqli_connect($db_hostname,$db_username,$db_password);
if(!$server)
{
  echo "Cannot connect to mysql at the moment";
}
$found=mysqli_select_db($server,$db_database);
if(!$found)
{
   echo"Cannot find database at the moment";
}


function Redirect($url) { 
       if(headers_sent()) { 
               echo "<script type='text/javascript'>location.href='$url';</script>"; 
       } else { 
               header("Location: $url"); 
       } 
}  
?>