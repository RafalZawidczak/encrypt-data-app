		//Jeżeli zaznaczony tryb CBC lub CFB lub OFB, pokaż diva z wektorem inicjacyjnym

		$('input[name="mode"]').click(function(e) {
		  if(e.target.value === 'CBC' || e.target.value === 'CFB' || e.target.value === 'OFB') {
			$('#IV').show();
			$('#IVV').show();
			
		  } else {
			$('#IV').hide();
			$('#IVV').hide();
			
		  }
		})
		
		//Jeżeli format zaznaczony jako Plaintext, pokazuje inputa dla plaintext
		//w przeciwnym razie, pokazuje inputa dla formatu hex
		$('input[name="format"]').click(function(e) {
		  if(document.getElementById('radio0').checked){
			$('#pl').show()
			$('#hex').hide();
		  } else {
			$('#pl').hide();
			$('#hex').show();
		  }
		})

		//Tylko znaki ASCII z klawiatury w polu z kluczem
		$(document).ready(function(){
			$("#oascii").keypress(function(event){
				var inputValue = event.charCode;
				if(!(inputValue >= 32 && inputValue <= 126) && (inputValue != 32 && inputValue != 0)){
					event.preventDefault();
					alert("0-9, a-z or A-Z");
				}
			});
		});
		//tylko znaki ASCII z klawiatury w polu dla IV z plaintext
		$(document).ready(function(){
			$("#IVp").keypress(function(event){
				var inputValue = event.charCode;
				if(!(inputValue >= 32 && inputValue <= 126) && (inputValue != 32 && inputValue != 0)){
					event.preventDefault();
					alert("0-9, a-z or A-Z");
				}
			});
		});
		 // Tylko znaki hex
		$('#IVh').keypress(function (e) {
			var regex = new RegExp("^[a-fA-F0-9]+$");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}
			e.preventDefault();
			alert("Dozwolone są tylko znaki w formie szesnastkowej");
			return false;
		}); 