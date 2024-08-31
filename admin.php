<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_SESSION['username'])) {
  	$username=$_SESSION['username'];
      if ("DPK"!=$username){
  	header('location: acessdenied.php');
      }
       }?>
<?php include('server.php') ?>
<?php
//initializing connection
$host="sql105.epizy.com";
$dbuser="epiz_29213143";
$dbpassword="Hh8MGJialQ";
$dbname="epiz_29213143_abs";


$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname) or die("Connection Error: " . mysqli_error($conn));

if (isset($_POST['changepassword'])) {
  // receive all input values from the form
  $user_info=mysqli_real_escape_string($db, $_POST['userinfo']);
  $password_1 = mysqli_real_escape_string($db, $_POST['newPassword']);
  $password_2 = mysqli_real_escape_string($db, $_POST['confirmPassword']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($user_info)) { array_push($errors, "Userinfo is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
if (count($_POST) > 0) {
        $result = mysqli_query($conn, "SELECT * from `users` WHERE username='" . $user_info . "'");
    $row = mysqli_fetch_array($result);
     if (count($errors) == 0) {
        mysqli_query($conn, "UPDATE `users` set password='" . md5($_POST["newPassword"]) . "' WHERE username='" . $user_info . "'");
        
          $_SESSION['changed'] = $user_info . "'s password is changed sucessfully";

}
}
}
?>
<html>
<head>
<title>Change User's Password</title>
<link rel="icon" href="img/logo.png" type="image/png" />
<link rel='stylesheet' href='/style.css?<?php echo filemtime($_SERVER["DOCUMENT_ROOT"] . "/style.css"); ?>' />
<style>
   .bck{
    width: 95%;
    text-decoration-color: white;
      padding: 10px;
  font-size color: white;
  background: tomato ;
  border: none;
  border-radius: 5px;
}
  .bck:hover{
background:red;
}
a{
    text-decoration:none;
    color:black;
}
</style>
</head>
<body>



  <div class="header">
  	<h2>Change Password</h2>
  </div>
    <form method="post" action="">
    <div class="contenttwo">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['changed'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['changed']; 
          	unset($_SESSION['changed']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
</div>
        <?php include('errors.php'); ?>

        <div class="input-group">
             <label>Userinfo</label>
             <input type="text" name="userinfo" />
        </div>
                        
        <div class="input-group">
             <label>New Password</label>
             <input type="password" name="newPassword" />
        </div>
               
       	<div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmPassword" />
        </div>
           
     	<div class="input-group">
            <input type="submit" name="changepassword" value="Submit" class="btn">
        </div>
      <p><button class="bck"><a href="index.php" style = "color:black" > 
        Back</a> </button> </p>
     
    </form>
      
</body>
</html>