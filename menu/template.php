
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,900" rel="stylesheet">
	<title>PROJETO TELA-LOGIN</title>
	<style>


		body{font-family: 'Raleway', sans-serif;}
		.login--bg{height: 100vh;width: 100vw;position: fixed;left: 0;top: 0;z-index: -1;}
		.login--bg:before{content: '';position: absolute;right: 0;top: 0;width: 50vw;height: 100vh;box-shadow: 0px 0px 30px 0px; 
		 background-color: rgb(237, 136, 1);}



		 /* CLASSES FILIPE */
		 .bg-color{background:orange;color:white;}
		 .color{color: orange;}
		
		
		.container{min-height: 100vh;}
		.d-fx{display: flex;flex-wrap: nowrap;}
		.cadastro_texto_imagem{width: 50vw;}
		.cadastro{width: 50vw; font-size: 15px;}

		.texto{width: 100%; margin-top: 50px; padding-right: 2%; text-align: center;}
		.row-1{font-weight:400;color: #808080;}
		.row-2{font-weight: 400;color: #808080;}
		.row-3{font-weight: 900;color: #686868;}

		.cadastro--imagem{max-width: 350px; width: 100%; height: auto; margin: 50% 0% 0% 15%; }
		
		.word_login_cadastro{font-size:35px; color:#fdba57; margin-top:50px; padding-left:10%;}
		.word_login{margin-right: 5%;}
		.word_cadastro{margin-left: 5%;}
		
	
		
		.formulario_cadastro{width:100%;margin-left: 10%; margin-top: 20%;}
		.input_cadastro{width: 100%; box-sizing: border-box; border:none; border-bottom:1px solid #fdba57; margin-bottom: 10px; background-color: rgb(237, 136, 1); padding: 1%; outline:none;color: white;}

		.input_cadastro::placeholder{color:#fbaa42;}
		::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: #fbaa42;
		}
		::-moz-placeholder { /* Firefox 19+ */
		  color: #fbaa42;
		}
		:-ms-input-placeholder { /* IE 10+ */
		  color: #fbaa42;
		}
		:-moz-placeholder { /* Firefox 18- */
		  color: #fbaa42;
		}

		
		.word_form{color:white;font-size: 17px;}



		/* perguntar pro fi POSITION DO BOTAO - AO INVES DE FAZER COM MARGIN */ 
		.button_form_cadastro{padding: 8px 5% 8px 5%; font-size:17px; background: white; color:rgb(237, 136, 1); border: none; border-radius: 5px; cursor:pointer;  position:absolute; right: 0;}
		
		/* REGULAGEM DO OLHO ERRADA -- PERGUNTAR PRO FI */ 
		.input_password{position: relative;}
		.input_password_olho{position: absolute;right: 0; bottom: 20px;color: white; font-size: 20px; cursor: pointer;}

		.container_input_olho{position: relative;}
		.container_button_acessar{position: relative;}
		

	</style>
</head>
<body>

<div class="login--bg"></div>
	<div class="container d-fx">
		<!--
		 Define o elemento como um h1 mesmo ele nao sendo h1. role="heading" aria-level="1"
		-->

		<div class="cadastro_texto_imagem">
		</div>

		<div class="cadastro">
			<div class="word_login_cadastro">
				<a class="word_login" href="../?logout=1">Sair</a>
			</div>
	 	</div>
	</div>
</body>
</html>