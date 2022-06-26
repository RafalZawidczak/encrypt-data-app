<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
	</head>
		<body>
			<?php include 'src/navbar.php'; ?>
				<!-- header -->
				<div class="header" align="center"><h1><span style="font-family: &quot;Comic Sans MS&quot;;">RC4 (ARCFOUR)</span></h1></div>
				<!-- formularz -->
					<div class="container-fluid ">
						<div class="row justify-content-center align-items-center ">
							<div class="col col-sm-6 ">
								<form method="POST">
								  <div class="form-group">
										<label for="fnum">Tekst jawny:</label> 
										<textarea id="fnum" name="fnum"  required="required" class="form-control"></textarea> 
								  </div>
								  <div class="form-group">
									<label for="snum" >Klucz:</label> 
									<input type="text" id="oascii" required="required" name="snum"  minlength="5" maxlength="256" aria-describedby="snumHelpBlock"  class="form-control">
									<span id="snumHelpBlock" class="form-text text-muted">5 do 256 bajtów</span>
								  </div>
									<button name="add" type="submit" class="btn btn-primary btn-md btn-block">Zaszyfruj</button>
									<!-- 
										*Dozwolone tylko wybrane znaki ASCII w polu z kluczem
									-->
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
							<script
								$('#optional').hide();
								$(document).ready(function(){
									$("#oascii").keypress(function(event){
										var inputValue = event.charCode;
										if(!(inputValue >= 32 && inputValue <= 126) && (inputValue != 32 && inputValue != 0)){
											event.preventDefault();
											alert("0-9, a-z or A-Z");
										}
									});
								});
							</script>
							<?php	
								include('src/arcfour.php');	
								if(isset($_POST['add']))
								{
									$string=$_POST['fnum'];		
									$key=$_POST['snum'];				
									$crypt  = RC4::encrypt($key, $string);
									$hex = RC4::ascii2hex($crypt);
								}
							?>
									<div class="form-group">
											<label for="ciphed">Tekst zaszyfrowany</label> 
											<textarea id="ciphed" name="ciphed"  readonly class="form-control"><?php if(isset($_POST['add'])) {echo chunk_split(bin2hex($hex), 2, ' ');} ?> </textarea> 
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
											<p style="text-align: justify;"><strong>&sdot;</strong>Autorzy: Ron Rivest</p>
											<p style="text-align: justify;"><strong>&sdot;</strong>Rok powstania: 1987</p>
											<hr />
											<h2 style="text-align: center;">Historia</h2>
											<p style="text-align: justify;">Alforytm RC4 został opracowany przez Rona Rivesta w 1987 roku. Działanie szyfru było tajne aż do 1994 roku, kiedy to zasada działania została anonimowo ujawniona w sieci. Nazwa RC4 jest opatentowana, jednak implementacje samego algorytmu bez licencji są legalne, dlatego też często stosuje się dla niego nazwę ARCFOUR, bądź też ARC4 w celu uniknięcie problem&oacute;w prawnych. Szyfr jest znany z zastosowania w wielu aplikacjach, jak np. Microsoft Office[9] i Skype, a także w pierwszym standardzie szyfrowania Wi-Fi &ndash; WEP oraz w protokole stosowanego do nawiązywania połączeń HTTPS &ndash; TLS[8]. Obecnie już ze względu na niewystarczające bezpieczeństwo, algorytm RC4 nie jest wykorzystywany w WEP, TLS, a także zostało wyłączone wsparcie w przeglądarkach takich firm, jak Google, Microsoft, czy też Mozilla.</p>
											<hr />
											<h2 style="text-align: center;">Opis</h2>
											<p style="text-align: justify;">W algorytmie RC4 stosowana jest arytmetyka modulo. Jest to operacja, kt&oacute;ra ma na celu wyznaczenie reszty z dzielenia jednego typu liczbowego przez drugi. Działanie <em>a </em>mod <em>r</em> oblicza resztę z dzielenia <em>a</em> przez <em>r</em>. Dla przykładu 27 mod 24 = 3, gdyż resztą z dzielenia 27 przez 24 jest 3.</p>
											<p style="text-align: justify;">Pierwszym etapem w szyfrowaniu za pomocą RC4 jest stworzenie klucza i zapisanie go w postaci binarnej. Dla przykładu słowo &bdquo;KEY&rdquo; w tej postaci to: <em>01001011 01000101 01011001</em>.</p>
											<p style="text-align: justify;">Następnie tworzona jest 256-elementowa tablica S = {0, 1, 2, &hellip; 255}, kt&oacute;ra w kolejnej fazie jest przetwarzana w 256 iteracjach. Elementy S są jednocześnie mieszane z bajtami klucza[10]:</p>
											<p style="text-align: center;">od i=0 do i=255:</p>
											<p style="text-align: center;">j = ( j + S<sub>i</sub> + klucz[i MOD długość klucza] ) MOD 256</p>
											<p style="text-align: center;">Zamiana wartości S<sub>i </sub>&nbsp;z S<sub>j</sub></p>
											<p style="text-align: justify;"><em>Gdzie j to poprzednia wartość (w pierwszej iteracji jest to 0), S<sub>i </sub>jest to aktualna wartość w tablicy S.</em></p>
											<p style="text-align: justify;">Następnym krokiem jest zastosowanie algorytmu pseudolosowej generacji, kt&oacute;ry modyfikuje tablicę S i generuje bajt strumienia szyfrującego tyle razy, ile wynosi długość tekstu jawnego[10]:</p>
											<p style="text-align: center;">i=0;&nbsp; j=0</p>
											<p style="text-align: center;">k=1 do długości tekstu jawnego</p>
											<p style="text-align: center;">i = (i + 1) MOD 256</p>
											<p style="text-align: center;">j = (j + S<sub>i</sub>) MOD 256</p>
											<p style="text-align: center;">Zamiana wartości S<sub>i </sub>&nbsp;z S<sub>j</sub></p>
											<p style="text-align: center;">w = (S<sub>i </sub>+ S<sub>j </sub>) MOD 256</p>
											<p style="text-align: justify;">W każdej iteracji i = (i + 1) MOD 256,&nbsp; czyli w pierwszej iteracji i będzie miało wartość 1. Algorytm do j dodaje wartość z poprzedniej tablicy S wskazaną przez i, następnie zamienia wartości S<sub>i </sub>&nbsp;z S<sub>j</sub>. Jako wynik otrzymywana jest wartość z S wskazana przez (S<sub>i </sub>+ S<sub>j</sub>) MOD 256[10].</p>
											<p style="text-align: justify;">Otrzymane kolejne bajty są poddawane operacji XOR z kolejnymi bajtami wiadomości, otrzymując w ten spos&oacute;b zaszyfrowany tekst, kt&oacute;ry po sprowadzeniu do postaci kod&oacute;w ASCII daje niezrozumiały dla człowieka ciąg znak&oacute;w.</p>
											<p style="text-align: justify;">Niestety w ciągu ostatnich kilkunastu lat zostały wykazane słabości RC4. W 2001 roku Fluher, Mantin i Shamir[15] dokonali odkrycia, że rozkład statystyczny kilku pierwszych bajt&oacute;w w strumieniu szyfrującym wykazuje właściwości silnie nielosowe. Kiedy zostanie poddana analizie duża liczba wiadomości, kt&oacute;re są zaszyfrowanie przy pomocy tego samego klucza, możliwe jest jego uzyskanie. Pozwalało to na złamanie standardu szyfrowania WEP, co wymusiło przyspieszenie prac nad następcą tego standardu &ndash; standardem WPA.</p>
											<p style="text-align: justify;">Na początku 2015 roku zakazano używania RC4 w TLS, zaś w 2016 roku Mozilla, Microsoft i Google wyłączyło dla niego wsparcie w swoich przeglądarkach. Używanie go do zaszyfrowania plik&oacute;w pakietu Office jest niezalecane.</p>		
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