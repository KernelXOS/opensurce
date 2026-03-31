<?php
/**
 * mapa.php - Mapa Interactivo con Filtros
 * Banco Institucional del Ecuador
 */
$pageTitle = 'Mapa Interactivo';
$basePath  = '';

/* Datos de ubicaciones */
$locations = [
    [
        "name"       => "Quito",
        "lat"        => -0.1807,
        "lng"        => -78.4678,
        "desc"       => "Capital del Ecuador y Centro Administrativo",
        "address"    => "Av. Paseo de la República 5740",
        "region"     => "sierra",
        "population" => "1.6 millones",
        "services"   => ["Oficina Principal", "Operaciones", "Tecnología"]
    ],
    [
        "name"       => "Guayaquil",
        "lat"        => -2.1968,
        "lng"        => -79.8841,
        "desc"       => "Mayor centro comercial del Ecuador",
        "address"    => "Av. Francisco de Orellana 214",
        "region"     => "costa",
        "population" => "2.7 millones",
        "services"   => ["Sucursal Principal", "Comercio Exterior", "Banca Empresarial"]
    ],
    [
        "name"       => "Cuenca",
        "lat"        => -2.8975,
        "lng"        => -78.9842,
        "desc"       => "Patrimonio Cultural de la Humanidad (UNESCO)",
        "address"    => "Calle Simón Bolívar 7-65",
        "region"     => "sierra",
        "population" => "636 mil",
        "services"   => ["Sucursal Regional", "Atención al Cliente", "Crédito"]
    ],
    [
        "name"       => "Loja",
        "lat"        => -4.0091,
        "lng"        => -79.2027,
        "desc"       => "Puerta Sur del Ecuador",
        "address"    => "Av. Universitaria 1856",
        "region"     => "sierra",
        "population" => "214 mil",
        "services"   => ["Sucursal Sur", "Microfinanzas", "Ahorro"]
    ],
    [
        "name"       => "Ambato",
        "lat"        => -1.2241,
        "lng"        => -78.6294,
        "desc"       => "Centro Regional de la Sierra Central",
        "address"    => "Calle Montalvo 03-28",
        "region"     => "sierra",
        "population" => "329 mil",
        "services"   => ["Sucursal Centro", "PyMES", "Inversiones"]
    ]
];

include 'includes/header.php';
?>

<!-- ===== HERO PEQUEÑO ===== -->
<section class="hero" style="padding:90px 20px 50px">
    <h1>Mapa Interactivo</h1>
    <p>Explora la red de oficinas del Banco Institucional en todo Ecuador</p>
</section>

<!-- ===== MAPA ===== -->
<section class="section">
    <div class="container">

        <!-- Filtros -->
        <div class="map-filters">
            <div class="filter-group">
                <label for="searchInput">🔍 Buscar por nombre</label>
                <input type="text" id="searchInput" placeholder="Ej: Quito, Guayaquil...">
            </div>
            <div class="filter-group">
                <label for="regionSelect">🗺️ Filtrar por región</label>
                <select id="regionSelect">
                    <option value="">Todas las regiones</option>
                    <option value="sierra">Sierra</option>
                    <option value="costa">Costa</option>
                    <option value="oriente">Oriente</option>
                </select>
            </div>
            <div class="filter-group" style="justify-content:flex-end">
                <button id="resetFilters" class="btn btn-primary" style="width:100%">↺ Resetear filtros</button>
            </div>
        </div>

        <!-- Mapa -->
        <div class="map-wrapper">
            <!-- Pasar datos PHP a JavaScript -->
            <script>
                var locationsData = <?php echo json_encode($locations, JSON_UNESCAPED_UNICODE); ?>;
            </script>
            <div id="map"></div>
        </div>

        <!-- Panel informativo -->
        <div class="map-info-panel">
            <h4>📍 Ubicaciones visibles: <span id="visibleCount"><?php echo count($locations); ?></span></h4>
            <div id="locationsPanel"></div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
