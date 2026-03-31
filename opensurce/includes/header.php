<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Banco Institucional - Información económica y financiera de Ecuador">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | ' : ''; ?>Banco Institucional</title>

    <!-- Estilos propios -->
    <link rel="stylesheet" href="<?php echo $basePath ?? ''; ?>css/styles.css">

    <!-- Leaflet.js CSS (mapa interactivo) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Chart.js -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
</head>
<body>

<!-- ===== NAVEGACIÓN ===== -->
<nav class="navbar">
    <div class="navbar-inner">
        <a class="navbar-brand" href="<?php echo $basePath ?? ''; ?>index.php">
            🏛️ <span>Banco</span>&nbsp;Institucional
        </a>

        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menú" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <ul class="navbar-nav" id="navbarNav">
            <li><a href="<?php echo $basePath ?? ''; ?>index.php">Inicio</a></li>
            <li><a href="<?php echo $basePath ?? ''; ?>mapa.php">Mapa</a></li>
            <li><a href="<?php echo $basePath ?? ''; ?>nosotros.php">Nosotros</a></li>
            <li><a href="<?php echo $basePath ?? ''; ?>estadisticas.php">Estadísticas</a></li>
            <li><a href="<?php echo $basePath ?? ''; ?>contacto.php">Contacto</a></li>
        </ul>
    </div>
</nav>
<!-- /NAVEGACIÓN -->
