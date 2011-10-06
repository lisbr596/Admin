<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"> 
<html>
<head>
<title>Webdesignskolan, CSS-meny med PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<!--- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> -->
	<link rel="stylesheet" type="text/css" href="menu_style.css" />
<link href="layout.css" rel="stylesheet" type="text/css">
<link href="meny.css" rel="stylesheet" type="text/css">
</head>
<body>


<?php
//ansluter till servern
$con = mysql_connect("dansflex.com.mysql","dansflex_com","mariasql");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("dansflex_com", $con);

$sida = $_GET[sida];


?>

<div id="sidlayout">
<div id="container">
<?php include "meny.php"; ?>
</div>
<?php include "funktioner.php"; ?>
<?php include "kursfunkt.php"; ?>
<!-- OBS! Viktigt med rätt doctype: http://www.webdesignskolan.se/css_position/css_position.htm#doctype  -->
<div id="content">

<?php


include $sida; ?>
  <h1></h1>
  <p>&nbsp;</p>

</div>
</div>
</body>
</html>
<?php
//stäng servern
mysql_close($con);
?>