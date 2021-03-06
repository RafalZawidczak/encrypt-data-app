<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<title>RSA</title>
	</head>
	<body>

			<!-- NAVBAR -->
			<?php include 'src/navbar.php'; ?>
			<?php
				if (isset($_POST['add'])){
				
					$digestAlg = 'sha512';
					$keyBits = $_POST["keyBits"];
					settype($keyBits, "int");
					settype($digestAlg, "string");
					$config = array(
						"config" => "C:/xampp/php/extras/openssl/openssl.cnf",
						"digest_alg" => "sha512",
						"private_key_bits" => $keyBits,
						"private_key_type" => OPENSSL_KEYTYPE_RSA,
					);
					// Tworzenie prywatnego i publicznego klucza
					$res = openssl_pkey_new($config);
					// Wypakowanie prywatnego klucza do $privKey
					openssl_pkey_export($res, $privKey, NULL, $config);
					// Wypakowanie publicznego klucza do $pubKey
					$pubKey = openssl_pkey_get_details($res);
					$pubKey = $pubKey["key"];
				}
				 if (isset($_POST["crypt"])){
					$data = $_POST["fnum"];
					$pubKey = $_POST["snum"];
					// Zaszyfrowanie tekstu do $encrypted
					openssl_public_encrypt($data, $encrypted, $pubKey);
				}
				if (isset($_POST["decrypt"])){
					$encrypted = base64_decode($_POST['Dfnum']);
					$privKey = $_POST['Dsnum'];
					// Deszyfrowanie do $decrypted
					openssl_private_decrypt($encrypted, $decrypted, $privKey);
				}
		
			?>
			<!-- header -->
			<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">RSA</span></h1></div>
			<!-- Collapse + formularze -->
			 <div class="container-fluid">
				<div class="row justify-content-center align-items-center ">
					<div class="col col-sm-9 ">
						<div id="accordion">
							<div class="card">
								<div class="card-header" id="headingOne">
								  <h5 class="mb-0">
									 <a data-toggle="collapse" href="#collapseone">Generowanie par kluczy</a>
								  </h5>
								</div>

								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								  <div class="card-body">
									<div class="container-fluid h-100">
										<div class="row justify-content-center align-items-center h-100">
									<div class="col col-sm-11 ">
										<form method="POST">
												Liczba bit??w: <select name="keyBits">
													<option value="4096">4096</option>
													<option value="2048">2048</option>
													<option value="1024">1024</option>
													<option value="512">512</option>
												</select>
											<div class="block">
												<p>Klucz prywatny</p>
												<textarea readonly name="pphPText" class="form-control" rows="3"><?php if (isset($_POST['add'])) { echo $privKey; } ?></textarea>
											</div>
											<div class="block">
												<p>Klucz publiczny</p>
												<textarea readonly name="pphHText" class="form-control" rows="3" cols="1"><?php if (isset($_POST['add'])) { echo $pubKey; } ?></textarea>
											</div>
											<button type="submit"  name="add" class="btn btn-primary btn-md btn-block">Wygeneruj par?? kluczy</button>
										</form>
									</div>
										</div>
									</div>
								  </div>
								</div>
						  </div>
			  <div class="card">
				<div class="card-header" id="headingTwo">
				  <h5 class="mb-0">
					 <a data-toggle="collapse" href="#collapseTwo">Szyfrowanie</a>
				  </h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
				  <div class="card-body">
					<div class="container-fluid h-100">
						<div class="row justify-content-center align-items-center h-100">
							<div class="col col-sm-11 ">
								<form method="POST">
									<div class="block">
										<p>Tekst jawny: </p>
										<textarea required name="fnum" class="form-control"><?php if (isset($_POST['crypt'])) {echo htmlspecialchars($_POST['fnum']); } ?> </textarea>
									</div>
									<div class="block">
										<p>Klucz Publiczny: </p>
										<textarea required name="snum" class="form-control"><?php if (isset($_POST['add'])) { echo $pubKey; } ?></textarea>
									</div>
									<div class="block">
										<p>Tekst zaszyfrowany: </p>
										<textarea readonly name="crypted" class="form-control"><?php if(isset($_POST['crypt'])) {echo chunk_split(bin2hex($encrypted), 2, ' ');} ?> </textarea>
									</div>
									<button type="submit" name="crypt" class="btn btn-primary btn-md btn-block" >Zaszyfruj</button> 
								<?php 
									if (isset($_POST['crypt']) && (trim($encrypted) == ''))
									{
										echo "<script>alert('Niepoprawny klucz publiczny')</script>"; 
									}
								?>
								</form>
							</div>
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
					<a data-toggle="collapse" href="#collapseThree">Deszyfrowanie</a>
					</h5>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
					<div class="card-body">
						<div class="container-fluid h-100">
							<div class="row justify-content-center align-items-center h-100">
								<div class="col col-sm-11 ">
									<form method="POST">
										<div class="block">
											<p>Zaszyfrowany tekst</p>
											<textarea required name="Dfnum" class="form-control"><?php if (isset($_POST['crypt'])) {echo base64_encode($encrypted); } ?></textarea>
										</div>
										<div class="block">
											<p>Klucz prywatny</p>
											<textarea name="Dsnum" class="form-control"><?php if (isset($_POST['add'])) { echo $privKey; } ?></textarea>
										</div>
										<div class="block">
											<p>Tekst jawny</p>
											<textarea readonly name="decrypted" class="form-control"><?php if (isset($_POST['decrypt'])) {echo $decrypted; }?></textarea>
										</div>
										<button type="submit" name="decrypt" class="btn btn-primary btn-md btn-block">Odszyfruj</button>
										<?php 
											if (isset($_POST['decrypt']) && (trim($decrypted) == ''))
											{
												echo "<script>alert('Niepoprawny klucz prywatny')</script>"; 
											}
										?>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			  </div>
						<div class="card">
							<div class="card-header" id="headingFour">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapsefour">Opis algorytmu</a>
								</h5>
							</div>
							<div id="collapsefour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid">
											<div class="row justify-content-center align-items-center">
												<div class="col col-sm-11 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autorzy: Ron Rivest, Leonard Adleman, Adi Shamir</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1977</p>
													<hr />
													<h2 style="text-align: center;">Historia</h2>
													<p style="text-align: justify;">Akronim algorytmu RSA pochodzi od nazwisk jego tw&oacute;rc&oacute;w, kt&oacute;rymi byli Ron Rivest, Adi Shamir i Leonard Adleman. RSA po raz pierwszy opublikowano w 1977 roku jako jeden z pierwszych szyfr&oacute;w asymetrycznych, czyli takich gdzie jest wykorzystywana para kluczy.</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">W RSA tekst jawny, podobnie jak w szyfrach blokowych, dzielony jest na bloki, kt&oacute;re s?? pewnymi liczbami ca??kowitymi w zakresie od 0 do <em>n</em>. Wsp&oacute;??cze??nie najcz????ciej stosuje si?? bloki maj??ce rozmiar 1024 bit&oacute;w.</p>
													<p style="text-align: justify;">Matematyczn?? podstaw?? w szyfrowaniu tutaj jest arytmetyka modulo, a tak??e w??a??ciwo??ci liczb pierwszych i liczb wzgl??dnie pierwszych.</p>
													<p style="text-align: justify;">Zasada dzia??ania algorytmu RSA jest nast??puj??ca:</p>
													<p style="text-align: justify;">Dwie dowolne, ale jak najwi??ksze liczby pierwsze <em>p</em> i <em>q</em> s?? wybierane przez u??ytkownika A. W dalszej kolejno??ci obliczany jest iloczyn <em>pq</em>, kt&oacute;ry jest zapisywany jako <em>n</em>. Nast??pnie jest wybierana liczba <em>e</em>, kt&oacute;ra jest wi??ksza od 1, ale mniejsza od warto??ci <em>(p-1)(q-1)</em>. Liczby <em>e</em> i <em>(p-1)(q-1)</em> powinny by?? liczbami wzgl??dnie pierwszymi. Warto???? <em>e</em> wraz z iloczynem <em>n</em> s?? kluczem szyfruj??cym (<em>n</em> stanowi r&oacute;wnie?? d??ugo???? klucza RSA). Szyfrowany komunikat musi by?? sprowadzony do postaci liczbowej. Dla przyk??adu litera Y w kodzie ASCII w postaci dziesi??tnej jest zapisywana jako 89. W tym przypadku tekst jawny &nbsp;<em>J = 89</em>.</p>
													<p style="text-align: justify;">Warto???? szyfrogramu obliczana jest wed??ug wzoru:</p>
													<p style="text-align: justify;"><em>S = J<sup>e </sup>(modulo n )</em></p>
													<p style="text-align: justify;">W ten spos&oacute;b otrzymywany jest zaszyfrowany blok tekstu jawnego.</p>
													<p style="text-align: justify;">Przy procesie deszyfrowania konieczne jest uruchomienie &bdquo;zapadki&rdquo;, kt&oacute;r?? jest tajny klucz deszyfruj??cy. Aby go wyznaczy??, konieczne jest wpierw obliczenie <em>k</em>.</p>
													<p style="text-align: justify;"><em>ke = 1modulo(p-1)(q-1)</em></p>
													<p style="text-align: justify;">Para liczb <em>k</em> i <em>n</em> pe??ni teraz rol?? klucza deszyfruj??cego. Do odtajnienia szyfrogramu u??ywa si?? nast??puj??cego wzoru:</p>
													<p style="text-align: justify;"><em>J = S<sup>k</sup> (modulo n)</em></p>
													<p style="text-align: justify;">W ten spos&oacute;b otrzymany jest tekst jawny komunikatu.</p>
													<p style="text-align: justify;">Niezmiernie wa??ne jest, aby ukry?? liczby <em>p </em>i <em>q</em>, gdy?? dzi??ki ich znajomo??ci w nietrudny spos&oacute;b mo??na wyznaczy?? klucz s??u????cy do deszyfrowania. Sposobem na uzyskanie tego klucza jest roz??o??enie <em>n</em> na czynniki pierwsze. Z pozoru mo??e to si?? wydawa?? nietrudne, ale w praktyce jest to niemal??e niemo??liwe. Wsp&oacute;??cze??nie wybiera si?? na tyle du??e liczby <em>p </em>i <em>q</em>, aby roz??o??enie iloczynu <em>n</em> na czynniki pierwsze by??o niewykonalne w rozs??dnym czasie.</p>
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
		<script>
		$(document).ready(function () {
			$('a').click(function() {
				//przechowuje ID collapsa
				localStorage.setItem('collapseItem', $(this).attr('href'));
			});

			var collapseItem = localStorage.getItem('collapseItem'); 
			if (collapseItem) {
			   $(collapseItem).collapse('show')
			}
		})</script>
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</body>
</html>


