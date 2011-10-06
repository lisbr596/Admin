
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php


function geDagvarde($dag){
if ($dag == 'Måndag') return 1;
if ($dag == 'Tisdag') return 2;
if ($dag == 'Onsdag') return 3;
if ($dag == 'Torsdag') return 4;
if ($dag == 'Fredag') return 5;
if ($dag == 'Lördag') return 6;
if ($dag == 'Söndag') return 7;
}

function varderalekt($lekt){
$varde1 = geDagvarde($lekt[1][5]);
$varde2 = geDagvarde($lekt[2][5]);
if ($varde1 <= $varde2){
$ret[1] = $lekt[1];
$ret[2] = $lekt[2];
}
else{
$ret[2] = $lekt[1];
$ret[1] = $lekt[2];
}
return $ret;
}

function skrivUtVektor($vek, $rubr){
echo "///////  ";
echo $rubr;
echo "   ///////<br>";
for ($i=0; $i< count($vek); $i++){
echo $i;
echo ":[";
echo $vek[$i];
echo "]<br>";
}
echo "<br>";
}

//stoppar in värden på 0: id	1:amne	2:Ålder		3:Nivå		8:Spcs	9: Termin	10. AntLekt
//0,1,2,3,8,9, 10
function kursvektor($row){

	$vek[0] = $row[0]; //id
	$vek[1] = $row[4]; //spcs
	$vek[3] = $row[5]; //Termin
	$vek[4] = $row[2]; //ålder
	$vek[5] = $row[3]; //nivå
	$vek[6] = "";
	$vek[7] = "";
	$vek[8] = "";
	$vek[9] = "";
	$vek[10] = $row[6]; //Ant lekt
	$amne = getTupla("amnen2", "a2_id", "$row[1]");
	$vek[2] = $amne[1]; //amne
	return $vek;
}


function laggInLektion1($lekt, $vek){

	$vek[6] = $lekt[5]; //dag
	$vek[7] = $lekt[6]; //tid
	$vek[8] = $lekt[3]; //lärare
	$vek[9] = $lekt[2]; //lokal
	$larare = getTupla("larare", "l_id", "$vek[8]");
	$vek[8] = $larare[2];  //lärare[2] ger förkortningen.
	$lokal = getTupla("lokal", "l_id", "$vek[9]");
	$vek[9] = $lokal[2];  //lokal[2] ger förkortningen.
return $vek;
}

function laggInLektion2($lekt, $vek){

	$vek[11] = $lekt[5]; //dag
	$vek[12] = $lekt[6]; //tid
	$vek[13] = $lekt[3]; //lärare
	$vek[14] = $lekt[2]; //Lokal
	$larare = getTupla("larare", "l_id", "$vek[13]");
	$vek[13] = $larare[2];  //lärare[2] ger förkortningen.
	$lokal = getTupla("lokal", "l_id", "$vek[14]");
	$vek[14] = $lokal[2];  //lokal[2] ger förkortningen.
return $vek;
}

function getKursvektor($id){

	$result = mysql_query("SELECT * FROM kurser WHERE id_kurs = $id");
	while($row = mysql_fetch_array($result)){	
/// SKAPAR VEKTOR $vek MED HELA KURSEN OCH DESS RÄTTA VÄRDEN ///
	$vek = kursvektor($row);
	
	//Hämtar de lektioner som finns och lägger dem i $lekt[1] respkt $lekt[2]
	$count = 1;
	$result2 = mysql_query("SELECT * FROM lektioner WHERE id_kurs = '$vek[0]'");
	while($row2 = mysql_fetch_array($result2)){
	$lekt[$count] = $row2;
	$count++;
	}
	//soreterar lektionerna rätt om det finns två
	if($vek[10] > 1) {
	$lekt = varderaLekt($lekt);
	$vek = laggInLektion2($lekt[2], $vek);
	}
	$vek = laggInLektion1($lekt[1], $vek);
}
return $vek;
}


function fixaKursvektor($row){
	
/// SKAPAR VEKTOR $vek MED HELA KURSEN OCH DESS RÄTTA VÄRDEN ///
	$vek = kursvektor($row);
	
	//Hämtar de lektioner som finns och lägger dem i $lekt[1] respkt $lekt[2]
	$count = 1;
	$result2 = mysql_query("SELECT * FROM lektioner WHERE id_kurs = '$vek[0]'");
	while($row2 = mysql_fetch_array($result2)){
	$lekt[$count] = $row2;
	$count++;
	}
	//soreterar lektionerna rätt om det finns två
	if($vek[10] > 1) {
	$lekt = varderaLekt($lekt);
	$vek = laggInLektion2($lekt[2], $vek);
	}
	$vek = laggInLektion1($lekt[1], $vek);

return $vek;
}

function ritaKurstabellrad($vek, $color){

echo "<tr bgcolor='$color'>";
for ($i=1; $i<=9; $i++){
echo "<td>";
echo $vek[$i];
echo "</td>";
}
echo "<td>";
echo "<a href='index.php?sida=kurser/redigera_kurs.php&status=redigera&kursid=";
echo $vek[0];
echo "'>[redigera]</a>";
echo "</td>";
echo "</tr>";

if($vek[10] > 1) {
echo "<tr bgcolor='$color'>";
for ($i=1; $i<=5; $i++){
echo "<td>";
echo "</td>";
}
for ($i=11; $i<=14; $i++){
echo "<td>";
echo $vek[$i];
echo "</td>";
}
echo "</tr>";
}
}





?>