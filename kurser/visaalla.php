
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php

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

echo "<h1>Alla kurser</h1>";

echo "<table cellpadding='3'>";

$result = mysql_query("SELECT * FROM kurser");
$count = 0;
	while($row = mysql_fetch_array($result)){
	$vek = fixaKursvektor($row);

	///ge rätt färg
	$color1 = "#b6bfff";  
	$color2 = "#b6f2ff";
	$mod = $count % 2;
	if($mod == 0) $color = $color1;
	else $color = $color2;
	/////
	ritaKurstabellrad($vek, $color);
	$count++;
	}

echo "</table>";
	
mysql_close($con);
?>
<br />
<br />

</body>
</html>