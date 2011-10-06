<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"> 
<html>
<head>
<title>Webdesignskolan, CSS-meny med PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="layout.css" rel="stylesheet" type="text/css">
<link href="meny.css" rel="stylesheet" type="text/css">
</head>
<body>


<div id="stylized" class="myform">
<form id="form" name="form" method="post" action="index.html">
<h1>Sign-up form</h1>
<p>This is the basic look of my form without table</p>

<label>Namn
<span class="small">Ange lärarens namn</span>
</label>
<input type="text" name="name" id="name" />

<label>Förkortning
<span class="small">Visas i schema</span>
</label>
<input type="text" name="email" id="email" />

<textarea name="Beskr" cols="60" rows="10" width="100"><?php echo $var[3]; ?></textarea>

<button type="submit">Sign-up</button>
<div class="spacer"></div>

</form>
</div>

</body>