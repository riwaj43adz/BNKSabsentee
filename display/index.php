<?php

//including connection to db file
include "connection.php"; 

$sql = "SELECT * FROM absent  ";

if (isset($_POST['search'])){
    $search_date = mysql_real_escape_string($_POST['search_date']);
    $search_roll = mysql_real_escape_string($_POST['search_roll']);
    $search_term = mysql_real_escape_string($_POST['search_box']);
    $search_house = mysql_real_escape_string($_POST['search_house']);

    $sql .="WHERE date = '{$search_date}'";
    $sql .="OR  roll = '{$search_roll}'";
    $sql .="OR name = '{$search_term}'";
    $sql .="OR house = '{$search_house}'";


}
$sql .="ORDER BY ID DESC";

$query= mysql_query($sql) or die("my sql qurey error");

?>
<html>
<head>
<title> Absentee</title>
<link rel="icon" href="http://bnksabsentee.cf/img/logo.png" type="image/png" />
<link rel='stylesheet' href="style.css"); ?>' />
</head>
<body>
 <div class="header">
  	<h2>Search by:-</h2>
  </div>
<form name="search_form" method="POST" action="index.php">

<div class="input-group"><label>Search by Date :</label> <input type="date" name="search_date"  value="" /></div>
<div class="input-group"><label>Search by Roll : </label><input type="text" name="search_roll" value="" /></div>
<div class="input-group"><label>Search by Name : </label><input type="text" name="search_box" value="" /></div>
<div class="input-group"><label>Search by House:</label> <input type="text" name="search_house" value="" /></div>
<input type="submit" name="search" class="btn" value="Search the table.."/>
<button><a href="http://bnksabsentee.cf/">Add absentee</button>
</div>
</form>
<br><br><br><br>

<table width ="70%" cellpadding="5" cellspace="5" >


<tr>
    <th><strong>Date</strong></th>
    <th><strong>Period</strong></th>
    <th><strong>Roll</strong></th>
    <th><strong>Name</strong></th>
    <th><strong>House</strong></th>
    <th><strong>Teacher</strong></th>
</tr>
<?php while ($row = mysql_fetch_array($query)){ ?>
<tr>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo $row['period']; ?></td>
    <td><?php echo $row['roll']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['house']; ?></td>
    <td><?php echo $row['teacher']; ?></td>
</tr>
<?php } ?>
</table><br><br><br><br>
</body>
</html>