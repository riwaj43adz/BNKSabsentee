<?php include('server.php') ?>
<?php

session_start();

// initializing variables
$period    = "";
$roll="";
$name="";
$house="";
$errors = array(); 

//initializing connection
$host="sql105.epizy.com";
$dbuser="epiz_29213143";
$dbpassword="Hh8MGJialQ";
$dbname="epiz_29213143_abs";

//connecting to database
$db= mysqli_connect($host, $dbuser, $dbpassword, $dbname) or die("couldnot connect to database");?>

    <?php  if (isset($_SESSION['username'])) :
$userinfo= $_SESSION['username'];
    ?>
     <?php 
     endif 
    ?>
    <?php
 // REGISTER USER
if (isset($_POST['abs_user'])) {
//keeping todays date

  $date = date("Y/m/d");
    // receive all input values from the form
  $period = mysqli_real_escape_string($db, $_POST['period']);
  $roll = mysqli_real_escape_string($db, $_POST['roll']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $house = mysqli_real_escape_string($db, $_POST['house']);
    

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($date)) { array_push($errors, "Date is required"); }
  if (empty($period)) { array_push($errors, "Period number is required"); }
  if (empty($roll)) { array_push($errors, "Roll no is required"); }
   if (empty($name)) { array_push($errors, "Absentee name is required"); }
   if (empty($house)) { array_push($errors, "House name is required"); }
  
    // if absentee name is already there
  $user_check_query = "SELECT * FROM `absent` WHERE  date='$date' AND period='$period' AND roll='$roll' AND name='$name' AND house='$house' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['roll'] === $roll) {
      array_push($errors, "This absentee was already recorded on the given details");
    }

  }

      
      
       //classifing class

 $cla=  substr($roll,0,1);

if ($cla== "1"){
    $class="5";
};
if ($cla== "9"){
    $class="6";
};
if ($cla== "8"){
    $class="7";
};
if ($cla== "7"){
    $class="8";
};
if ($cla== "6"){
    $class="9";
};
if ($cla== "5"){
    $class="10";
};
if ($cla== "4"){
    $class="11/A1";
};
if ($cla== "3"){
    $class="12/A2";
};

   // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO `absent` ( date, period, roll, name, house, class, teacher) 
  			  VALUES('$date', '$period', '$roll', '$name', '$house', $class, '$userinfo')";
  	mysqli_query($db, $query);
  	$_SESSION['name'] = $name;
  	$_SESSION['absadded'] =$name . "Absentee name has been added";
  	header('location: index.php');
  }
}
