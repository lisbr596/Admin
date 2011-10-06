
	<ul id="navigation-1">
		<li><a href="#" title="Startsidan">Startsidan</a>
			<ul class="navigation-2">
				<li><a href='index.php?sida=startsidan/valkomsttext.php' >V&aumllkomsttext</a></li>
				
				<li><a href='index.php?sida=startsidan/viktigth.php'>Viktigt h&oumlger</a>
				<li><a href="#" title="Viktigt vänster">Viktigt v&aringnster</a></li>
				<li><a href='index.php?sida=startsidan/terminsdata.php'>Terminsdata</a></li>
			</ul>
		</li>	
		<li><a href="#" title="Kurser">Kurser</a>
			<ul class="navigation-2">
				<li><a href='index.php?sida=kurser/visaalla.php'>Visa alla kurser</a></li>
				<li><a href="index.php?sida=kurser/redigera_kurs.php">L&aringgg till kurs</a></li>
			</ul>
		</li>
		<li><a href="#" title="├ämnen">&Aumlmnen</a>
			<ul class="navigation-2">
				<li><a href="#">Visa alla &aringmnen</a></li>
				<li><a href="#" title="Log In">Redigera &aringmnen<span>&raquo;</span></a>
					<ul class="navigation-3">
						<li><a href="#" title="Showdans">Showdans</a></li>
						<li><a href="#" title="Disco">Disco</a></li>
						<li><a href="#" title="Disco">Balett</a></li>
						<li><a href="#" title="Disco">Street</a></li>
					</ul>
				<li><a href="#" title="├ändra ordning">&Aumlndra ordning</a></li>
			</ul>
		</li>
		<li><a href="#" title="Lärare">L&aumlrare</a>
			<ul class="navigation-2">
				<li><a href="index.php?sida=larare/visaallalarare.php">Visa alla l&aumlrare</a></li>
				<li><a href="#" title="Redigera Lärare">Redigera l&aumlrare<span>&raquo;</span></a>
					<ul class="navigation-3">
					
					<?php
					
					$result = mysql_query("SELECT * FROM `larare`");
					while($row = mysql_fetch_array($result))
					{
						echo "<li><a href='index.php?id=";
						echo $row['l_id'];
						echo "&status=redigera&sida=larare/redigeralarare.php'>";
						echo $row['Namn'];
						echo "</a></li>";
					}
					?>
					</ul>
				<li><a href="index.php?sida=larare/redigeralarare.php&status=ny">Skapa ny l&aumlrare</a></li>
			</ul>
		</li>
		<li><a href="#" title="Lokaler">Lokaler</a>
			<ul class="navigation-2">
				<li><a href="index.php?sida=lokaler.php" title="Visa alla lokaler">Visa alla lokaler</a></li>
				<li><a href="#" title="International">Redigera lokal <span>&raquo;</span></a>
					<ul class="navigation-3">
						
						<?php
					
					$result = mysql_query("SELECT * FROM `lokaler`");
					while($row = mysql_fetch_array($result))
					{
						echo "<li><a href='index.php?id=";
						echo $row['l_id'];
						echo "&status=redigera&sida=larare/redigeralarare.php'>";
						echo $row['Namn'];
						echo "</a></li>";
					}
					?>
						
						
					</ul>
				</li>
			</ul>
		</li>	

		<li><a href="#" title="&Oumlvriga Sidor">&Oumlvriga Sidor</a>
			<ul class="navigation-2">
						
					<?php
					
					$result = mysql_query("SELECT * FROM `sidor`");
					while($row = mysql_fetch_array($result))
					{
						echo "<li><a href='index.php?id=";
						echo $row['s_id'];
						echo "&status=redigera&sida=sidor/redigerasida.php'>";
						echo $row['Rubrik'];
						echo "</a></li>";
					}
					?>
		

			</ul>
		</li>
	</ul>


