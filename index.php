<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="src/style.css">
		<meta charset="UTF-8">
	</head>
		<body>
			<!-- NAVBAR -->
			<?php include 'src/navbar.php'; ?>
			<!-- COLLAPSE -->
			<div id="accordion" role="tablist" aria-multiselectable="true">
			<div class="row" style="margin-top: 3%">
					<div class="col-sm-3"></div>
				  <div class="col-sm-6">
					<div class="card">
						<h5 class="card-header" role="tab" id="headingOne">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="d-block">
							<i class="fa fa-chevron-down pull-right"></i> Szyfrowanie symetryczne
							</a>
						</h5>
		
						<div id="collapseOne" class="collapse " role="tabpanel" aria-labelledby="headingOne">
							<div class="card-body">
									<a class="btn btn-outline-primary btn-sm btn-block" href="AES128.php">AES128</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="AES192.php">AES192</a>
									<a class="btn btn-outline-primary btn-sm btn-block" href="AES256.php">AES256</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="Blowfish.php">Blowfish</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="CAMELLIA128.php">CAMELLIA128</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="CAMELLIA192.php">CAMELLIA192</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="CAMELLIA256.php">CAMELLIA256</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="DES.php">DES</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="IDEA.php">IDEA</a> 
									<a class="btn btn-outline-primary btn-sm btn-block" href="rc4.php">RC4 (ARCFOUR)</a> 
							</div>
						</div>
					</div>
				  </div>
			</div>
			<div class="row" ">
				<div class="col-sm-3"></div>
			    <div class="col-sm-6">
					<div class="card">
						<h5 class="card-header" role="tab" id="headingTwo">
							<a class="collapsed d-block" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<i class="fa fa-chevron-down pull-right"></i> Szyfrowanie asymetryczne
							</a>
						</h5>
						<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="card-body">
							<a class="btn btn-outline-primary btn-sm btn-block" href="RSA.php">RSA</a> 
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" >
					<div class="col-sm-3"></div>
				    <div class="col-sm-6">
						<div class="card">
							<h5 class="card-header" role="tab" id="headingThree">
								<a class="collapsed d-block" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								<i class="fa fa-chevron-down pull-right"></i> Funkcje skrótu
								</a>
							</h5>
							<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
								<div class="card-body">
								<a class="btn btn-outline-primary btn-sm btn-block" href="hash.php">Przejdź do funkcji skrótu</a> 
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