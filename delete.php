<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"> 
<html>
<head>
<title>Showdansskolan Flex - ADMIN </title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<!--- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> -->
	<link rel="stylesheet" type="text/css" href="menu_style.css" />
<link href="layout2.css" rel="stylesheet" type="text/css">
<link href="meny.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="5; url=<?php echo $vidare; ?>">

</head>
<body>


<?php 

// HÄMTAR ALLA VÄRDEN FRÅN DATABAS
$sida = $_GET[sida];
$table = $_GET[table];
$id = $_GET[id];

// OLIKA VERSIONER
if($table == "larare") {
$id_namn = "l_id";
$vidare = "index.php?sida=larare/visaallalarare.php";
}



$query = "DELETE FROM '".$table."' WHERE ".$id_namn."='".$id."'";
//mysql_query("DELETE FROM '".$table."' WHERE ".$id_namn."='".$id."'");

echo $query;
echo $vidare;


?>