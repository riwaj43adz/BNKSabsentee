<?php
  
// Get the user id 
$user_id = $_REQUEST['user_id'];
  
  //initializing connection
$host=" ";
$dbuser=" ";
$dbpassword=" ";
$dbname=" ";

//connecting to database
$con= mysqli_connect($host, $dbuser, $dbpassword, $dbname) or die("couldnot connect to database");

  
if ($user_id !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($con, "SELECT name, 
    house FROM `absent` WHERE roll ='$user_id'");
  
    $row = mysqli_fetch_array($query);
  
    // Get the first name
    $first_name = $row["name"];
  
    // Get the first name
    $last_name = $row["house"];
}
  else{
      echo "error";
  }
// Store it in a array
$result = array("$first_name", "$last_name");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>
