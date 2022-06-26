<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<title>Camellia-192</title>
	</head>
		<body>
			<!-- NAVBAR -->
			<?php include 'src/navbar.php'; ?>
			<!-- header -->
			<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">Camellia-192</span></h1></div>
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
							<input type="text" id="oascii" required="required" name="snum"  minlength="24" maxlength="24" aria-describedby="snumHelpBlock"  class="form-control">
							<span id="snumHelpBlock" class="form-text text-muted">24 bajty</span>
							</div>
							<div id="IV" class="form-group">
							<!-- Wektor inicjujący w postaci tekstu jawnego -->
								<div id="pl" style='display:none'> 
									<label for="IV">Wektor inicjujący:</label> 
									<input type="text"   name="IVp" id="IVp" minlength="16" maxlength="16" aria-describedby="IVHelpBlock" class="form-control"> 
									<span id="IVHelpBlock" class="form-text text-muted">IV w postaci tekstu jawnego</span> 
								</div>
								<!-- Wektor inicjujący w postaci hex -->
								<div id="hex" style='display:none'> 
									<label for="IV">Wektor inicjujący:</label> 
									<input type="text"   name="IVh" id="IVh" minlength="32" maxlength="32" aria-describedby="IVHelpBlock" class="form-control"> 
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
				//jezeli hex, zamien $iv na wartosc hex
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
				 $blockSize = 16;
				$len = strlen($message);
				$paddingLen = intval(($len + $blockSize - 1) / $blockSize) * $blockSize - $len;
				$padding = str_repeat("\0", $paddingLen);
				$data = $message . $padding;
			if ($mode == 'CBC')
			{
			$encrypted_openssl = openssl_encrypt($data, "CAMELLIA-192-CBC", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
			}
			else if ($mode == 'ECB')
			{
			$encrypted_openssl = openssl_encrypt($data, "CAMELLIA-192-ECB", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
			}
			else if ($mode == 'CFB')
			{
			$encrypted_openssl = openssl_encrypt($message, "CAMELLIA-192-CFB", 
				$key, OPENSSL_RAW_DATA  , $iv);
			}
			else if ($mode == 'OFB')
			{
			$encrypted_openssl = openssl_encrypt($message, "CAMELLIA-192-OFB", 
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
				<div class="row justify-content-center align-items-center ">
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
													<p style="text-align: justify;"><strong>&sdot;</strong>Autorzy: Mitshubishi i NTT</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 2000</p>
													<hr />
													<h2 style="text-align: center;">Historia</h2>
													<p style="text-align: justify;">Algorytm Camellia jest szyfrem blokowym opracowanym w Japonii w 2000 roku dla efektywnego działania w rozwiązaniach sprzętowych i programistycznych. Algorytm ten jest używany w r&oacute;żnych sytuacjach, np. w kartach elektronicznych czy też protokołach sieciowych(TLS).</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Camellia w wersji 192-bitowej pracuje na kluczu o długości 192 bit&oacute;w. Wielkość bloku tekstu jawnego i szyfrogramu wynosi&nbsp; 128 bit&oacute;w.</p>
													<p style="text-align: justify;">Podczas szyfrowania wykorzystywane są funkcje F, kt&oacute;re pobierają 128 bitowe bloki tekstu jawnego, kt&oacute;re następnie mieszane są z bitami podklucza k<sub>i</sub> i zwracane jest 128 nowych bit&oacute;w. Przekształcenie bit&oacute;w w&nbsp;funkcji F nazywane jest rundą algorytmu. Wywołania funkcji&nbsp;F zebrane są w&nbsp;bloki zawierające sześć kolejnych powt&oacute;rzeń takich rund.</p>
													<p style="text-align: justify;">Bloki sześciu rund (czyli sześciu wywołań funkcji&nbsp;F) oddzielone są wywołaniami funkcji&nbsp;FL oraz&nbsp;FL<sup>-1</sup>. Manipulują one 64-bitowymi partiami danych, mieszając je z podkluczami&nbsp;kl<sub>i</sub>.</p>
													<p style="text-align: justify;">W wersji 192-bitowej wykonywane są 4 powt&oacute;rzenia blok&oacute;w sześciu rund.</p>
													<p style="text-align: justify;">W celu stworzenia podkluczy, w pierwszej kolejności tworzy się zmienne K<sub>L</sub> i K<sub>R</sub> o długości 128 bit&oacute;w i zmienne <span class="typed_in_text">K<sub>LL</sub></span>, <span class="typed_in_text">K<sub>LR</sub></span>, <span class="typed_in_text">K<sub>RL</sub></span> oraz <span class="typed_in_text">K<sub>RR</sub></span> o długości 64 bit&oacute;w. Na&nbsp;podstawie tych zmiennych generuje się dwie kolejne zmienne pomocnicze: <span class="typed_in_text">K<sub>A</sub></span> oraz&nbsp;<span class="typed_in_text">K<sub>B</sub></span>. Każda z&nbsp;nich składa się ze 128&nbsp;bit&oacute;w. W&nbsp;procesie tworzenia zmiennych <span class="typed_in_text">K<sub>A</sub></span> i&nbsp;<span class="typed_in_text">K<sub>B</sub></span> wykorzystuje się sześć pomocniczych stałych oznaczanych jako&nbsp;&sum;<sub>i</sub>.</p>
													<p style="text-align: justify;">Na podstawie czterech 128-bitowych zmiennych <span class="typed_in_text">K<sub>L</sub></span>, <span class="typed_in_text">K<sub>R</sub></span>, <span class="typed_in_text">K<sub>A</sub></span> i&nbsp;<span class="typed_in_text">K<sub>B</sub></span> wyliczane są wszystkie sekretne 64-bitowe podklucze: <span class="typed_in_text">k<sub>i</sub></span>, <span class="typed_in_text">kw<sub>i</sub></span> oraz <span class="typed_in_text">kl<sub>i</sub></span>.</p>
													<p style="text-align: justify;">Camellia jest uznawana za nowoczesny i bezpieczny szyfr. Do tej pory nie są znane skuteczne ataki, na kt&oacute;re algorytm jest podatny. Algorytm jest zaakceptowany przez wiele organizacji.</p>		
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