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
    <link rel="stylesheet" href="<?= PUBLIC_PATH . '/css/toastify.min.css' ?>">
    <link rel="stylesheet" href="<?= PUBLIC_PATH . '/css/up.css' ?>">
</head>

<body>
    <div class="loader-container">
        <div class="spinner"></div>
    </div>
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
            <h1>Subir Documentos</h1>

            <form class="form" id="upload-form">
                <div class="input-container">
                    <div class="input-control">
                        <label for="categoria">Categoría</label>
                        <select id="categoria" name="categoria">
                            <option value="tecnico" selected>Técnico</option>
                            <option value="cientifico">Científico</option>
                        </select>
                    </div>
                    <div class="input-control">
                        <label for="publicacion">Titulo</label><textarea id="publicacion" name="publicacion" type="text" required></textarea>
                    </div>
                    <div class="input-control">
                        <label for="muestra">Muestra</label><input id="muestra" name="muestra" type="number" required />
                    </div>
                    <div class="input-control">
                        <label for="cuenta">Cuenta</label><input id="cuenta" name="cuenta" type="number" required />
                    </div>
                    <div class="input-control">
                        <label for="ano">Año</label><input id="ano" name="ano" type="number" required />
                    </div>
                    <div class="input-control">
                        <label for="mensaje">Mensaje</label><textarea id="mensaje" name="mensaje" type="text"></textarea>
                    </div>
                    <!-- <div class="input-control">
                        <label for="publicacionot">Publicación</label><textarea id="publicacionot" name="publicacionot" type="text"></textarea>
                    </div> -->
                    <div class="input-control">
                        <label for="imagen">Imagen</label><input id="imagen" name="imagen" type="file" accept="image/png, image/jpeg, image/jpg" required />
                    </div>

                    <div class="input-control">
                        <label for="pdf">PDF</label><input id="pdf" name="pdf" type="file" accept="application/pdf" required />
                    </div>


                </div>
                <div>

                    <div class="edita">
                        <button type="sumbit" id="editar"><img src="<?= PUBLIC_PATH . "/images/edit.png" ?>" width="32" height="32" />Guardar</button>
                    </div>
                </div>
            </form>

        </div>
    </main>

    <!--<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>-->

    <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
    <script src="<?= PUBLIC_PATH . "/js/toastify-js.js" ?>"></script>

    <script>
        const URL_BASE = "<?= URL_BASE ?>";
        const API_BASE = "<?= API_BASE ?>";
    </script>
    <script src="<?= PUBLIC_PATH . "/js/upload.js" ?>"></script>

</body>

</html>