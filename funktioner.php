<?php


function getTupla($table,$id,$varde)
{
  $result = mysql_query("SELECT * FROM $table WHERE $id = '$varde'");
	while($row = mysql_fetch_array($result)){
	$var = $row;
	}
		return $var;
}


function getColumn($table,$column) {
$result = mysql_query("SELECT * FROM $table");
	$count = 0;
	while($row = mysql_fetch_array($result)){

	$var[$count] = $row[$column];
	$count++;
	}
return $var;
}

function getIdColumn($table,$column) {
$result = mysql_query("SELECT * FROM $table");
	$count = 0;
	while($row = mysql_fetch_array($result)){
	$tillf = $row;
	$var[$count][0] = $tillf[0];
	$var[$count][1] = $row[$column];
	$count++;
	}
return $var;
}


function getKurs($varde) {
$result = mysql_query("SELECT * FROM kurser WHERE id_kurs = '$varde'");
	while($row = mysql_fetch_array($result)){
	$lokal = $row['Plats'];

	$var = $row;
		$result_lokal = mysql_query("SELECT * FROM lokaler WHERE id_lokal =$lokal");
		while($row = mysql_fetch_array($result_lokal)){
	$var[2] = $row['Namn'];
	}
	}
return $var;
}

function skapaDropDown($table, $kolumn, $name, $selected){
$lista = getIdColumn($table, $kolumn);
$strlLista = sizeof($lista);
echo "<select name=$name size=''>";
 for($i=0; $i<$strlLista; $i++){
  echo "<option value=";
  echo $lista[$i][0]; 
  if($lista[$i][0] == $selected){
  echo " selected='selected'";
  }
	  echo ">";
  echo $lista[$i][1];
  echo "</option>";
 }
 echo "</select>";
}






?>