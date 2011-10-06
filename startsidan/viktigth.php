

<?php 



$rubrik = $_POST[Rubrik];
$text = $_POST[Text];
$status = $_POST[Status];


if($status == 'uppdaterat'){
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
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	  $stored = "upload/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }


mysql_query("UPDATE startsidan SET RubViktigtH='$rubrik', ViktigtH='$text', BildViktigtH='$stored'
WHERE id_start = '1'");



}


$var = getTupla("startsidan", "id_start", "1");
?>

<div id="stylized" class="myform">

<h3>Viktigt Höger</h3>
<form action="index.php?sida=startsidan/viktigth.php" method="post"  enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="40%"><input name="Rubrik" value="<?php echo $var[3]; ?>" type="text" size="60" maxlength="60" /><br />
      <br /></td>
  </tr>
    <tr>
    <td width="40%">
<input type="file" name="file" id="file" />
      <br /></td>
  </tr>
  <tr>
    <td><textarea name="Text" cols="60" rows="10" width="100"><?php echo $var[4]; ?></textarea></td>
  </tr>
    <tr>
    <td align="right">
      <p>
	  <input type='hidden' name='sida' id='sida' value='startsidan/viktigth.php' />
	  <input type='hidden' name='Status' id='Status' value='uppdaterat' />
        <input type='submit' value='Spara'/>
      </p></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<table width="300" bgcolor="#d9ffb4" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td><h3><?php echo $var[3]; ?></h3></td>
  </tr>
    <tr>
    <td><h3><img src=<?php echo $var[5]; ?>></h3></td>
  </tr>
  <tr>
    <td><?php echo $var[4]; ?></td>
  </tr>
</table>
</div>
