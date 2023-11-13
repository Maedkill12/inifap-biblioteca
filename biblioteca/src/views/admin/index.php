<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<!--NO MODIFICAR-->
	<title>INIFAP C.E. Zacatecas</title>


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-HXXJYQTXCE"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-HXXJYQTXCE');
	</script>
	<link rel='stylesheet' type='text/css' href='https://framework-gb.cdn.gob.mx/assets/styles/main.css'>
	<?php
	echo "<link rel='stylesheet' type='text/css' href='" . PUBLIC_PATH . "/assets/admin.css'>";
	?>
</head>

<body>
	<main class="page">

		<nav class="navbar navbar-inverse sub-navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subenlaces">
						<span class="sr-only">Interruptor de Navegación</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"></a>
				</div>
				<div class="collapse navbar-collapse" id="subenlaces">
					<ul class="nav navbar-nav navbar-right">
						<li class="landing-btn"><a href="https://www.gob.mx/inifap/archivo/articulos">Blog</a></li>
						<li class="landing-btn"><a href="https://www.gob.mx/inifap/archivo/multimedia">Multimedia</a></li>
						<li class="landing-btn"><a href="https://www.gob.mx/inifap/archivo/prensa">
								Prensa </a>
						</li>
						<li class="landing-btn">
							<a href="https://www.gob.mx/inifap/archivo/agenda">
								Agenda </a>
						</li>
						<li class="landing-btn">
							<a href="https://www.gob.mx/inifap/archivo/acciones_y_programas">
								Acciones y programas </a>
						</li>
						<li class="landing-btn">
							<a href="https://www.gob.mx/inifap/archivo/documentos">
								Documentos </a>
						</li>
						<li class="landing-btn">
							<a href="https://vun.inifap.gob.mx/portalweb/_Transparencia">
								Transparencia </a>
						</li>
						<li class="landing-btn">
							<a href="https://www.gob.mx/agricultura/es/#344">
								Contacto </a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!--NO MODIFICAR-->
		<!--SECCIÓN DINÁMICA PARA DETECCIÓN DE LOCALIZACIÓN A TRAVÉS DE breadcrumb-->
		<div class="container">
			<ol class="breadcrumb top-buffer">
				<li><a href="http://www.gob.mx"><i class="icon icon-home"></i></a></li>
				<li><a href="http://www.gob.mx/inifap">Instituto Nacional de Investigaciones Forestales, Agrícolas y Pecuarias</a></li>
				<li><a href="index.php">Inifap C.E. Zacatecas</a></li>
				<li class="active">Biblioteca Digital</li>
			</ol>
		</div>

		<!-- Lista de articulos para el administrador -->
		<div class="container">
			<div class="cabecera">
				<img src="http://inifap.test/biblioteca/public/images/banner.png" alt="cabecera INIFAP" />
			</div>
			<div class="search">
				<input type="search" id="search" name="search" placeholder="Buscar por libro, autor, año, etc" />
				<button type="sumbit" id="lupe"> <img src="http://inifap.test/biblioteca/public/images/lupita.png" width="32" height="32" /></button>
			</div>
			<div class="subir">
				<button type="sumbit" id="subir">Subir<img src="http://inifap.test/biblioteca/public/images/up.png" width="32" height="32" /></button>
			</div>
			<div class="libros">
				<h2>Artículos disponibles</h2>
				<?php
				$articles = $params['articles'];
				$isScientific = $params['isScientific'];
				?>
				<?php foreach ($articles as $article) : ?>
					<?php
					$publicacion = $article['publicacion'];
					$liga = $article['liga'];
					$muestra = $article['muestra'];
					$cuenta = $article['cuenta'];
					$ano = $article['ano'];
					$mensaje = $article['mensaje'];
					$publicacionot = $isScientific ? $article['publicacionot'] : null;
					$imagen = $article['imagen'];
					$id = $article['id'];
					?>
					<div>
						<div id="product_<?= $id ?>">
							<img src="<?= PUBLIC_PATH . "/publicaciones/" . $imagen ?>" alt="<?= $publicacion ?>" width="167" height="250" />
							<h5><?= $publicacion ?></h5>
							<a href="<?= URL_BASE . "/admin/articulo/" . ($isScientific ? "cientifico/" : "tecnico/") . $id ?>"><img src="<?= PUBLIC_PATH . "/images/edit.png" ?>" width="32" height="32" /></a>
							<a><img src="<?= PUBLIC_PATH . "/images/delete.png" ?>" width="32" height="32" /></a>
						</div>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
	</main>

	<!--<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>-->

	<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

	<script type="text/javascript">
		$gmx(document).ready(function() {

			var consulta;

			//hacemos focus al campo de búsqueda
			$("#busqueda").focus();

			//comprobamos si se pulsa una tecla
			$("#busqueda").keyup(function(e) {

				//obtenemos el texto introducido en el campo de búsqueda
				consulta = $("#busqueda").val();

				//hace la búsqueda

				$.ajax({
					type: "POST",
					url: "buscar.php",
					data: "b=" + consulta,
					dataType: "html",
					beforeSend: function() {
						//imagen de carga
						$("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
					},
					error: function() {
						alert("error petición ajax");
					},
					success: function(data) {
						document.getElementById("resultado").style.display = "block";
						$("#resultado").empty();
						$("#resultado").append(data);

					}
				});
			});
		});
	</script>

</body>

</html>