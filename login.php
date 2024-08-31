<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Log in </title>
  <link rel="icon" href="img/logo.png" type="image/png" />
  
 <link rel='stylesheet' href='/style.css?<?php echo filemtime($_SERVER["DOCUMENT_ROOT"] . "/style.css"); ?>' />
</head>
<body>
  <div class="header">
  	<h2>Login
      	<script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
<lord-icon
    src="https://cdn.lordicon.com/dxjqoygy.json"
    trigger="loop"
    colors="primary:#FFFFFF,secondary:#FFFFFF"
    stroke="100"
    scale="60"
    style="width:40px;height:40px">
</lord-icon></h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
         
  	</div>
  <!--	<p>
      
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>-->
  </form>
</body>
<a class="aa"href="http://bnksabsentee.cf/display">
  <div class="eye">
 <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
<script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
<h2><lord-icon
    src="https://cdn.lordicon.com/tyounuzx.json"
    trigger="loop"
    colors="primary:#e4e4e4,secondary:#0000"
    scale="60"
    axis-x="53"
    axis-y="42"
    style="width:80px;height:80px">
</lord-icon>ABSENTEES</h2></div></a>
</html>