<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<title>AES-128</title>
	</head>
		<body>
			<!-- NAVBAR -->
			<?php include 'src/navbar.php'; ?>
			<!-- header -->
			<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">AES-128</span></h1></div>
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
							<input type="text" id="oascii" required="required" name="snum"  minlength="16" maxlength="16" aria-describedby="snumHelpBlock"  class="form-control">
							<span id="snumHelpBlock" class="form-text text-muted">16 bajtów</span>
							</div>
							<div id="IV" class="form-group">
							<!-- Wektor inicjujący w postaci tekstu jawnego -->
								<div id="pl" style='display:none'> 
									<label for="IV">Wektor inicjujący:</label> 
									<input type="text"  name="IVp" id="IVp" minlength="16" maxlength="16" aria-describedby="IVHelpBlock" class="form-control"> 
									<span id="IVHelpBlock" class="form-text text-muted">IV w postaci tekstu jawnego</span> 
								</div>
								<!-- Wektor inicjujący w postaci hex -->
								<div id="hex" style='display:none'> 
									<label for="IV">Wektor inicjujący:</label> 
									<input type="text"   name="IVh" id="IVh" minlength="32" maxlength="32" aria-describedby="IVHelpBlock" class="form-control"> 
									<span id="IVHelpBlock" class="form-text text-muted">IV w postaci szesnastkowej</span> 
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
										<label for="radio1" class="custom-control-label">Szesnastkowy</label>
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
							<button name="add" type="submit" class="btn btn-primary btn-md btn-block btn-md btn-block">Zaszyfruj</button>
							</div>
			<!-- Walidacja -->
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
				//jezeli hex, zamien $iv na wartosc hex
					else {
						$iv= '';
						$hex = $_POST['IVh'];
						for ($i=0; $i < strlen($hex)-1; $i+=2){
						$iv .= chr(hexdec($hex[$i].$hex[$i+1]));
						}
					}	
			}

			$mode = $_POST['mode'];
				//padding
				$blockSize = 16; //rozmiar bloku
				$len = strlen($message); //$message - Wejściowy tekst jawny
				$paddingLen = intval(($len + $blockSize - 1) / $blockSize) * $blockSize - $len;
				$padding = str_repeat("\0", $paddingLen);
				$data = $message . $padding; // Wyjściowy tekst z dopełnieniem

			if ($mode == 'CBC')
			{
				$encrypted_openssl = openssl_encrypt($data, "AES-128-CBC", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
			}
			else if ($mode == 'ECB')
			{
				$encrypted_openssl = openssl_encrypt($data, "AES-128-ECB", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
			}
			else if ($mode == 'CFB')
			{
				$encrypted_openssl = openssl_encrypt($message, "AES-128-CFB", 
				$key, OPENSSL_RAW_DATA  , $iv);
			}
			else if ($mode == 'OFB')
			{
				$encrypted_openssl = openssl_encrypt($message, "AES-128-OFB", 
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
			<div class="container-fluid h-0">
				<div class="row justify-content-center align-items-center h-0">
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
												<div class="col col-sm-12 ">
													<p><strong>&sdot;</strong>Autorzy: Vincent Rijmen, Joan Daemen</p>
													<p><strong>&sdot;</strong>Rok powstania: 1998</p>
													<hr />
													<h2 style="text-align: center;">Historia</h2>
													<p style="text-align: justify;">W 1997 roku Narodowy Instytut Standaryzacji i Technologii USA (ang. National Institute of Standards and Technology) ze względu na niedostateczne bezpieczeństwo DES ogłosił konkurs, kt&oacute;ry miał na celu wyłonienie &bdquo;nieklasyfikowanego, publicznie ujawnionego algorytmu szyfrowania zdalnego do ochrony wrażliwych informacji rządowych przynajmniej do połowy następnego stulecia&rdquo;. Zwycięzcą konkursu okazał się wynaleziony przez dw&oacute;ch belgijskich kryptograf&oacute;w Rijndael (nazwa pochodzi od nazwisk wynalazc&oacute;w: Rijmena i Daemena). W 2001 szyfr ten został zatwierdzony jako AES (ang. &nbsp;Advanced Encryption Standard) i stał się niejako światowym standardem szyfrowania.</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">AES w wersji 128-bitowej przetwarza 128-bitowe bloki przy użyciu klucza wynoszącego r&oacute;wnież 128-bit&oacute;w. Podczas szyfrowania stosowane są operacje przesuwania, podstawiania i zamiany bit&oacute;w oraz operacje XOR. AES ma zmienną liczbę rund &ndash; jest ona uzależniona od długości klucza i w tej wersji wynosi ona 10.</p>
													<p style="text-align: justify;">AES traktuje poszczeg&oacute;lny blok danych jako dwuwymiarową tablicę bajt&oacute;w 4x4, kt&oacute;ra jest nazywana stanem lub stanem wewnętrznym.</p>
													<p>Pojedyncza runda jest podzielona na 4 etapy:</p>
													<ol>
													<li>KeyExpansion - przygotowanie kluczy rundowych, gdzie generowane są z klucza gł&oacute;wnego podklucze kolejnych rund, a także jeden dodatkowy, kt&oacute;ry jest kluczem początkowym;</li>
													<li>Runda inicjująca:
													<ol>
													<li>AddRoundKey - wykonywana jest operacja XOR na kluczu rundowym i poszczeg&oacute;lnymi bajtami macierzy;</li>
													</ol>
													</li>
													<li>Rundy:
													<ol>
													<li>SubBytes - zamiana bajt&oacute;w, podczas kt&oacute;rej każdy bajt jest zastępowany innym na podstawie zdefiniowanej tabeli, kt&oacute;ra jest nazywana S-Box&rsquo;em Rijnadel&rsquo;a;</li>
													<li>ShiftRows - przesunięcia w wierszach, gdzie bajty w 2, 3 i 4 wierszu są przesuwane o określoną liczbę razy w lewo;</li>
													<li>MixColumns - mieszanie kolumn, gdzie na każdej z czterech kolumn stosowane jest takie samo przekształcenie liniowe;</li>
													<li>AddRoundKey;</li>
													</ol>
													</li>
													<li>Runda kończąca:
													<ol>
													<li>SubBytes;</li>
													<li>ShiftRows;</li>
													<li>AddRoundKey;</li>
													</ol>
													</li>
													</ol>
													<p>Pomimo opublikowania wielu prac naukowych opisujących ataki na niekt&oacute;re implementacje AES, algorytm ten jest wciąż uważany za bezpieczny i efektywny szyfr, gdyż przedstawione instrukcje atak&oacute;w dotyczyły szczeg&oacute;lnych przypadk&oacute;w</p>
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