<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../stilmall.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<script language="javascript" type="text/javascript">
function showHide(shID) {
   if (document.getElementById(shID)) {
      if (document.getElementById(shID+'-show').style.display != 'none') {
         document.getElementById(shID+'-show').style.display = 'none';
         document.getElementById(shID).style.display = 'block';
      }
      else {
         document.getElementById(shID+'-show').style.display = 'inline';
         document.getElementById(shID).style.display = 'none';
      }
   }
}
</script>
<style type="text/css">
.more {
      display: none;
      border-top: 1px solid #666;
      border-bottom: 1px solid #666; }
   a.showLink, a.hideLink {
      text-decoration: none;
      color: #36f;
      padding-left: 8px;
      background: transparent url(down.gif) no-repeat left; }
   a.hideLink {
      background: transparent url(up.gif) no-repeat left; }
   a.showLink:hover, a.hideLink:hover {
      border-bottom: 1px dotted #36f; }
</style>





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
		
		
		$a_id = $_GET[a_id];
		$amne = $_GET[amne];
		$niva = $_GET[niva];
		$alder = $_GET[alder];
		$dag = $_GET[dag];
		$tid = $_GET[tid];
		$plats = $_GET[plats];
		$larare = $_GET[larare];
		$dag2 = $_GET[dag2];
		$tid2 = $_GET[tid2];
		$plats2 = $_GET[plats2];
		$larare2 = $_GET[larare2];
		$termin = $_GET[termin];
		$spcs = $_GET[spcs];
		$status = $_GET[status];
		$elever =$_GET[elever];
		$tva =$_GET[tva];
		$niva_rank =$_GET[niva_rank];
		$amne_rank =$_GET[amne_rank];
$full =$_GET[full];


		
		
		function getTermin() {
		$result_farg = mysql_query("SELECT * FROM `info`");
		while($row = mysql_fetch_array($result_farg))
		{
		return $row['Termin_Jobba'];
		}
		}
		$termin = getTermin();
		
		
		$result_niva = mysql_query("SELECT * FROM nivaer WHERE n_id = $niva");
		while($row1 = mysql_fetch_array($result_niva))	
		{
		$niva_rank = $row1['Rank'];
		
		}
		
		$result_amne = mysql_query("SELECT * FROM amnen2 WHERE a2_id = $amne");
		while($row2 = mysql_fetch_array($result_amne))	
		{
		$amne_rank = $row2['Rank'];
		}
		
		
	
	/* --------- LISTAN DÄR VI DEFINIERAR VAD SOM SKA HÄNDA BEROENDE PÃ… VAD SIDAN SKA GÃ–RA ----- */
	
	if ($status == "nykurs")
	{
		echo "<h1>Lägg till en ny kurs</h1>";
	}
	
	elseif ($status == "redigera")
	{
		echo "<h1>redigera kurs</h1>";



/* ------------------ hämtar info om kursen som ska redigeras ----------------------- */

$result_redig = mysql_query("SELECT * FROM amnen WHERE a_id = '$a_id'");
	while($row = mysql_fetch_array($result_redig))	$full = $row['Full'];

}
	elseif ($status == "insert")
	{
		
		//räknar ut vilken ranking!
		$result_no = mysql_query("SELECT * FROM amnen WHERE Amne='$amne' and Termin = '$termin'");
$max = mysql_num_rows($result_no);
		
		$sql="INSERT INTO amnen (Amne, Alder, Niva, Dag, Tid, Plats, Larare, Termin, Spcs, Dag2, Tid2, Plats2, Larare2, Tva, Niva_Rank, Amne_Rank, Full)
		VALUES ('$amne', '$alder', '$niva', '$dag', '$tid', '$plats', '$larare', '$termin', '$spcs', '$dag2', '$tid2', '$plats2', '$larare2', '$tva', '$max', '$amne_rank', '$full')";
		{
		
				if (!mysql_query($sql,$con))
				{
  					die('Error: ' . mysql_error());
 				}
				
				$a_id2 = mysql_insert_id();
				echo "<h1>Ny kurs tillagd : ";
				echo $spcs;
				echo "</h1>";
				echo "<a href='redigera_amne.php?a2_id=$amne'>Gå till ämne</a> | <a href='redigera_kurs.php?status=nykurs'>Lägg till ny kurs</a>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
		}
	}
	elseif ($status == "uppdaterat")
	{
	
	
	//TESTA OM ÄMNET HAR ÄNDRATS
	
	//Sätter variabeln gammal till det ämnet som var innan
	$result = mysql_query("SELECT * FROM `amnen` where a_id='$a_id'");
while($row = mysql_fetch_array($result)){
  $gammal = $row['Amne'];
  $rank = $row['Niva_Rank'];
  } //while
	
	//testar om gammal == $amne
	if($gammal == $amne){
	$lika = 1;
	$max = $rank;
	} //if
	else{
	//gör allt som om du skulle ta bort en från amne.
	//hämtar alla andra kurser med samma ämne
	$result_om = mysql_query("SELECT * FROM amnen WHERE Amne='$gammal' and Termin = '$termin ORDER BY Niva_Rank");
	while($row = mysql_fetch_array($result_om)) {
	$rank2 = $row['Niva_Rank'];
	$a_id22 = $row['a_id'];
	if($row['Niva_Rank'] > $rank){
	$rank3 = $rank2-1;
	$result = mysql_query("UPDATE amnen SET Niva_Rank='$rank3' WHERE a_id='$a_id22'") ;
	}
	}
	
	//HITTA DEN NYA RANKINGEN, antal kurser med Amne = nya ämnet
	$result_rank = mysql_query("SELECT * FROM amnen WHERE Amne='$amne' Termin = '$termin'");
	while($row = mysql_fetch_array($result_rank)) {
	}
	$max = mysql_num_rows($result_rank);
	
	}

/*
$result = mysql_query("UPDATE amnen SET Amne='$amne', Niva='$niva' WHERE a_id='167'") ;
$result_fargg = mysql_query("SELECT * FROM `amnen` WHERE a_id = '167'");

	while($row = mysql_fetch_array($result_fargg))
		{
	//	echo $row['Niva'];
		}

*/

mysql_query("UPDATE amnen SET Amne='$amne', Niva='$niva', Spcs='$spcs', Alder='$alder', Dag='$dag', Tid='$tid', Plats='$plats', Larare='$larare', Termin='$termin', Dag2='$dag2', Tid2='$tid2', Plats2='$plats2', Larare2='$larare2', Tva='$tva', Niva_Rank='$max', Amne_Rank='$amne_rank', Full='$full'
WHERE a_id = '$a_id'");


	//	echo "Termin: $termin";
				echo "<h1>Kursen uppdaterad : ";
				echo $spcs;
				echo "</h1>";
				echo "<a href='redigera_amne.php?a2_id=$amne'>Gå till ämne</a> | <a href='redigera_kurs.php?status=nykurs'>Lägg till ny kurs</a>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
		
		
		
	}
	elseif ($status == "overfor")
	{
		echo "overfor";-
		$sql="INSERT INTO amnen (Amne, Alder, Niva, Dag, Tid, Plats, Larare, Dag2, Tid2, Plats2, Larare2, Termin, Spcs, Tva, Niva_Rank)
		VALUES ('$amne', '$alder', '$niva', '$dag', '$tid', '$plats', '$larare', '$dag2', '$tid2', '$plats2', '$larare2', '$termin', '$spcs', '$tva', '$niva_rank')";
		
		{
		
				if (!mysql_query($sql,$con))
				{
  					die('Error: ' . mysql_error());
 				}
				
				$a_id3 = mysql_insert_id();
				echo "Har överfört kurs, nytt id: ";
				echo $a_id3;
				echo "<br>";
				echo "SPCS-nummer: ";
				echo $spcs;
				
				if ($elever == "overfor")
				{
					
					echo $elever;
					echo "<br>";
					$result = mysql_query("SELECT * FROM amnenelever WHERE Kurs = $a_id");
					while($row = mysql_fetch_array($result))
					{
						
						$elev = $row['Elev'];
						$kurs = $row['Elev'];
						$registrerad = $row['Registrerad'];
						$spcs2 = $row['Spcs'];
						
						$sql="INSERT INTO amnenelever (Spcs, Kurs, Elev, Registrerad)
						VALUES ('$spcs2', '$a_id3', '$elev', '$registrerad')";
						if (!mysql_query($sql,$con))
						{
  						die('Error: ' . mysql_error());
 						}
						
						
						
					}
					
					
				}
				
		}
		
	}
	/* -------------- HÄR BÃ–RJAR SJÄLVA FORMULÄRET --------------- */ 
	
	?>
	
	

<form action="redigera_kurs.php?status=<?php $status ?>" method="get">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
<td></td><td>
  Är gruppen full?  <input type="checkbox" name="full" value="1" 
  <?php 
  if ($full == "1")
  {
   echo "checked";
   }
  ?>
  /><br>
  </td></tr><tr>
    <td width="5%">Ämne:</td>
    <td width="95%"><select name="amne"><option value="tom">
    <?php $result = mysql_query("SELECT * FROM amnen2");
	while($row = mysql_fetch_array($result))
	{
		$var = $row['Amne'];
		$fork = $row['Forkort'];
		$a2_id = $row['a2_id'];
		echo "<option value=";
		echo $a2_id;
		
		if ($amne == $a2_id) { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		
		echo $var;
		echo "</option>";
	 }
	 echo "</select>";
    ?>
    
    </td>
  </tr>
  <tr>
    <td>Ålder:</td>
    <td><input type="text" name="alder" value="<?php echo $alder; ?>"/></td>
  </tr>
  <tr>
    <td>Nivå:</td>
    <td>
    
    <select name="niva"><option value="">
    <?php $result = mysql_query("SELECT * FROM nivaer");
	while($row = mysql_fetch_array($result))
	{
	
	
	
		$var = $row['Niva'];
		$fork = $row['Forkort'];
		$n_id = $row['n_id'];
		echo "<option value='";
		
		echo $n_id;
		echo "'";
		
			if ($niva == $n_id)
			{ 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		echo $var;
		echo "</option>";
		
	 }
	 
	 if ($tva == "ja")
	 {
	}
	 else
	 {
	 
	 
	 ?>
     
     </select> 
	 <?php } ?>
    
    
    
    </td>
  </tr>
  <tr>
    <td>Dag:</td>
    <td>
      <select name="dag"><option value="">
    <option value=Måndag
    <?php if ($dag == 'Måndag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>
        Måndag</option>
    <option value=Tisdag
        <?php if ($dag == 'Tisdag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>
        Tisdag</option>
    <option value=Onsdag
    
        <?php if ($dag == 'Onsdag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Onsdag</option>
    <option value=Torsdag
    
        <?php if ($dag == 'Torsdag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Torsdag</option>
    <option value=Fredag
    
        <?php if ($dag == 'Fredag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Fredag</option>
    <option value=Lördag
        <?php if ($dag == 'Lördag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Lördag</option>
    <option value=Söndag
        <?php if ($dag == 'Söndag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Söndag</option>
    </td>
  </tr>
  <tr>
    <td>Tid:</td>
    <td><input type="text" name="tid" MAXLENGTH="11" value="<?php echo $tid; ?>" /> (xx.xx-xx.xx)</td>
  </tr>
  
   <tr>
    <td>Lärare:</td>
    <td>
    
      <select name="larare"><option value="">
    <?php $result = mysql_query("SELECT * FROM larare");
	while($row = mysql_fetch_array($result))
	{
		$var = $row['Namn'];
		$fork = $row['Forkort'];
		echo "<option value=";
		echo $var;
		
			if ($larare == $fork) { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		echo $var;
		echo "</option>";
	 }
	 echo "</select>";
    ?>
    
    </td>
  </tr>
  
  <tr>
    <td>Plats:</td>
    <td>
    
      <select name="plats"><option value="">
    <?php $result = mysql_query("SELECT * FROM lokal");
	while($row = mysql_fetch_array($result))
	{
		$var = $row['Forkort'];
		echo "<option value=";
		echo $var;
		
		if ($plats == $var) { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		echo $var;
		echo "</option>";
	 }
	 echo "</select>";
    ?>
    
    
    </td>
  </tr>
 <tr>
    <td>SPCS-kod:</td>
    <td>
    
    <input type="text" name="spcs" value="<?php echo $spcs; ?>"/> (koden från faktureringsprogrammet)
   
    </td>
  </tr>
  <tr>
    <td>Termin: </td>
    <td>
    <?php echo $termin; ?>
	 (för att ändra terminen måste du ändra vilken termin som är aktiv på adminsidan)
    <input type="hidden" name="termin" value="<?php echo $termin; ?>"/><BR />
    
    
    <input type="hidden" name="a_id" value="<?php echo $a_id; ?>"/>
    
    </td>
  </tr>
  
  </table><br /><br />
  
  
  <table>
  <tr><td></td>
  <td>
  Lektion 2?  <input type="checkbox" name="tva" value="ja" 
  <?php 
  if ($tva == "ja")
  {
   echo "checked";
   }
  ?>
  />
  </td>
  </td></tr>
  
  <tr>
  <td>
  Dag: 
  </td>
     
    <td>
      <select name="dag2" id="txt1"><option value"">
    <option value=Måndag
    <?php if ($dag2 == 'Måndag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>
        Måndag</option>
    <option value=Tisdag
        <?php if ($dag2 == 'Tisdag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>
        Tisdag</option>
    <option value=Onsdag
    
        <?php if ($dag2 == 'Onsdag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Onsdag</option>
    <option value=Torsdag
    
        <?php if ($dag2 == 'Torsdag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Torsdag</option>
    <option value=Fredag
    
        <?php if ($dag2 == 'Fredag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Fredag</option>
    <option value=Lördag
        <?php if ($dag2 == 'Lördag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Lördag</option>
    <option value=Söndag
        <?php if ($dag2 == 'Söndag') { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		?>Söndag</option>
    </td>
  </tr>
  <tr>
    <td>Tid:</td>
    <td><input type="text" name="tid2" MAXLENGTH="11" value="<?php echo $tid2; ?>" /> (xx.xx-xx.xx)</td>
  </tr>
  
   <tr>
    <td>Lärare:</td>
    <td>
    
      <select name="larare2" id="txt1"><option value"">
    <?php $result = mysql_query("SELECT * FROM larare");
	while($row = mysql_fetch_array($result))
	{
		$var = $row['Namn'];
		$fork = $row['Forkort'];
		echo "<option value=";
		echo $var;
		
			if ($larare2 == $fork) { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		echo $var;
		echo "</option>";
	 }
	 echo "</select>";
    ?>
    
    </td>
  </tr>
  
  <tr>
    <td>Plats:</td>
    <td>
    
      <select name="plats2" id="txt1"><option value"">
    <?php $result = mysql_query("SELECT * FROM lokal");
	while($row = mysql_fetch_array($result))
	{
		$var = $row['Forkort'];
		echo "<option value=";
		echo $var;
		
		if ($plats2 == $var) { 
			echo " selected>";
			}	
		else 
		{
			echo ">";
		}
		echo $var;
		echo "</option>";
	 }
	 echo "</select>";
	 
    ?>
    
    
    </td>
  </tr>
  
  
  </table>
  
  
  <BR /><BR />
  
  
  
  <?php
  if ($status == "nykurs")
{
	echo "<input type='hidden' name='status' value='insert' />";
}

 if ($status == "insert")
{
	echo "<input type='hidden' name='status' value='uppdaterat' />";
}

 if ($status == "redigera")
{
	echo "<input type='hidden' name='status' value='uppdaterat' />";
}
 if ($status == "uppdaterat")
{
	echo "<input type='hidden' name='status' value='uppdaterat' />";
}

  ?>
  
 
              <input type="submit" value="Spara ändringar"/>
</form>

<?php


mysql_close($con);
?>
</body>
</html>