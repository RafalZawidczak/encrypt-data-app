<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<title>Blowfish</title>
	</head>
		<body>
			<!-- NAVBAR -->
			<?php include 'src/navbar.php'; ?>
			<!-- header -->
			<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">Blowfish</span></h1></div>
			<!-- formularz -->
			<div class="container-fluid ">
				<div class="row justify-content-center align-items-center ">
					<div class="col col-sm-6 ">
						<form method="POST">
							<!-- Tekst jawny -->
								<div class="form-group">
							<label for="fnum">Tekst jawny:</label> 
							<textarea id="fnum" name="fnum"  required="required" class="form-control"></textarea> 
						
							</div>
							<div class="form-group">
							<!-- Klucz -->
							<label for="snum" >Klucz:</label> 
							<input type="text" id="oascii" required="required" name="snum"  minlength="4" maxlength="56" aria-describedby="snumHelpBlock"  class="form-control">
							<span id="snumHelpBlock" class="form-text text-muted">4 do 56 bajtów</span>
							</div>
							<div id="IV" class="form-group">
							<!-- Wektor inicjujący w postaci tekstu jawnego -->
								<div id="pl" style='display:none'> 
									<label for="IV">Wektor inicjujący:</label> 
									<input type="text"   name="IVp" id="IVp" minlength="8" maxlength="8" aria-describedby="IVHelpBlock" class="form-control"> 
									<span id="IVHelpBlock" class="form-text text-muted">IV w postaci tekstu jawnego</span> 
								</div>
								<!-- Wektor inicjujący w postaci hex -->
								<div id="hex" style='display:none'> 
									<label for="IV">Wektor inicjujący:</label> 
									<input type="text"   name="IVh" id="IVh" minlength="16" maxlength="16" aria-describedby="IVHelpBlock" class="form-control"> 
									<span id="IVHelpBlock" class="form-text text-muted">IV w postaci hexadecymalnej</span> 
								</div>
								<!-- Wybór formatu wprowadzanego IW -->							
								<div style="display:none" id="IVV" >
									<label>Wybierz format wprowadzanych danych dla wektora inicjującego:</label> 
									<div class="custom-control custom-radio custom-control-inline">
										<input name="format" autocomplete="off"  id="radio0" type="radio" class="custom-control-input" value="Plaintext"> 
										<label for="radio0" class="custom-control-label">Tekst jawny</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input name="format"  autocomplete="off" id="radio1" type="radio" class="custom-control-input" value="Hex"> 
										<label for="radio1" class="custom-control-label">Hex</label>
									</div>
								</div>
							</div>
							<div class="form-group">
							<!-- Tryb -->
							<label>Tryb:</label> 
								<div>
									<div class="custom-control custom-radio custom-control-inline">
										<input name="mode"  checked id="radio_0" type="radio" class="custom-control-input" value="ECB"> 
										<label for="radio_0" class="custom-control-label">ECB</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input name="mode"  autocomplete="off" id="radio_1" type="radio" class="custom-control-input" value="CBC"> 
										<label for="radio_1" class="custom-control-label">CBC</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input name="mode"  autocomplete="off" id="radio_2" type="radio" class="custom-control-input" value="CFB"> 
										<label for="radio_2" class="custom-control-label">CFB</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input name="mode" autocomplete="off" id="radio_3" type="radio" class="custom-control-input" value="OFB"> 
										<label for="radio_3" class="custom-control-label">OFB</label>
									</div>
								</div>
							</div> 
							<div class="form-group">
							<button name="add" type="submit" class="btn btn-primary btn-md btn-block">Zaszyfruj</button>
							</div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
			<script src="src/validation.min.js"></script>


		<?php

		if(isset($_POST['add']))
		{
		
			$message = $_POST['fnum'];
			$key = $_POST['snum'];
			if (isset($_POST['format'])){
				$format = $_POST['format'];
				if ($format == 'Plaintext') {
					$iv = $_POST['IVp'];
				}
					else {
						$iv= '';
						$hex = $_POST['IVh'];
						for ($i=0; $i < strlen($hex)-1; $i+=2){
						$iv .= chr(hexdec($hex[$i].$hex[$i+1]));
						}
					}	
			}

			$message_padded = $message;	
			$mode = $_POST['mode'];
			//padding
			 $blockSize = 8;
			$len = strlen($message);
			$paddingLen = intval(($len + $blockSize - 1) / $blockSize) * $blockSize - $len;
			$padding = str_repeat("\0", $paddingLen);
			$data = $message . $padding;
				


			if ($mode == 'CBC')
			{
			$encrypted_openssl = openssl_encrypt($data, "BF-CBC", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
			}
			else if ($mode == 'ECB')
			{
			$encrypted_openssl = openssl_encrypt($data, "BF-ECB", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
			}
			else if ($mode == 'CFB')
			{
			$encrypted_openssl = openssl_encrypt($message, "BF-CFB", 
				$key, OPENSSL_RAW_DATA , $iv);
			}
			else if ($mode == 'OFB')
			{
			$encrypted_openssl = openssl_encrypt($message, "BF-OFB", 
				$key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv);
			}

		}

?>
								<div class="form-group">
								<label for="ciphed">Tekst zaszyfrowany</label> 
								<textarea id="ciphed" name="ciphed"  readonly class="form-control"><?php if(isset($_POST['add'])) {echo chunk_split(bin2hex($encrypted_openssl), 2, ' ');} ?> </textarea> 
								</div>
						</form>
					</div>
				</div>
			</div>
			<div class="container-fluid ">
				<div class="row justify-content-center align-items-center">
					<div class="col col-sm-6 ">
						<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapseone">Opis algorytmu</a>
								</h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-11 ">
													<p><strong>&sdot;</strong>Autor: Bruce Schneier</p>
													<p><strong>&sdot;</strong>Rok powstania: 1993</p>
													<hr />
													<h2 style="text-align: center;">Historia</h2>
													<p style="text-align: justify;">Blowfish jest szyfrem blokowym stworzonym przez Bruce'a Schneiera w 1993 roku jako bezpłatna alternatywa dla istniejących &oacute;wcześnie algorytm&oacute;w, w tym m.in. dla DES.</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Szyfr pracuje na 64-bitowych blokach, a także na kluczach, kt&oacute;re mogą mieć długość od 32 do 448 bit&oacute;w. Szyfrowanie przebiega w następujący spos&oacute;b:</p>
													<ol style="text-align: justify;">
													<li>Przed pierwszą rundą tworzone jest 18 tablic P (P<sub>1, </sub>P<sub>2</sub>..., P<sub>18</sub>), kt&oacute;re składają się z 32-bitowych kluczy pomocniczych;</li>
													<li>Blok 64-bit&oacute;w tekstu jawnego dzielony jest na 32-bitowe części: x<sub>L </sub>(starsze bity) i x<sub>R</sub> (młodsze bity);</li>
													<li>Wykonywana jest operacja XOR P<sub>i </sub>(gdzie i jest numerem rundy) z x<sub>L</sub>, a wynik jest poddawany operacjom specjalnej funkcji algorytmu Blowfish;</li>
													<li>Wynik funkcji jest poddawany operacji XOR z x<sub>R</sub>;</li>
													<li>X<sub>L</sub> jest zamieniane miejscem z x<sub>R</sub>;</li>
													<li>Powr&oacute;t do punktu numer 3. Wykonywane jest łącznie 16 iteracji. Po ostatniej iteracji pomijany jest punkt numer 5 (x<sub>L</sub> nie jest zamieniane miejscem z x<sub>R)</sub>;</li>
													<li>X<sub>R </sub>jest poddawane operacji XOR z P<sub>17</sub>, a x<sub>L</sub> z P<sub>18,</sub></li>
													<li>Następuje połączenie x<sub>L</sub> z x<sub>R</sub>. W ten spos&oacute;b powstaje zaszyfrowany 64-bitowy blok.</li>
													</ol>
													<p style="text-align: justify;">Obecnie algorytm jest uważany za podatny na niekt&oacute;re rodzaje atak&oacute;w, z tego też powodu jego tw&oacute;rca zaleca przejście na algorytm Twofish.</p>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>

						</div>
					</div>
				</div>
			</div>
				<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</body>
</html>