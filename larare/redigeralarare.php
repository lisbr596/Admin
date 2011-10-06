
<?php 



$id = $_GET[id];

if (!isset($_POST[status])){
$status = $_GET[status];
}
else {$status = $_POST[status];}
$sida = $_GET[sida];


/// OM DELETE
if($status == "delete"){
$vek = getTupla("larare", "l_id", $id);

$query = "DELETE FROM larare WHERE l_id='".$id."'";
mysql_query($query);

$status = "ny";
$id = "";

echo "<div id='stylenote' class='notifikation'><p>";
echo $vek[1];
echo " har raderats</P></div>";

}


/// OM VI BEHÖVER LADDA UPP EN BILD
if($status == 'uppdaterat' || $status == 'insert'){

$namn = $_POST[Namn];
$forkort = $_POST[Forkort];
$beskr = $_POST[Beskr];


if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 200000))
  {
  echo "steg1<br>";
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
	/*
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	*/

  /*  if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {*/
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	  $stored = "upload/" . $_FILES["file"]["name"];
      
    }
  }
else
  {
  
  
  if ($status == "uppdaterat") {
  $vek = getTupla("larare", "l_id", $id);
  $stored = $vek[4];
  }
  
  
  }



 $n = $namn;
 $f = $forkort;
 $be = $beskr;
 $bi = $stored;


if ($status == "uppdaterat") {
$query = "UPDATE larare SET Namn = '".$n."', Forkort='".$f."', Beskr='".$be."', Bild='".$bi."'
WHERE l_id = '$id'";
mysql_query($query);
}
elseif ($status == "insert") {
$query = "INSERT INTO larare (Namn, Forkort, Beskr, Bild)
VALUES ('".$n."', '".$f."', '".$be."', '".$bi."')";
mysql_query($query);
$last_inserted_row = mysql_insert_id($con);
}


$id = $last_inserted_row;
$status = "redigera";


}

if ($status == redigera) {
}


$var = getTupla("larare", "l_id", "$id");
?>



<div id="stylized" class="myform">

<?php
echo "<h3>";

if($status == "ny") { echo "L&auml;gg till L&auml;rare";}
elseif($status == "redigera") { echo $var[1];}

echo "</h3>";
?>
<form action="index.php?sida=larare/redigeralarare.php&id=<?php echo $id; ?>" method="post"  enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="40%">Namn:<br><input name="Namn" value="<?php echo $var[1]; ?>" type="text" size="60" maxlength="60" /><br />
      <br /></td></tr><tr>
	<td width="40%">F&oumlrkortning:<br><input name="Forkort" value="<?php echo $var[2]; ?>" type="text" size="60" maxlength="60" /><br />
      <br /></td>
  </tr>
    <tr>
    <td width="40%">
<input type="file" name="file" id="file" />
      <br /></td>
  </tr>
  <tr>
    <td><textarea name="Beskr" cols="60" rows="10" width="100"><?php echo $var[3]; ?></textarea></td>
  </tr>
    <tr>
    <td align="right">
      
	  <?php 
	  $ad = "index.php?sida=larare/redigeralarare.php&status=delete&id=".$id."";
	 //echo "<a href='index.php?sida=larare/redigeralarare.php&status=delete&id=";
	 echo "<a href='".$ad."'";
	 
	 ?>
	 OnClick="return confirm('Vill du verkligen radera?');">[Ta bort]</a>
	  
	 <?php
	 if ($status == "redigera") {
	  echo "<input type='hidden' name='status' id='status' value='uppdaterat' />";
	  }
	 elseif ($status == "ny") {
	  echo "<input type='hidden' name='status' id='status' value='insert' />";
	  }
	?>
	  <input type='submit' value='Spara'/>

	   </td>

  </tr>
</table>
</form>
</div>

<?php
echo "<table cellpadding=0 border=0 bordercolor='#555555'>";
echo "<tr><td width='200'>";
echo "<img src=";
echo $var[4];
echo "></td><td width='400'><b>";
echo $var[1];
echo "</b> ";
echo $var[3];
echo "</td></tr>";
echo "</table>";
echo "<br><br>";

?>



