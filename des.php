<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<title>DES</title>
	</head>
		<body>
			<!-- NAVBAR -->
			<?php include 'src/navbar.php'; ?>
			<!-- header -->
			<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">DES</span></h1></div>
			<!-- formularz -->
			<div class="container-fluid">
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
							<input type="text" id="oascii" required="required" name="snum"  minlength="1" maxlength="8" aria-describedby="snumHelpBlock"  class="form-control">
							<span id="snumHelpBlock" class="form-text text-muted">1 do 8 bajtów</span>
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
				}  //jezeli hex, zamien $iv na wartosc hex
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
			//pading
			if (strlen($message_padded) % 8) 
			{
				$message_padded = str_pad($message_padded,
				strlen($message_padded) + 8 - strlen($message_padded) % 8, "\0");
			}

			if ($mode == 'CBC')
			{
			$encrypted_openssl = openssl_encrypt($message_padded, "DES-CBC", 
				$key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv);
			}
			else if ($mode == 'ECB')
			{
			$encrypted_openssl = openssl_encrypt($message_padded, "DES-ECB", 
				$key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);
			}
			else if ($mode == 'CFB')
			{
			$encrypted_openssl = openssl_encrypt($message, "DES-CFB", 
				$key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv);
			}
			else if ($mode == 'OFB')
			{
			$encrypted_openssl = openssl_encrypt($message1, "DES-OFB", 
				$key1, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv1);
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
			<div class="container-fluid">
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
									<div class="container-fluid">
											<div class="row justify-content-center align-items-center ">
												<div class="col col-sm-11 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autorzy: IBM</p>
														<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1975</p>
														<hr />
														<h2 style="text-align: center;">Historia</h2>
														<p style="text-align: justify;">Algorytm DES (ang. Data Encryption Standard) został stworzony przez firmę IBM na zlecenie &oacute;wczesnego Narodowego Biura Standard&oacute;w USA i opublikowany po raz pierwszy w 1975 roku. Algorytm ten stanowił standard federalny USA od&nbsp; 1976 do 2001 roku, kiedy to został zastąpiony przez Rijnadel, kt&oacute;ry przyjął p&oacute;źniej nazwę AES.</p>
														<hr />
														<h2 style="text-align: center;">Opis</h2>
														<p style="text-align: justify;">Algorytm DES jest szyfrem blokowym, kt&oacute;ry korzysta z blok&oacute;w o rozmiarze 64 bit&oacute;w, zaś klucz ma długość 56 bit&oacute;w, ale zapisywany jest jako 64-bitowy, gdyż co 8 bit jest kontrolny.</p>
														<p style="text-align: justify;">W celu zaszyfrowania, tekst jawny jest dzielony na 64-bitowe bloki. Następnie każdy z blok&oacute;w jest poddawany następującym operacjom:</p>
														<p style="text-align: justify;">1. Permutacja początkowa dokonywana na podstawie z g&oacute;ry zdefiniowanej macierzy przestawień.</p>
														<p style="text-align: justify;">2. Podzielenie bloku a dwie 32-bitowe części: lewą i prawą.</p>
														<p style="text-align: justify;">3. Wykonywanych jest 16 cykli pewnych, z g&oacute;ry zdefiniowanych operacji, kt&oacute;re mają za zadanie mieszanie danych wejściowych z kluczem.</p>
														<p style="text-align: justify;">4. Po wykonaniu wszytskich cykli, lewa i prawa część bloku jest łączona w jedną całość za pomocą operacji XOR.</p>
														<p style="text-align: justify;">5. Nastepuje permutacja końcowa bloku w oparciu o zg&oacute;ry zdefiniowaną macierz.</p>
														<p style="text-align: justify;">&nbsp;</p>
														<p style="text-align: justify;">Przyjęcie DES miało wielu przeciwnik&oacute;w ze względu na rozmiar klucza, kt&oacute;ry sprawia, że szyfr jest podatny na atak siłowy. Istnieją r&oacute;wnież inne rodzaje atak&oacute;w, na kt&oacute;re DES może być podatny, ale są one niepraktyczne.</p>
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