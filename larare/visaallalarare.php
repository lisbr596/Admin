
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php


/*$sort = "Niva";
$sort = $_GET[sort];
$sokort = $_GET[sokord];
$status = $_GET[status];
*/



$result_farg = mysql_query("SELECT * FROM `info`");
while($row = mysql_fetch_array($result_farg))
{
$color1 = $row['Mork_Farg'];
$color2 = $row['Ljus_Farg'];
$termin = $row['Termin_Jobba'];
}

echo "<h1>Lärare</h1>";

$result = mysql_query("SELECT * FROM larare");
$count = 0;
	while($row = mysql_fetch_array($result)){
echo "<table cellpadding=0 border=0 bordercolor='#555555'>";
echo "<tr><td width='200'>";
echo "<img src=";
echo $row['Bild'];
echo "></td><td width='400'><b>";
echo $row['Namn'];
echo "</b><br>";
echo $row['Beskr'];
echo "</td></tr>";
echo "</table>";
echo "<br><br>";
	$count++;
	}


	
mysql_close($con);
?>
<br />
<br />

</body>
</html>