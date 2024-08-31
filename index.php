<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php include('server.php') ?>
<?php include('absentserver.php') ?>
 <?php
//including connection to db file
include "connection.php"; 
 $sql = "SELECT `house`, COUNT(*) Absentee FROM `absent` GROUP BY House HAVING COUNT(*) > 1 ";
$query= mysql_query($sql) or die("my sql qurey error");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="icon" href="img/logo.png" type="image/png" />
    
    <link rel='stylesheet' href='/style.css?<?php echo filemtime($_SERVER["DOCUMENT_ROOT"] . "/style.css"); ?>' />
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  

    <style>
     
       .chgpas{
    width: 45%;
    float: left;
    text-decoration-color: white;
      padding: 10px;
  color: white;
  background: tomato ;
  border: none;
  border-radius: 5px;
}
     
    .logbtn{
    width: 30%;
    float: right;
    text-decoration-color: white;
      padding: 10px;
  font-size color: white;
  background: tomato ;
  border: none;
  border-radius: 5px;
}
  .logbtn:hover{
background:red;
}
.chgpas:hover{
background:red;
}

a{
  text-decoration-color:none;
    text-decoration: none;
}
    </style>
</head>
<body>
    <!--notice -->
<div class="notice">
<div class="notice_header">
	<h2>NOTICE</h2>
</div>
<div class="notice_content">
   <p> To simplify the website, we have made some changes. The followings are the updates:
<br><br>
       1) If an absentee has previously been recorded: for those absentees, the box of name and house will be automatically filled while inputting the period and roll no only.
<br>
      2)To prevent entering duplicate absentee values on the same period and date: If the same absentee is recorded twice for the same day and period, it will indicate an error and wont let duplicate datas to be filled.
<br>
      3) In the list of absentees page: Classes column will be available for absentees registered after August 20th.
<br>
      4) Now you may see the chart of absentees V/S houses. This information is based on the absentees that have been recorded up until today. In the forth-comming days the graph will be based on daily input data.
<br><br>
       Thank you!
       <br>
       -DPK (Vice-Principal)
        </p> 
    </div>
    </div>
    <div class="clock">
    <script src="https://cdn.logwork.com/widget/clock.js"></script>
<a href="https://logwork.com/clock-widget/" class="clock-time" data-style="default-numeral" data-size="250" data-timezone="Asia/Kathmandu">Current time in Budhanilkantha, Nepal</a>
    </div>
<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
	<?php if (isset($_SESSION['absadded'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['absadded']; 
          	unset($_SESSION['absadded']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p><br>
        <p><button class="chgpas"> <a href="changed.php" style="color: black;">Change password</a></button> </p>
    	<p><button class="logbtn"> <a href="index.php?logout='1'" style="color: black;">Logout</a></button> </p>
    <?php endif ?>
</div>

 
	<br>
            
    <br>
<div class="header">
	<h2>Add absentee</h2>
</div>
  <form method="post" action="index.php" >
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Date:</label>
  	<?php
      echo gmdate("l jS \of F Y") . "<br>";
      ?>
      </div>
  	<div class="input-group">
  	  <label>Period</label>
  	  <input type="number" name="period" >
  	</div>

	<div class="input-group">
  	  <label>Roll</label>
  	  <input type="number" name="roll"   id='user_id'  
                        onkeyup="GetDetail(this.value)" value="">
  	</div>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="name"  id="first_name" value="">
  	</div>
  	<div class="input-group">
  	  <label>House</label>
  	  <input type="text" name="house"  id="last_name" value="">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="abs_user">Register Absent</button>
        
  	</div> 
  </form>


  <script>
  
        // onkeyup event will occur when the user 
        // release the key and calls the function
        // assigned to this event
        function GetDetail(str) {
            if (str.length == 0) {
                document.getElementById("first_name").value = "";
                document.getElementById("last_name").value = "";
                return;
            }
            else {
  
                // Creates a new XMLHttpRequest object
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
  
                    // Defines a function to be called when
                    // the readyState property changes
                    if (this.readyState == 4 && 
                            this.status == 200) {
                          
                        // Typical action to be performed
                        // when the document is ready
                        var myObj = JSON.parse(this.responseText);
  
                        // Returns the response data as a
                        // string and store this array in
                        // a variable assign the value 
                        // received to first name input field
                          
                        document.getElementById
                            ("first_name").value = myObj[0];
                          
                        // Assign the value received to
                        // last name input field
                        document.getElementById(
                            "last_name").value = myObj[1];
                    }
                };
  
                // xhttp.open("GET", "filename", true);
                xmlhttp.open("GET", "gfg.php?user_id=" + str, true);
                  
                // Sends the request to the server
                xmlhttp.send();
            }
        }
    </script>
<!-- CHART -->
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["House", "Absentees:", { role: "style" } ],
        
       <?php 
       $a=0;
       $colors = array("'yellow'", "'grey'", "'black'", "'orange'", "'brown'", "'pink'", "'gold'", "'red'", "'#00008b'", "'blue'", "'green'", "'#042707'", "'#9a3f5c'","'#afc065'" );
         while ($row = mysql_fetch_array($query)){ 
         echo"['" .$row['house']."H',".$row['Absentee'].",". $colors[$a] ." ],"; 
         $a=$a+1;
} ?>  
      ]);


      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
       
        width: 900,
        height: 450,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
<div class="chartheader">
	<h2>Absentees with houses</h2>
</div>
<div class="chart" id="columnchart_values" style="width: 950px; height: 450px;"></div>
<!--  See absentee-->
  <div class="headertwo">
  	<h2><a href="http://bnksabsentee.cf/display/" class="aa">See Absentee</a></h2>
  </div>
  <br/> <br/><br/>
 
</body>
</html>