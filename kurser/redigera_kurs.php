
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

$status = $_GET[status];
echo $status;
$lokalvektor = getIdColumn('lokal', 'Lokal');
$amnesvektor = getIdColumn('amnen2', 'Amne');
$lararvektor = getIdColumn('larare', 'Namn');
$nivavektor = getIdColumn('nivaer', 'Niva');

if($status=='redigera'){
$kursid = $_GET[kursid];
echo $kursid;
$kursvektor = getKursvektor($kursid);
}

echo $kursvektor[1];
skrivUtVektor($kursvektor, 'vektorn');

?>
