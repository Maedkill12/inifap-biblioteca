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
	<link rel="stylesheet" href="<?= PUBLIC_PATH . '/css/home.css' ?>">

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
			<div class="cabecera">
				<div class="cabecera-container">
					<img src="<?= PUBLIC_PATH . "/images/banner.png" ?>" alt="cabecera INIFAP" />

				</div>
			</div>
			<div class="search-filtro-container">
				<div class="search-container">
					<input type="search" id="search" name="search" placeholder="Buscar por libro, año..." />
					<button id="lupe"> <img src="<?= PUBLIC_PATH . "/images/lupita.png" ?>" width="50" height="50" /></button>
				</div>

				<div class="filtro">
					<button id="filtro">Filtro</button>
					<!-- dropdown -->
					<div id="dropdown" class="dropdown">
						<button id="all-btn">Todos</button>
						<button id="tech-btn">Técnico</button>
						<button id="scientific-btn">Científico</button>
					</div>
				</div>

			</div>

			<h3>Recien agregados</h3>

			<div class="carousel">
				<?php
				$articles = $params['recent'];

				?>
				<div class="carousel-inner">
					<?php foreach ($articles as $article) : ?>
						<?php
						$publicacion = $article['publicacion'];
						$liga = $article['liga'];
						$muestra = $article['muestra'];
						$cuenta = $article['cuenta'];
						$ano = $article['ano'];
						$mensaje = $article['mensaje'];
						$isScientific =  $article['categoria'] == 'cientifico';
						$publicacionot = $isScientific ? $article['publicacionot'] : null;
						$imagen = $article['imagen'];
						$id = $article['id'];
						?>
						<div class="carousel-item">
							<div class="product" id="product_<?= $id ?>">
								<img src="<?= PUBLIC_PATH . "/publicaciones/" . $imagen ?>" alt="<?= $publicacion ?>" width="167" height="250" />
								<h5><?= $publicacion ?></h5>
								<a href="<?= URL_BASE . "/articulo/" . ($isScientific ? "cientifico/" : "tecnico/") . $id ?>">leer</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<a class="carousel-control prev" href="#carousel" role="button">
					<span class="carousel-control-icon">&lt;</span>
				</a>
				<a class="carousel-control next" href="#carousel" role="button">
					<span class="carousel-control-icon">&gt;</span>
				</a>
			</div>

			<h3>Disponibles</h3>

			<div class="disponibles">
				<?php
				$articles = $params['articles'];

				?>
				<?php foreach ($articles as $article) : ?>
					<?php
					$publicacion = $article['publicacion'];
					$liga = $article['liga'];
					$muestra = $article['muestra'];
					$cuenta = $article['cuenta'];
					$ano = $article['ano'];
					$mensaje = $article['mensaje'];
					$isScientific =  $article['categoria'] == 'cientifico';
					$publicacionot = $isScientific ? $article['publicacionot'] : null;
					$imagen = $article['imagen'];
					$id = $article['id'];
					?>
					<div class="articulos">
						<div class="card" id="product_<?= $id ?>">
							<img src="<?= PUBLIC_PATH . "/publicaciones/" . $imagen ?>" alt="<?= $publicacion ?>" width="167" height="250" />
							<h5><?= $publicacion ?></h5>
							<a class="read-btn" href="<?= URL_BASE . "/articulo/" . ($isScientific ? "cientifico/" : "tecnico/") . $id ?>">leer</a>
						</div>
					</div>
				<?php endforeach; ?>
				<?php if (count($articles) == 0) : ?>
					<h3>No hay artículos disponibles</h3>
				<?php endif; ?>
			</div>
			<?php
			$page = $params["page"]
			?>
			<div class="buttons-container">
				<span>Página <?= $page ?> </span>
				<button id="prev-btn" class="btn-page" <?= $page > 1 ? "" : "disabled" ?>>Anterior</button>
				<button id="next-btn" class="btn-page">Siguente</button>
			</div>
		</div>

	</main>

	<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

	<script>
		const URL_BASE = "<?= URL_BASE ?>";
		const API_BASE = "<?= API_BASE ?>";
	</script>
	<script src="<?= PUBLIC_PATH . "/js/home.js" ?>"></script>

	<!-- Carousel -->
	<script>
		const carousel = document.querySelector(".carousel");
		const carouselInner = carousel.querySelector(".carousel-inner");
		const carouselItems = carousel.querySelectorAll(".carousel-item");
		const carouselControls = carousel.querySelectorAll(".carousel-control");

		let index = 0;
		let offset = 0;

		carouselControls.forEach((control) => {
			control.addEventListener("click", (event) => {
				event.preventDefault();

				const direction = control.classList.contains("prev") ? -1 : 1;

				index = (index + direction + carouselItems.length) % carouselItems.length;
				offset = -index * carousel.offsetWidth;

				for (let item of carouselItems) {
					item.style.transform = `translateX(${offset}px)`;
				}
			});
		});
	</script>
</body>

</html>