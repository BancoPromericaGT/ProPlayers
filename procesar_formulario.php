<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Variables para el mensaje
$mensaje = '';
$mostrar_formulario = true; // Variable para controlar la visualización del formulario

// Configuración de la base de datos
$servername = "sql307.ezyro.com";
$username = "ezyro_38280614";
$password = "Guatemala1821";
$dbname = "ezyro_38280614_formulario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4"); // Establecer el conjunto de caracteres

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preparar y vincular
    $stmt = $conn->prepare("INSERT INTO usuarios (nombres, apellidos, universidad, email, telefono, dpi, fecha, direccion, participare, comentarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $nombres, $apellidos, $universidad, $email, $telefono, $dpi, $fecha, $direccion, $participare, $comentarios);

    // Asignar valores a las variables y validar/sanitizar
    $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $universidad = isset($_POST['universidad']) ? $_POST['universidad'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $dpi = isset($_POST['dpi']) ? $_POST['dpi'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $participare = isset($_POST['participare']) ? $_POST['participare'] : 'no';
    $comentarios = isset($_POST['comentarios']) ? $_POST['comentarios'] : '';

   // Ejecutar la consulta
if ($stmt->execute()) {
    // Mensaje personalizado según la opción de participación
    if ($participare === 'yes') {
        $mensaje = '<div class="mensaje-centro">';
        $mensaje .= "<h2>¡Gracias por inscribirte, $nombres $apellidos!</h2>";
        $mensaje .= "<h3>Tu registro se ha creado exitosamente y estás inscrito para participar.</h3>";
        $mensaje .= '<img src="assets/images/BANNER-U-SHOWDOWN.png" alt="Felicitaciones" style="max-width:60%; height:auto;">';
        $mensaje .= '</div>';
    } else {
        $mensaje = '<div class="mensaje-centro">';
        $mensaje .= "<h2>¡Gracias por tu interés, $nombres $apellidos!</h2>";
        $mensaje .= "<h3>Has elegido no participar en los torneos.</h3>";
		 $mensaje .= '<img src="assets/images/no-inscrito.png" alt="Felicitaciones" style="max-width:60%; height:auto;">';
        $mensaje .= '</div>';
    }
    $mostrar_formulario = false; // Ocultar el formulario
} else {
    $mensaje = '<div class="mensaje-centro">';
    $mensaje .= "Error: " . $stmt->error; // Muestra el error específico
    $mensaje .= '</div>';
}

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Registraste</title>

    <meta name="description" content="GoodGames - Bootstrap template for communities and games store">
    <meta name="keywords" content="game, gaming, template, HTML template, responsive, Bootstrap, premium">
    <meta name="author" content="_nK">

    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- START: Styles -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7cOpen+Sans:400,700" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <script defer src="assets/vendor/fontawesome-free/js/all.js"></script>
    <script defer src="assets/vendor/fontawesome-free/js/v4-shims.js"></script>

    <!-- IonIcons -->
    <link rel="stylesheet" href="assets/vendor/ionicons/css/ionicons.min.css">

    <!-- Flickity -->
    <link rel="stylesheet" href="assets/vendor/flickity/dist/flickity.min.css">

    <!-- Photoswipe -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/photoswipe/dist/default-skin/default-skin.css">

    <!-- Seiyria Bootstrap Slider -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-slider/dist/css/bootstrap-slider.min.css">

    <!-- Summernote -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/summernote/dist/summernote-bs4.css">

    <!-- GoodGames -->
    <link rel="stylesheet" href="assets/css/goodgames.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/custom.css">
    
    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/486d531a62.js" crossorigin="anonymous"></script>
    
	 <style>
        .custom-radio {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .custom-radio input[type="radio"] {
            margin-right: 10px;
        }

        .custom-radio span {
            font-size: 16px;
        }
		  .mensaje-centro {
            text-align: center; /* Centra el texto */
            margin: 20px; /* Espacio alrededor del mensaje */
        }
    </style>
</head>


<!--
    Additional Classes:
        .nk-page-boxed
-->
<body>
	
<header class="nk-header nk-header-opaque">
<!-- START: Top Contacts -->
<div class="nk-contacts-top">
    <div class="container">
        <div class="nk-contacts-left">
            <ul class="nk-social-links">
                <li><a class="nk-social-twitch" href="https://www.twitch.tv/proplayerslatam" target="_blank"><span class="fab fa-twitch"></span></a></li>
				<li><a class="nk-social-tiktok" href="https://www.tiktok.com/@proplayerslatam_" target="_blank"><span class="fa-brands fa-tiktok"></span></a></li>
                <li><a class="nk-social-facebook" href="#" target="_blank"><span class="fab fa-facebook"></span></a></li>
				<li><a class="nk-social-youtube" href="https://www.youtube.com/@proplayerslatam" target="_blank"><span class="fab fa-youtube"></span></a></li>
				<li><a class="nk-social-instagram" href="https://www.instagram.com/proplayerslatam_/profilecard/?igsh=ams4cnlxOTlkMThp" target="_blank"><span class="fab fa-instagram"></span></a></li>
                <li><a class="nk-social-discord" href="https://discord.com/channels/@proplayerslatam" target="_blank"><span class="fa-brands fa-discord"></span></a></li>
             

                <!-- Additional Social Buttons
   					<li><a class="nk-social-twitter" href="#" target="_blank"><span class="fab fa-twitter"></span></a></li>
					<li><a class="nk-social-pinterest" href="#"><span class="fab fa-pinterest-p"></span></a></li>
					<li><a class="nk-social-google-plus" href="#"><span class="fab fa-google-plus"></span></a></li>
					<li><a class="nk-social-steam" href="#"><span class="fab fa-steam"></span></a></li>
					<li><a class="nk-social-rss" href="#"><span class="fa fa-rss"></span></a></li>
                    <li><a class="nk-social-behance" href="#"><span class="fab fa-behance"></span></a></li>
                    <li><a class="nk-social-bitbucket" href="#"><span class="fab fa-bitbucket"></span></a></li>
                    <li><a class="nk-social-dropbox" href="#"><span class="fab fa-dropbox"></span></a></li>
                    <li><a class="nk-social-dribbble" href="#"><span class="fab fa-dribbble"></span></a></li>
                    <li><a class="nk-social-deviantart" href="#"><span class="fab fa-deviantart"></span></a></li>
                    <li><a class="nk-social-flickr" href="#"><span class="fab fa-flickr"></span></a></li>
                    <li><a class="nk-social-foursquare" href="#"><span class="fab fa-foursquare"></span></a></li>
                    <li><a class="nk-social-github" href="#"><span class="fab fa-github"></span></a></li>
                    <li><a class="nk-social-medium" href="#"><span class="fab fa-medium"></span></a></li>
                    <li><a class="nk-social-odnoklassniki" href="#"><span class="fab fa-odnoklassniki"></span></a></li>
                    <li><a class="nk-social-paypal" href="#"><span class="fab fa-paypal"></span></a></li>
                    <li><a class="nk-social-reddit" href="#"><span class="fab fa-reddit"></span></a></li>
                    <li><a class="nk-social-skype" href="#"><span class="fab fa-skype"></span></a></li>
                    <li><a class="nk-social-soundcloud" href="#"><span class="fab fa-soundcloud"></span></a></li>
                    <li><a class="nk-social-slack" href="#"><span class="fab fa-slack"></span></a></li>
                    <li><a class="nk-social-tumblr" href="#"><span class="fab fa-tumblr"></span></a></li>
                    <li><a class="nk-social-vimeo" href="#"><span class="fab fa-vimeo"></span></a></li>
                    <li><a class="nk-social-vk" href="#"><span class="fab fa-vk"></span></a></li>
                    <li><a class="nk-social-wordpress" href="#"><span class="fab fa-wordpress"></span></a></li>
                    
                -->
            </ul>
        </div>
       <!-- <div class="nk-contacts-right">
            <ul class="nk-contacts-icons">
                
                <li>
                    <a href="#" data-toggle="modal" data-target="#modalSearch">
                        <span class="fa fa-search"></span>
                    </a>
                </li>
                
                
                <li>
                    <a href="#" data-toggle="modal" data-target="#modalLogin">
                        <span class="fa fa-user"></span>
                    </a>
                </li>
                
                
                <li>
                    <span class="nk-cart-toggle">
                        <span class="fa fa-shopping-cart"></span>
                        <span class="nk-badge">0</span>
                    </span>
                    <div class="nk-cart-dropdown">
                        
                        <div class="nk-widget-post">
                            <a href="store-product.html" class="nk-post-image">
                                <img src="assets/images/Most popular 160x205.png" alt="In all revolutions of">
                            </a>
                            <h3 class="nk-post-title">
                                <a href="#" class="nk-cart-remove-item"><span class="ion-android-close"></span></a>
                                <a href="store.html">In all revolutions of</a>
                            </h3>
                            <div class="nk-gap-1"></div>
                            <div class="nk-product-price">Q 23.00</div>
                        </div>
                        
                        <div class="nk-widget-post">
                            <a href="store.html" class="nk-post-image">
                                <img src="assets/images/Most popular 160x205.png" alt="With what mingled joy">
                            </a>
                            <h3 class="nk-post-title">
                                <a href="#" class="nk-cart-remove-item"><span class="ion-android-close"></span></a>
                                <a href="store-product.html">With what mingled joy</a>
                            </h3>
                            <div class="nk-gap-1"></div>
                            <div class="nk-product-price">Q 14.00</div>
                        </div>
                        
                        <div class="nk-gap-2"></div>
                        <div class="text-center">
                            <a href="store.html" class="nk-btn nk-btn-rounded nk-btn-color-main-1 nk-btn-hover-color-white">Store</a>
                        </div>
                    </div>
                </li>
                
            </ul>
        </div>-->
    </div>
</div>
<!-- END: Top Contacts -->

    

    <!--
        START: Navbar

        Additional Classes:
            .nk-navbar-sticky
            .nk-navbar-transparent
            .nk-navbar-autohide
    -->
    <nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-autohide">
        <div class="container">
            <div class="nk-nav-table">
                
                <a href="index.html" class="nk-nav-logo">
                    <img src="assets/images/logo.png" alt="GoodGames" width="199">
                </a>
                
                <ul class="nk-nav nk-nav-right d-none d-lg-table-cell" data-nav-mobile="#nk-nav-mobile">
		
					
                    
        <!-- <li class=" nk-drop-item">-->
			<li>
            <a href="promociones.html">
               Promociones
                
            </a>
			 
		<!--<ul class="dropdown">
                        
        <li>
            <a href="puntos.html">
                Puntos
                
            </a>
        </li>
        <li>
            <a href="compras.html">
                Compras
                
            </a>
        </li>
			  <li>
            <a href="cashback.html">
                Cash Back
                
            </a>
        </li>           
			 
	</ul>-->
        </li>
		<!--Mas opciones de menu	
			<ul class="dropdown">
                        
        <li>
			
            <a href="elements.html">
                Elements (Shortcodes)
                
            </a>
        </li>
        <li class=" nk-drop-item">
            <a href="forum.html">
                Forum
                
            </a><ul class="dropdown">
                        
        <li>
            <a href="forum.html">
                Forum
                
            </a>
        </li>
        <li>
            <a href="forum-topics.html">
                Topics
                
            </a>
        </li>
        <li>
            <a href="forum-single-topic.html">
                Single Topic
                
            </a>
        </li>
                    </ul>
        </li>
        <li>
            <a href="widgets.html">
                Widgets
                
            </a>
        </li>
        <li>
            <a href="coming-soon.html">
                Coming Soon
                
            </a>
        </li>
        <li>
            <a href="offline.html">
                Offline
                
            </a>
        </li>
        <li>
            <a href="404.html">
                404
                
            </a>
        </li>
                    </ul>
		-->
    
        <li class="nk-drop-item">
            <a href="#">
               Stream
                
            </a><ul class="dropdown">
         <li>
            <a href="liveplay.html">
                LivePlay
                
            </a>
        </li>                
        <li>
            <a href="proacademy.html">
                ProAcademy
                
            </a>
        </li>
       
			  
                    </ul>
        </li>
       
        <!---
        <li class=" nk-drop-item">
            <a href="#">
                Tournaments
                
            </a><ul class="dropdown">
                        
        <li>
            <a href="tournaments.html">
                Tournament
                
            </a>
        </li>
        <li>
            <a href="tournaments-teammate.html">
                Teammate
                
            </a>
        </li>
                    </ul>
        </li>-->
		 <li>
            <a href="tournaments.html">
                Torneos
                
            </a>
        </li>			
		 <li>
            <a href="gallery.html">
                Galería
                
            </a>
        </li>
		 <li>
            <a href="tournaments-teams.html">
                U-Showdon
                
            </a>
        </li>
		
		<!--<li>
            <a href="store.html">
                Tienda
                
            </a>
        </li>-->
		<!--			
        <li class=" nk-drop-item">
            <a href="#">
                Store
                
            </a><ul class="dropdown">
                        
        <li>
            <a href="store.html">
                Store
                
            </a>
        </li>
        <li>
            <a href="store-product.html">
                Product
                
            </a>
        </li>
        <li>
            <a href="store-catalog.html">
                Catalog
                
            </a>
        </li>
        <li>
            <a href="store-catalog-alt.html">
                Catalog Alt
                
            </a>
        </li>
        <li>
            <a href="store-checkout.html">
                Checkout
                
            </a>
        </li>
        <li>
            <a href="store-cart.html">
                Cart
                
            </a>
        </li>
                    </ul>
        </li>
					
		-->			
                </ul>
                <ul class="nk-nav nk-nav-right nk-nav-icons">
                    
                        <li class="single-icon d-lg-none">
                            <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile">
                                <span class="nk-icon-burger">
                                    <span class="nk-t-1"></span>
                                    <span class="nk-t-2"></span>
                                    <span class="nk-t-3"></span>
                                </span>
                            </a>
                        </li>
                    
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- END: Navbar -->

</header>

    
    
        <!--
    START: Navbar Mobile

    Additional Classes:
        .nk-navbar-left-side
        .nk-navbar-right-side
        .nk-navbar-lg
        .nk-navbar-overlay-content
-->
<div id="nk-nav-mobile" class="nk-navbar nk-navbar-side nk-navbar-right-side nk-navbar-overlay-content d-lg-none">
    <div class="nano">
        <div class="nano-content">
            <a href="index.html" class="nk-nav-logo">
                <img src="assets/images/logo.png" alt="" width="120">
            </a>
            <div class="nk-navbar-mobile-content">
                <ul class="nk-nav">
                    <!-- Here will be inserted menu from [data-mobile-menu="#nk-nav-mobile"] -->
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END: Navbar Mobile -->

	
<?php
// Mostrar el mensaje si existe
if ($mensaje) {
    echo $mensaje;
}

// Mostrar el formulario solo si es necesario
if ($mostrar_formulario) {
?>
    <form action="" method="post">
        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>
        <br>
        <label for="universidad">Universidad:</label>
        <input type="text" name="universidad" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required>
        <br>
        <label for="dpi">DPI:</label>
        <input type="text" name="dpi" required>
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>
        <br>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" required>
        <br>
        <label for="participare">Participaré:</label>
        <select name="participare" required>
            <option value="yes">Sí</option>
            <option value="no">No</option>
        </select>
        <br>
        <label for="comentarios">Comentarios:</label>
        <textarea name="comentarios"></textarea>
        <br>
        <input type="submit" value="Enviar">
    </form>
<?php
}
?>
		
<footer class="nk-footer">
<!-- 
    <div class="container">
        <div class="nk-gap-3"></div>
        <div class="row vertical-gap">
            <div class="col-md-6">
                <div class="nk-widget">
                    <h4 class="nk-widget-title"><span class="text-main-1">Suscribete</span> Ahora</h4>
                    <div class="nk-widget-content">
                        <form action="php/ajax-contact-form.php" class="nk-form nk-form-ajax">
                            <div class="row vertical-gap sm-gap">
                                <div class="col-md-6">
                                    <input type="email" class="form-control required" name="email" placeholder="Email *">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control required" name="name" placeholder="Nombre *">
                                </div>
                            </div>
                            <div class="nk-gap"></div>
                            <textarea class="form-control required" name="message" rows="5" placeholder="Mensaje*"></textarea>
                            <div class="nk-gap-1"></div>
                            <button class="nk-btn nk-btn-rounded nk-btn-color-white">
                                <span>Enviar</span>
                                <span class="icon"><i class="ion-paper-airplane"></i></span>
                            </button>
                            <div class="nk-form-response-success"></div>
                            <div class="nk-form-response-error"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="nk-widget">
                    <h4 class="nk-widget-title"><span class="text-main-1">últimos</span> Posts</h4>
                    <div class="nk-widget-content">
                        <div class="row vertical-gap sm-gap">
                            
                            <div class="col-lg-6">
                                <div class="nk-widget-post-2">
                                    <a href="torneos.html" class="nk-post-image">
                                        <img src="assets/images/valorant.png" alt="">
                                    </a>
                                    <div class="nk-post-title"><a href="torneos.html">Valorant es un juego de disparos en primera persona en equipos de 5 vrs 5. El objetivo de cada partida es colocar una mecha o evitar que la coloque el otro equipo .</a></div>
                                    <div class="nk-post-date">
                                        <span class="fa fa-calendar"></span> Sep 18, 2024
                                        <span class="fa fa-comments"></span> <a href="#">4</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="nk-widget-post-2">
                                    <a href="torneos.html" class="nk-post-image">
                                        <img src="assets/images/fifa24.png" alt="">
                                    </a>
                                    <div class="nk-post-title"><a href="torneos.html">FIFA le da vida al deporte rey y te permite jugar con las ligas, los clubes y los jugadores más importantes del futbol mundial.</a></div>
                                    <div class="nk-post-date">
                                        <span class="fa fa-calendar"></span> Sep 5, 2024
                                        <span class="fa fa-comments"></span> <a href="#">7</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="nk-widget">
                    <h4 class="nk-widget-title"><span class="text-main-1">In</span> Twitter</h4>
                    <div class="nk-widget-content">
                        <div class="nk-twitter-list" data-twitter-count="1"></div>
                    </div>
                </div>
				
            </div>
        </div> 
		
        <div class="nk-gap-3"></div>
    </div>-->
	
                   
    <div class="nk-copyright">
        <div class="container">
            <div class="nk-copyright-left">
              <a target="_blank" href="https://www.bancopromerica.com.gt/" style="color: #ffffff; text-decoration: none"><span>© 2025 Banco Promerica Guatemala</span></a>
            </div>
		
            <div class="nk-copyright-right">
                <ul class="nk-social-links-2">
                    <li><a class="nk-social-facebook" href="https://www.facebook.com/Promericaguatemala/" target="_blank"><span class="fab fa-facebook"></span></a></li>
					
                    <li><a class="nk-social-twitter" href="https://x.com/promericagt" target="_blank"><span class="fa-brands fa-square-x-twitter"></span></a></li>
					<li><a class="nk-social-youtube" href="https://www.youtube.com/@bancopromericaguatemala2718/featured" target="_blank"><span class="fab fa-youtube"></span></a></li>
					<li><a class="nk-social-linkedin" href="https://gt.linkedin.com/company/banco-promerica-gt" target="_blank"><span class="fab fa-linkedin"></span></a></li>
					<li><a class="nk-social-instagram" href="https://www.instagram.com/bancopromericagt/" target="_blank"><span class="fab fa-instagram"></span></a></li>

                    <!-- Additional Social Buttons
						<li><a class="nk-social-twitch" href="https://www.twitch.tv/proplayerslatam" target="_blank"><span class="fab fa-twitch"></span></a></li>
						<li><a class="nk-social-pinterest" href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a class="nk-social-google-plus" href="#"><span class="fab fa-google-plus"></span></a></li>
 						<li><a class="nk-social-steam" href="#"><span class="fab fa-steam"></span></a></li>
                    	<li><a class="nk-social-rss" href="#"><span class="fa fa-rss"></span></a></li>
                        <li><a class="nk-social-behance" href="#"><span class="fab fa-behance"></span></a></li>
                        <li><a class="nk-social-bitbucket" href="#"><span class="fab fa-bitbucket"></span></a></li>
                        <li><a class="nk-social-dropbox" href="#"><span class="fab fa-dropbox"></span></a></li>
                        <li><a class="nk-social-dribbble" href="#"><span class="fab fa-dribbble"></span></a></li>
                        <li><a class="nk-social-deviantart" href="#"><span class="fab fa-deviantart"></span></a></li>
                        <li><a class="nk-social-flickr" href="#"><span class="fab fa-flickr"></span></a></li>
                        <li><a class="nk-social-foursquare" href="#"><span class="fab fa-foursquare"></span></a></li>
                        <li><a class="nk-social-github" href="#"><span class="fab fa-github"></span></a></li>
                        <li><a class="nk-social-medium" href="#"><span class="fab fa-medium"></span></a></li>
                        <li><a class="nk-social-odnoklassniki" href="#"><span class="fab fa-odnoklassniki"></span></a></li>
                        <li><a class="nk-social-paypal" href="#"><span class="fab fa-paypal"></span></a></li>
                        <li><a class="nk-social-reddit" href="#"><span class="fab fa-reddit"></span></a></li>
                        <li><a class="nk-social-skype" href="#"><span class="fab fa-skype"></span></a></li>
                        <li><a class="nk-social-soundcloud" href="#"><span class="fab fa-soundcloud"></span></a></li>
                        <li><a class="nk-social-slack" href="#"><span class="fab fa-slack"></span></a></li>
                        <li><a class="nk-social-tumblr" href="#"><span class="fab fa-tumblr"></span></a></li>
                        <li><a class="nk-social-vimeo" href="#"><span class="fab fa-vimeo"></span></a></li>
                        <li><a class="nk-social-vk" href="#"><span class="fab fa-vk"></span></a></li>
                        <li><a class="nk-social-wordpress" href="#"><span class="fab fa-wordpress"></span></a></li>
                  --> 
                </ul>
            </div>

        </div>
    </div>
</footer>
  
        <!-- START: Page Background -->

    <img class="nk-page-background-top" src="assets/images/bg-top.png" alt="">
    <img class="nk-page-background-bottom" src="assets/images/bg-bottom.png" alt="">

<!-- END: Page Background --> 
<!-- START: Scripts -->

<!-- Object Fit Polyfill -->
<script src="assets/vendor/object-fit-images/dist/ofi.min.js"></script>

<!-- GSAP -->
<script src="assets/vendor/gsap/src/minified/TweenMax.min.js"></script>
<script src="assets/vendor/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>

<!-- Popper -->
<script src="assets/vendor/popper.js/dist/umd/popper.min.js"></script>

<!-- Bootstrap -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Sticky Kit -->
<script src="assets/vendor/sticky-kit/dist/sticky-kit.min.js"></script>

<!-- Jarallax -->
<script src="assets/vendor/jarallax/dist/jarallax.min.js"></script>
<script src="assets/vendor/jarallax/dist/jarallax-video.min.js"></script>

<!-- imagesLoaded -->
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>

<!-- Flickity -->
<script src="assets/vendor/flickity/dist/flickity.pkgd.min.js"></script>

<!-- Photoswipe -->
<script src="assets/vendor/photoswipe/dist/photoswipe.min.js"></script>
<script src="assets/vendor/photoswipe/dist/photoswipe-ui-default.min.js"></script>

<!-- Jquery Validation -->
<script src="assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>

<!-- Jquery Countdown + Moment -->
<script src="assets/vendor/jquery-countdown/dist/jquery.countdown.min.js"></script>
<script src="assets/vendor/moment/min/moment.min.js"></script>
<script src="assets/vendor/moment-timezone/builds/moment-timezone-with-data.min.js"></script>

<!-- Hammer.js -->
<script src="assets/vendor/hammerjs/hammer.min.js"></script>

<!-- NanoSroller -->
<script src="assets/vendor/nanoscroller/bin/javascripts/jquery.nanoscroller.js"></script>

<!-- SoundManager2 -->
<script src="assets/vendor/soundmanager2/script/soundmanager2-nodebug-jsmin.js"></script>

<!-- Seiyria Bootstrap Slider -->
<script src="assets/vendor/bootstrap-slider/dist/bootstrap-slider.min.js"></script>

<!-- Summernote -->
<script src="assets/vendor/summernote/dist/summernote-bs4.min.js"></script>

<!-- nK Share -->
<script src="assets/plugins/nk-share/nk-share.js"></script>

<!-- GoodGames -->
<script src="assets/js/goodgames.min.js"></script>
<script src="assets/js/goodgames-init.js"></script>
<!-- END: Scripts -->
</body>
</html>