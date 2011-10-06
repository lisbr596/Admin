<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../stilmall.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<title>Dansflex.com -- Admin </title>


<body bgcolor="#FFffff">


<?php
$con = mysql_connect("dansflex.com.mysql","dansflex_com","mariasql");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("dansflex_com", $con);

$sort = "Niva";
$sort = $_GET[sort];
$sokort = $_GET[sokord];
$status = $_GET[status];



$result_farg = mysql_query("SELECT * FROM `info`");
while($row = mysql_fetch_array($result_farg))
{
$color1 = $row['Mork_Farg'];
$color2 = $row['Ljus_Farg'];
$termin = $row['Termin_Jobba'];
}

$color1 = "#CCFFCC";  
$color2 = "#BFD8BC";  
$row_count = 0; 



if ($status == "sok")
{

$result = mysql_query("SELECT * FROM amnen WHERE Amne = '$sokord' OR Niva = 'sokord' OR Alder = 'sokord' OR Dag = 'sokord' OR Tid ='sokord' OR Larare ='sokord' OR Plats =sokord' OR Spcs ='sokord'"); 
}
else
{
$result = mysql_query("SELECT * FROM amnen WHERE Termin = '$termin' ORDER BY $sort, Niva_Rank");
}

echo "<a href='redigera_kurs.php?status=nykurs'>Lägg till kurs</a><BR><BR>";

echo "<table border='0' cellpadding='1'>
<tr>
<th><a href='kurser.php?sort=Amne_Rank'>Ämne</a></th>
<th><a href='kurser.php?sort=Alder'>Ålder</a></th>
<th><a href='kurser.php?sort=Niva_Rank'>Nivå</a></th>
<th><a href='kurser.php?sort=Dag'>Dag</a></th>
<th><a href='kurser.php?sort=Tid'>Tid</a></th>
<th><a href='kurser.php?sort=Larare'>Larare</a></th>
<th><a href='kurser.php?sort=Plats'>Plats</a></th>
<th><a href='kurser.php?sort=a_id'>SPCS</a></th>
<th><a href='kurser.php?sort=a_id'>Termin</a></th>
</tr>";


while($row = mysql_fetch_array($result))
  {
 
  
  
  echo "<tr bgcolor='";
  $row_color = ($row_count % 2) ? $color1 : $color2; 
  echo $row_color;
  echo "'>";
  
  $a2_id = $row['Amne'];
  $result_amne = mysql_query("SELECT * FROM amnen2 WHERE a2_id = $a2_id");
  while($row3 = mysql_fetch_array($result_amne))
  {
  $row['Amne'] = $row3['Amne'];
  }
  
  echo "<td>" . $row['Amne'] . "</td>";
  echo "<td width='90'>" . $row['Alder'] . "</td>";
  
  $n_id = $row['Niva'];
  $result_niva = mysql_query("SELECT * FROM nivaer WHERE n_id = $n_id");
  while($row2 = mysql_fetch_array($result_niva))
  {
  $row['Niva'] = $row2['Forkort'];
  }
  
  echo "<td>" . $row['Niva'] . "</td>";
  echo "<td>" . $row['Dag'] . "</td>";
  echo "<td>" . $row['Tid'] . "</td>";
  echo "<td>" . $row['Larare'] . "</td>";
  echo "<td>" . $row['Plats'] . "</td>";
  echo "<td>" . $row['Spcs'] . "</td>";
  echo "<td>" . $row['Termin'] . "</td>";
  echo "<td>";
  
  $a_id = $row['a_id'];
  $tva = $row['Tva'];
  $dag2 = $row['Dag2'];
  $tid2 = $row['Tid2'];
  $larare2 =$row['Larare2'];
  $plats2 = $row['Plats2'];
  $result2 = mysql_query("SELECT count(*) FROM amnenelever WHERE a_id = $a_id");
 //echo $result2;
  
  
  echo "</td>";
  echo "<td> <a href='redigera_kurs.php?a_id=".$row['a_id']."&alder=".$row['Alder']."&niva=".$n_id."&dag=".$row['Dag']."&tid=".$row['Tid']."&plats=".$row['Plats']."&larare=".$row['Larare']."&amne=".$a2_id."&termin=".$row['Termin']."&dag2=".$row['Dag2']."&tid2=".$row['Tid2']."&plats2=".$row['Plats2']."&spcs=".$row['Spcs']."&larare2=".$row['Larare2']."&tva=".$row['Tva']."&status=redigera
  '>[Redigera]</a>";
/*
  echo "<td><a href='kurs.php?kurs_id=" . $row['a_id'] . "'> [Visa info]</a>";
  echo  <td><a href='anmalny.php?a_id=" . $row['a_id'] . "'> [Anmäl ny elev]</a> "; */
  echo "<td><a href='delete.php?id=" . $row['a_id'] . "&status=fraga&table=amnen&adress=kurser'>[X]</a>";
		 
  echo "</tr>";
  
  if ($tva == "ja")
  {
	  
	  	echo "<tr bgcolor='";
  $row_color = ($row_count % 2) ? $color1 : $color2; 
  echo $row_color;
  
  echo "'>";
		echo "<td></td><td></td><td></td>";
		echo "<td>";
		echo $dag2;
		echo "</td><td>";
  		echo $tid2;
		echo "</td><td>";
  		echo $larare2;
		echo "</td><td>";
 		echo $plats2;
		echo "</td><td></td><td></td><td></td><td></td><td></td></tr>";
		
	  
  }
  $row_count++;
  
  }
echo "</table>";

mysql_close($con);
?>
<br />
<br />

</body>
</html>