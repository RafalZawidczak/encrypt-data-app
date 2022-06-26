<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<title>Funkcje skrótu</title>
	</head>
		<body>
			<!-- NAVBAR -->
			<?php include 'src/navbar.php'; ?>
			<!-- header -->
			<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">Funkcje skrótu</span></h1></div>
		<?php
			if (isset($_POST["add"])){
			$fnum = $_POST["fnum"];
			$hAlg = $_POST["hAlg"];
			$hashed = hash($hAlg, $fnum);
			}
		?>
			<!-- Formularz -->
				<div class="container-fluid ">
					<div class="row justify-content-center align-items-center ">
						<div class="col col-sm-6 ">
							<form method="POST">
								<div class="form-group">
									 <label for="hAlg">Wybierz algorytm haszujący:</label> 
									<select class="form-inline form-control fix-fc" name="hAlg">
										<option value="md2">MD2</option>
										<option value="md4">MD4</option>
										<option value="md5">MD5</option>
										<option value="sha1">SHA1</option>
										<option value="sha224">SHA224</option>
										<option value="sha256">SHA256</option>
										<option value="sha384">SHA384</option>
										<option value="sha512">SHA512</option>
										<option value="ripemd128">RIPEMD128</option>
										<option value="ripemd160">RIPEMD160</option>
										<option value="ripemd256">RIPEMD256</option>
										<option value="ripemd320">RIPEMD320</option>
										<option value="whirlpool">Whirlpool</option>
										<option value="haval128,3">HAVAL128 z 3 rundami</option>
										<option value="haval160,3">HAVAL160 z 3 rundami</option>
										<option value="haval192,3">HAVAL192 z 3 rundami</option>
										<option value="haval224,3">HAVAL224 z 3 rundami</option>
										<option value="haval256,3">HAVAL256 z 3 rundami</option>
										<option value="haval128,4">HAVAL128 z 4 rundami</option>
										<option value="haval160,4">HAVAL160 z 4 rundami</option>
										<option value="haval192,4">HAVAL192 z 4 rundami</option>
										<option value="haval224,4">HAVAL224 z 4 rundami</option>
										<option value="haval256,4">HAVAL256 z 4 rundami</option>
										<option value="haval128,5">HAVAL128 z 5 rundami</option>
										<option value="haval160,5">HAVAL160 z 5 rundami</option>
										<option value="haval192,5">HAVAL192 z 5 rundami</option>
										<option value="haval224,5">HAVAL224 z 5 rundami</option>
										<option value="haval256,5">HAVAL256 z 5 rundami</option>
									</select>
								</div>
							<div class="form-group">
								<p>Tekst jawny</p>
								<textarea required name="fnum" class="form-control" rows="3"><?php if (isset($fnum)) { echo htmlspecialchars($fnum); } ?></textarea>
							</div>
							<div class="form-group">
								<p>Skrót wiadomości</p>
								<textarea readonly name="hashed" class="form-control res" rows="3" cols="1"><?php if(isset($hashed)) {echo chunk_split(($hashed), 2, ' ');} ?></textarea>
							</div>
							<button type="submit" name='add' value="Wykonaj" class="btn btn-primary btn-md btn-block">Wykonaj skrót wiadomości</button>
						</div>
					</div>
			    </div> 
						</form>
									<div class="container-fluid h-0">
				<div class="row justify-content-center align-items-center h-0">
					<div class="col col-sm-6 ">
						<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapseone">MD2</a>
								</h5>
							</div>
							<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
												<p style="text-align: justify;"><strong>&sdot;</strong>Autor: Ron Rivest</p>
												<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1989</p>
												<hr />
												<h2 style="text-align: center;">Historia</h2>
												<p style="text-align: justify;">Funkcja skr&oacute;tu stworzona przez Rona Rivesta i po raz pierwszy opublikowana w 1989 roku. MD2 zostało zoptymalizowane pod kątem komputer&oacute;w 8-bitowych.</p>
												<p style="text-align: justify;">Obecnie funkcja skr&oacute;tu nie jest uważana za bezpieczną i jej używanie jest wysoce niezalecane</p>
												<hr />
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapsetwo">MD4</a>
								</h5>
							</div>
							<div id="collapseTwo" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autor: Ron Rivest</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1990</p>
													<hr />
													<h2 style="text-align: center;">Historia</h2>
													<p style="text-align: justify;">MD4 jest jednokierunkową funkcją skr&oacute;tu zaprojektowaną przez Rona Rivesta i po raz pierwszy opublikowaną w 1990 roku.. Skr&oacute;t MD pochodzi od angielskiego określenia Message Digest oznaczającego skr&oacute;t wiadomości. </p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Algorytm ten, dla danej wiadomości, wytwarza skr&oacute;t wiadomości o długości 128 bit&oacute;w. Po tym jak algorytm został po raz pierwszy zaprezentowany, Bert den Boer i Antoon Bosselaers przeprowadzili skutecznąkryptoanalizę dw&oacute;ch z trzech cykli tego algorytmu. W p&oacute;źniejszym czasie zostały obnażane kolejne słabości tej funkcji skr&oacute;tu, przez co Ron Rivest zdecydował się na wprowadzenie MD5.</p>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingThree">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapsethree">MD5</a>
								</h5>
							</div>
							<div id="collapseThree" class="collapse " aria-labelledby="headingThree" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autor: Ron Rivest</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1991</p>
													<hr />
													<h2 style="text-align: center;">Historia</h2>
													<p style="text-align: justify;">Jednym z niegdyś najpopularniejszych algorytm&oacute;w jednokierunkowej funkcji skr&oacute;tu jest zaprezentowany w 1991 roku MD5 autorstwa Rona Rivesta jako następca MD4 po sugestiach o słabości poprzedniego algorytmu.</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Wejściem w MD5 jest komunikat o dowolnej długości, a wyjściem 128-bitowy skr&oacute;t. Dane przetwarzane są w blokach o długości 512 bit&oacute;w.</p>
													<p style="text-align: justify;">Zasada działania algorytmu MD5 jest następująca:</p>
													<ol>
													<li style="text-align: justify;">Komunikat uzupełniany jest bitami tak, aby była kr&oacute;tsza o 64 bity od wielokrotności 512 bit&oacute;w. Uzupełnienie rozpoczyna jedynka, po kt&oacute;rej są same zera.</li>
													<li style="text-align: justify;">Dołączane są 64 bity, kt&oacute;re reprezentują pierwotną długość komunikatu. W przypadku, gdy jest ona większa od 2<sup>64</sup>, to liczbę oblicza się z modulo 2<sup>64</sup></li>
													<li style="text-align: justify;">Zapisywany jest stan początkowy, kt&oacute;ry tworzą następujące cztery zmienne:</li>
													</ol>
													<p style="text-align: center;">A = 01234567,</p>
													<p style="text-align: center;">B = 89abcdef,</p>
													<p style="text-align: center;">C = fedcba98,</p>
													<p style="text-align: center;">D = 76543210.</p>
													<ol start="4">
													<li style="text-align: justify;">Uruchamiana jest funkcja zmieniająca stan na każdym bloku. Funkcja składa się z czterech cykli po 16 operacji.</li>
													<li style="text-align: justify;">Po przetworzeniu wszystkich blok&oacute;w zwracany jest stan, kt&oacute;ry jest obliczonym skr&oacute;tem wiadomości.</li>
													</ol>
													<p style="text-align: justify;">Zostało wykazane, że algorytm MD5 nie jest odporny na kolizję. W 2004 roku chińscy naukowcy - Xiaoyun Wang, Dengguo Fen, Xuejia Lai i Hongbo Yu przedstawili spos&oacute;b na łatwe znajdowanie kolizji dwublokowych wiadomości. Można tego dokonać w ciągu około godziny na komputerze PC. W następnych latach dokonywano kolejnych odkryć, kt&oacute;re pozwalają na znalezienie kolizji nawet w ciągu minuty.</p>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingFour">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapsefour">SHA-1</a>
								</h5>
							</div>
							<div id="collapsefour" class="collapse " aria-labelledby="headingfour" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
												<p style="text-align: justify;"><strong>&sdot;</strong>Autor: NSA</p>
												<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1995</p>
												<hr />
												<h2 style="text-align: center;">Historia</h2>
												<p style="text-align: justify;">Kolejnym bardzo popularnym algorytmem jest SHA-1, kt&oacute;ry należy do rodziny algorytm&oacute;w SHA (ang. Secure Hash Algorithm). SHA to standardy zdefiniowane przez NIST (następca National Bureau of Standards).</p>
												<p style="text-align: justify;">SHA-1 został opracowany przez NSA i opublikowany w 1995 roku.</p>
												<p>&nbsp;</p>
												<hr />
												<h2 style="text-align: center;">Opis</h2>
												<p style="text-align: justify;">Zasada działania tego algorytmu jest bardzo zbliżona do tej z MD5. R&oacute;żnicą jest to, że w SHA-1 jest pięć stan&oacute;w (wobec czterech w MD5), kt&oacute;re na początku zapisane są następująco:</p>
												<p style="text-align: justify;">A= 0x67452301,</p>
												<p style="text-align: justify;">B = 0xEFCDAB89,</p>
												<p style="text-align: justify;">C = 0x98BADCFE,</p>
												<p style="text-align: justify;">D = 0x10325476,</p>
												<p style="text-align: justify;">E = 0xC3D2E1F0.</p>
												<p style="text-align: justify;">Inaczej r&oacute;wnież wygląda funkcja zmieniająca stan. SHA-1 produkuje 160-bitowe hashe (MD5&nbsp;128-bitowe).</p>
												<p style="text-align: justify;">Od 2004 roku sukcesywnie obnażano słabości SHA-1 w teorii. W 2017 roku Google wraz z CWI Amsterdam pokazało praktyczny przykład ataku generującego dwa r&oacute;żne pliki pdf, kt&oacute;re dają ten sam skr&oacute;t SHA-1. Z tych powod&oacute;w, decyzją Ministra Cyfryzacji, z dniem 1 lipca 2018 roku zaprzestano w Polsce stosowania SHA-1 w zaawansowanym podpisie elektronicznym i pieczęci na rzecz jego następcy, czyli SHA-2.</p>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingfive">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapsefive">SHA-2</a>
								</h5>
							</div>
							<div id="collapsefive" class="collapse " aria-labelledby="headingfive" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autor: NSA</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 2001</p>
													<hr />
													<h2 style="text-align: center;">Historia</h2>
													<p style="text-align: justify;">Algorytm SHA-2 został, podobnie jak poprzednik, opracowany przez NSA i opublikowany w 2001 roku. Budowa oparta jest r&oacute;wnież na strukturze Merkle'a-Damgarda, lecz w przeciwieństwie do SHA-1, tutaj znajdują się 4 funkcje, kt&oacute;re mogą generować skr&oacute;ty o długości 224, 256, 384 lub 512 bit&oacute;w, dlatego też SHA-2 to tak naprawdę 4 algorytmy: SHA-224, SHA-256, SHA-384 i SHA-512.</p>
													<p>&nbsp;</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Na początku w SHA-224 i SHA-256 komunikat jest dzielony na wielokrotność 512 bit&oacute;w, zaś w SHA-384 i SHA-512 na wielokrotność 1024 bit&oacute;w[6]. W dalszej kolejność są zapisywane stany początkowe, przedstawiono to w poniższej tabeli.</p>
													<table border="1" width="100%">
													<tbody>
													<tr>
													<td style="width: 19.0333px;">&nbsp;</td>
													<td style="width: 86.9167px;">
													<p>SHA-224</p>
													</td>
													<td style="width: 86.9167px;">
													<p>SHA-256</p>
													</td>
													<td style="width: 171.8px;">
													<p>SHA-384</p>
													</td>
													<td style="width: 166.133px;">
													<p>SHA-512</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>A</p>
													</td>
													<td style="width: 86.9167px;">
													<p>c1059ed8</p>
													</td>
													<td style="width: 86.9167px;">
													<p>6a09e667</p>
													</td>
													<td style="width: 171.8px;">
													<p>cbbb9d5dc1059ed8</p>
													</td>
													<td style="width: 166.133px;">
													<p>6a09e667f3bcc908</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>B</p>
													</td>
													<td style="width: 86.9167px;">
													<p>367cd507</p>
													</td>
													<td style="width: 86.9167px;">
													<p>bb67ae85</p>
													</td>
													<td style="width: 171.8px;">
													<p>629a292a367cd507</p>
													</td>
													<td style="width: 166.133px;">
													<p>bb67ae8584caa73b</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>C</p>
													</td>
													<td style="width: 86.9167px;">
													<p>3070dd17</p>
													</td>
													<td style="width: 86.9167px;">
													<p>3c6ef372</p>
													</td>
													<td style="width: 171.8px;">
													<p>9159015a3070dd17</p>
													</td>
													<td style="width: 166.133px;">
													<p>3c6ef372fe94f82b</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>D</p>
													</td>
													<td style="width: 86.9167px;">
													<p>f70e5939</p>
													</td>
													<td style="width: 86.9167px;">
													<p>a54ff53a</p>
													</td>
													<td style="width: 171.8px;">
													<p>152fecd8f70e5939</p>
													</td>
													<td style="width: 166.133px;">
													<p>a54ff53a5f1d36f1</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>E</p>
													</td>
													<td style="width: 86.9167px;">
													<p>ffc00b31</p>
													</td>
													<td style="width: 86.9167px;">
													<p>510e527f</p>
													</td>
													<td style="width: 171.8px;">
													<p>67332667ffc00b31</p>
													</td>
													<td style="width: 166.133px;">
													<p>510e527fade682d1</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>F</p>
													</td>
													<td style="width: 86.9167px;">
													<p>68581511</p>
													</td>
													<td style="width: 86.9167px;">
													<p>9b05688c</p>
													</td>
													<td style="width: 171.8px;">
													<p>8eb44a8768581511</p>
													</td>
													<td style="width: 166.133px;">
													<p>9b05688c2b3e6c1f</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>G</p>
													</td>
													<td style="width: 86.9167px;">
													<p>64f98fa7</p>
													</td>
													<td style="width: 86.9167px;">
													<p>1f83d9ab</p>
													</td>
													<td style="width: 171.8px;">
													<p>db0c2e0d64f98fa7</p>
													</td>
													<td style="width: 166.133px;">
													<p>1f83d9abfb41bd6b</p>
													</td>
													</tr>
													<tr>
													<td style="width: 19.0333px;">
													<p>H</p>
													</td>
													<td style="width: 86.9167px;">
													<p>befa4fa4</p>
													</td>
													<td style="width: 86.9167px;">
													<p>5be0cd19</p>
													</td>
													<td style="width: 171.8px;">
													<p>47b5481dbefa4fa4</p>
													</td>
													<td style="width: 166.133px;">
													<p>5be0cd19137e2179</p>
													</td>
													</tr>
													</tbody>
													</table>
													<p>&nbsp;</p>
													<p style="text-align: justify;">W następnym kroku uruchamiane są funkcje zmieniające stan. Gdy algorytm zakończy wszystkie rundy, wartości stan&oacute;w są łączone, czego wynikiem jest skr&oacute;t. Jako, że skr&oacute;t SHA-224 jest o 32 bity kr&oacute;tszy od tego z SHA-256, wartość H przy ustalaniu ostatecznego skr&oacute;tu jest pomijana. To samo tyczy się SHA-384, kt&oacute;ry daje hash kr&oacute;tszy o 128 bit&oacute;w od SHA-512, a możliwe jest to dzięki pominięciu wartości G i H. Sprawia to, że tak naprawdę SHA-224 to jest to samo, co SHA-256 z innym stanem początkowym i zredukowaną długością hasha[8]. Ta sama zasada odnosi się do pary algorytm&oacute;w SHA-512 i SHA-384.</p>
													<p style="text-align: justify;">&nbsp;Rodzina algorytm&oacute;w SHA-2 do tej pory nie została poddana żadnemu skutecznemu atakowi. Nie istnieje jednak gwarancja, że są one w pełni bezpieczne, mowa jest tutaj o prawdopodobnym bezpieczeństwie</p>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingSix">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapsesix">RIPEMD</a>
								</h5>
							</div>
							<div id="collapseSix" class="collapse " aria-labelledby="headingSix" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autorzy: Hans Dobbertin, Antoon Bosselaers and Bart Preneel</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Pierwsza data publikacji: 1992</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Rodzina funkcji skr&oacute;tu opublikowana w 1992 roku w ramach projektu RIPE (ang. RACE&nbsp; Integrity&nbsp; Primitives&nbsp; Evaluation) Unii Europejskiej. Pierwsza funkcja RIPEMD została stworzona na wz&oacute;r MD4, lecz bardzo szybko znaleziono jej słabe strony. W następnych latach powstały kolejne wersje eliminujące słabości pierwszej. Obecnie istniejące to: RIPEMD RIPEMD-128, RIPEMD-160, RIPEMD-256, RIPEMD-320. Najpopularniejszą wersją jest RIPEMD-160, generująca 160-bitowy skr&oacute;t</p>
													<p style="text-align: justify;">RIPEMD-160 do dnia dzisiejszego nei poddała się żadnemu skutecznemu atakowi kryptoanalityk&oacute;w, lecz trzeba tutaj zaznaczyć, że funkcja ta przez małą popularność jest zdecydowanie mniej zbadana niż rodzina SHA i MD.</p>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingSeven">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapseseven">Whirlpool</a>
								</h5>
							</div>
							<div id="collapseSeven" class="collapse " aria-labelledby="headingSeven" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autor: Vincent Rijmen oraz Paul Barreto</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 2000</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Opublikowana w 2000 roku przez Rijmena i Barreto funkcja haszująca bazująca na strukturze Merkle&rsquo;a-Damgarda. Whirlpool przekształca tekst jawny o długości mniejszej niż 2<sup>256</sup> bit&oacute;w w hasz o długości 512 bit&oacute;w. Funkcja ta jako jedna z dw&oacute;ch (obok SHA-2) została zarekomendowana przez projekt NESSIE (ang. New European Schemes for Signatures, Integrity and Encryption) tworzonego przez Unię Europejską na solidne algorytmy kryptograficzne, kt&oacute;re zapewniają integralność, poufność i autentyczność danych. Funkcja nie jest opatentowana.</p>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingEight">
								<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapseeight">Haval</a>
								</h5>
							</div>
							<div id="collapseEight" class="collapse " aria-labelledby="headingEight" data-parent="#accordion">
								<div class="card-body">
									<div class="container-fluid h-100">
											<div class="row justify-content-center align-items-center h-100">
												<div class="col col-sm-12 ">
													<p style="text-align: justify;"><strong>&sdot;</strong>Autor: Yuliang Zheng, Josef Pieprzyk i Jennifer Seberry</p>
													<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1992</p>
													<hr />
													<h2 style="text-align: center;">Opis</h2>
													<p style="text-align: justify;">Rodzina funkcji skr&oacute;tu opublikowana w 1992 roku. Wynalazcami są Y. Zheng, J. Seberry i Polak, J. Pieprzyk. HAVAL potrafi generować skr&oacute;ty wiadomości o długości 128 bit&oacute;w, 160 bit&oacute;w, 192 bit&oacute;w, 224 bit&oacute;w lub 256 bit&oacute;w. Istnieje też możliwość wyboru liczby rund podczas generowania skr&oacute;tu (3, 4 lub 5). Algorytm już od 2004 roku nie jest uznawany za bezpieczny.</p>
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
