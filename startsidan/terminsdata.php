
<head>
<title>Webdesignskolan, CSS-meny med PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="layout.css" rel="stylesheet" type="text/css">
<link href="meny.css" rel="stylesheet" type="text/css">
</head>
<?php 


$terminsdata = $_GET[Terminsdata];
$status = $_GET[Status];

if($status == 'uppdaterat'){
mysql_query("UPDATE startsidan SET Terminsdata='$terminsdata'
WHERE id_start = '1'");
}


$var = getTupla("startsidan", "id_start", "1");
?>

<h3>Terminsdata</h3>
<form action="index.php" method="get">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><textarea name="Terminsdata" cols="60" rows="10" width="100"><?php echo $var[9]; ?></textarea></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td align="right"><p>&nbsp;
      </p>
      <p>
	  <input type='hidden' name='sida' id='sida' value='startsidan/terminsdata.php' />
	  <input type='hidden' name='Status' id='Status' value='uppdaterat' />
        <input type='submit' value='Spara'/>
      </p></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>


