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
	<link rel="stylesheet" href="<?= PUBLIC_PATH . '/css/edit.css' ?>">
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


		<div class="container">
			<!-- editar articulo -->
			<div class="cabecera">
				<div class="cabecera-container">
					<img src="<?= PUBLIC_PATH . "/images/banner.png" ?>" alt="cabecera INIFAP" />

				</div>
			</div>
			<a href="<?= URL_BASE . '/admin' ?>">Regresar</a>
			<h2>Editar artículo</h2>
			<div class="libros">
				<?php
				$article = $params['article'];
				$categoria = $article["categoria"];
				$isScientific = $article["categoria"] === "cientifico";
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

				<form class="form" id="edit-form">
					<div class="input-container">
						<div class="input-control">
							<label for="publicacion">Titulo</label><textarea id="publicacion" name="publicacion" type="text" value="<?= $publicacion ?>"><?= $publicacion ?></textarea>
						</div>
						<div class="input-control">
							<label for="muestra">Muestra</label><input id="muestra" name="muestra" type="text" value="<?= $muestra ?>" />
						</div>
						<div class="input-control">
							<label for="cuenta">Cuenta</label><input id="cuenta" name="cuenta" type="text" value="<?= $cuenta ?>" />
						</div>
						<div class="input-control">
							<label for="ano">Año</label><input id="ano" name="ano" type="text" value="<?= $ano ?>" />
						</div>
						<div class="input-control">
							<label for="mensaje">Mensaje</label><textarea id="mensaje" name="mensaje" type="text" value="<?= $mensaje ?>"><?= $mensaje ?></textarea>
						</div>
						<?php if ($isScientific) : ?>
							<div class="input-control">
								<label for="publicacionot">Publicación</label><textarea id="publicacionot" name="publicacionot" type="text" value="<?= $publicacionot ?>"><?= $publicacionot ?></textarea>
							</div>
						<?php endif ?>
						<?php if (!$isScientific) : ?>
							<div class="input-control">
								<label for="imagen">Imagen</label><input id="imagen" name="imagen" type="file" />
							</div>
						<?php endif ?>

						<div class="input-control">
							<label for="pdf">PDF</label><input id="pdf" name="pdf" type="file" />
						</div>

						<input type="hidden" name="id" value="<?= $id ?>" />
						<input type="hidden" name="categoria" value="<?= $categoria ?>" />
					</div>
					<div>
						<img src="<?= PUBLIC_PATH . "/publicaciones/" . $imagen ?>" alt="<?= $publicacion ?>" width="167" height="250" />
						<div class="edita">
							<button type="sumbit" id="editar"><img src="<?= PUBLIC_PATH . "/images/edit.png" ?>" width="32" height="32" />Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</main>

	<!--<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>-->

	<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
	<script>
		const URL_BASE = "<?= URL_BASE ?>";
		const API_BASE = "<?= API_BASE ?>";
	</script>
	<script src="<?= PUBLIC_PATH . "/js/edit.js" ?>"></script>

</body>

</html>