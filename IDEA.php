<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<title>IDEA</title>
	</head>
		<body>
			<!-- NAVBAR -->
       		<?php include 'src/navbar.php'; ?>
			<!-- header -->
			<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">IDEA</span></h1></div>
			<!-- formularz -->
			<div class="container-fluid ">
				<div class="row justify-content-center align-items-center">
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

			//padding
			$blockSize = 8;
			$len = strlen($message);
			$paddingLen = intval(($len + $blockSize - 1) / $blockSize) * $blockSize - $len;
			$padding = str_repeat("\0", $paddingLen);
			$data = $message . $padding;

			if ($mode == 'CBC')
			{
			$encrypted_openssl = openssl_encrypt($data, "IDEA-CBC", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
			}
			else if ($mode == 'ECB')
			{
			$encrypted_openssl = openssl_encrypt($data, "IDEA-ECB", 
				$key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
			}
			else if ($mode == 'CFB')
			{
			$encrypted_openssl = openssl_encrypt($message, "IDEA-CFB", 
				$key, OPENSSL_RAW_DATA , $iv);
			}
			else if ($mode == 'OFB')
			{
			$encrypted_openssl = openssl_encrypt($message, "IDEA-OFB", 
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
														<p style="text-align: justify;"><strong>&sdot;</strong>Autorzy: Xueji Lai i James Massey</p>
														<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1990</p>
														<hr />
														<h2 style="text-align: center;">Historia</h2>
														<p style="text-align: justify;">Algorytm IDEA (ang. Indernational Data Encryption Algorithm) opublikowany został po raz pierwszy w 1990 roku w związku ze starzeniem się DES. Algorytm ten został opatentowany w wielu krajach, a jego opłaty licencyjne w związku z wykorzystaniem komercyjnym były bardzo wysokie, co też spowodowało, że algorytm nie uzyskał wielkiej popularności. Patenty wygasły w latach 2010-2011 i szyfr może być wykorzystywany w dowolnych celach, ale w międzyczasie powstały już inne, zdecydowanie bezpieczniejsze algorytmy.</p>
														<hr />
														<h2 style="text-align: center;">Opis</h2>
														<p>Szyfr operuje na 64-bitowych blokach i kluczach 128-bitowych. Szyfrowanie przebiega w 8 rundach.</p>
														<p>Blok danych wejściowych o długości 64 bit&oacute;w jest dzielony na cztery 16-bitowe podbloki. Algorytm korzysta z 16-bitowych podkluczy, kt&oacute;rych łącznie jest 52. Pierwsze 8 podkluczy jest wydzielone z klucza gł&oacute;wnego, następnie klucz jest przesuwany o 25 bit&oacute;w w lewo i&nbsp; ponownie jest wydzielane 8&nbsp; podkluczy. Operacja jest powtarzana do momentu otrzymania 52 podkluczy.</p>
														<p>W każdej z 8 rund algorytmu wykonywane są 3 typy operacji&nbsp; (XOR, dodawanie modulo 2<sup>16</sup>, a także mnożenie modulo 2<sup>16 </sup>+ 1) na podblokach i podkluczach. Ostatnim etapem jest przekształcenie końcowe, kt&oacute;re wymaga czterech podkluczy[6]. W rezultacie otrzymujemy cztery 16-bitowe podbloki, kt&oacute;re po połączeniu dają blok wyjściowy.</p>
														<p>Cechą wyr&oacute;żniającą IDEA w czasie jego powstania była szybkość działania i bezpieczeństwo, kt&oacute;re przez długi czas było niezachwiane. Obecnie zostało już udowodnione, że algorytm może być podatny na niekt&oacute;re rodzaje atak&oacute;w w szczeg&oacute;lnych przypadkach (np. atak meet-in-the-middle). Zostało także udowodnione, że istnieje pewna pula słabych kluczy, kt&oacute;re osłabiają bezpieczeństwo algorytmu. </p>
														<p style="text-align: justify;">&nbsp;</p>	
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