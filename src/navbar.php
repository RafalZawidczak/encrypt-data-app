<?php

	echo 
		'<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
				  <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Szyfrowanie symetryczne
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					  <a class="dropdown-item" href="AES128.php">AES128</a>
					  <a class="dropdown-item" href="AES192.php">AES192</a>
					  <a class="dropdown-item" href="AES256.php">AES256</a>
					  <a class="dropdown-item" href="Blowfish.php">Blowfish</a>
					  <a class="dropdown-item" href="CAMELLIA128.php">CAMELLIA128</a>
					  <a class="dropdown-item" href="CAMELLIA192.php">CAMELLIA192</a>
					  <a class="dropdown-item" href="CAMELLIA256.php">CAMELLIA256</a>
					  <a class="dropdown-item" href="DES.php">DES</a>
					  <a class="dropdown-item" href="IDEA.php">IDEA</a>
					  <a class="dropdown-item" href="rc4.php">RC4 (ARCFOUR)</a>
					</div>
				  </li>
						<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Szyfrowanie asymetryczne
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					   <a class="dropdown-item" href="RSA.php">RSA</a>
					</div>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="HASH.php">Funkcje skrótu</a>
				  </li>

				</ul>
			  </div>
		 </nav>';
 ?>
	