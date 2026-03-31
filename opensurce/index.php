<?php
/**
 * index.php - Página Principal
 * Banco Institucional del Ecuador
 */
$pageTitle = 'Inicio';
$basePath  = '';
include 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<section class="hero">
    <h1>Banco Institucional del Ecuador</h1>
    <p>Promovemos la estabilidad económica y el desarrollo financiero sostenible del país.</p>
    <a href="estadisticas.php" class="btn btn-primary">Ver Estadísticas</a>
    <a href="mapa.php" class="btn btn-outline">Ver Mapa Interactivo</a>
</section>

<!-- ===== INDICADORES ECONÓMICOS ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Indicadores Económicos 2026</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Principales indicadores macroeconómicos del Ecuador</p>

        <div class="indicators-grid">
            <div class="indicator-card">
                <div class="icon">📈</div>
                <h3>$116.4B</h3>
                <p>PIB Nacional</p>
                <span class="trend trend-up">▲ 3.8% vs 2025</span>
            </div>
            <div class="indicator-card">
                <div class="icon">👥</div>
                <h3>7.2M</h3>
                <p>Población Activa</p>
                <span class="trend trend-up">▲ 1.2% vs 2025</span>
            </div>
            <div class="indicator-card">
                <div class="icon">💼</div>
                <h3>3.9%</h3>
                <p>Tasa de Desempleo</p>
                <span class="trend trend-up">▼ 0.3% vs 2025</span>
            </div>
            <div class="indicator-card">
                <div class="icon">💰</div>
                <h3>1.52%</h3>
                <p>Inflación Anual</p>
                <span class="trend trend-up">▼ 0.21% vs 2025</span>
            </div>
        </div>
    </div>
</section>

<!-- ===== MAPA PREVIEW ===== -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">Nuestras Oficinas en Ecuador</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Red de oficinas distribuidas estratégicamente en el territorio nacional</p>

        <?php
        /* Datos de ubicaciones en PHP */
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
        ?>

        <!-- Pasar datos PHP a JavaScript -->
        <script>
            var locationsData = <?php echo json_encode($locations, JSON_UNESCAPED_UNICODE); ?>;
        </script>

        <div id="map-preview"></div>

        <div style="text-align:center;margin-top:20px">
            <a href="mapa.php" class="btn btn-primary">Ver Mapa Completo con Filtros</a>
        </div>
    </div>
</section>

<!-- ===== INFORMACIÓN DESTACADA ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">¿Por qué elegirnos?</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Comprometidos con la excelencia y la transparencia institucional</p>

        <div class="cards-grid">
            <div class="card">
                <h3>🔒 Seguridad Financiera</h3>
                <p>Operamos bajo los más estrictos estándares de seguridad y regulación del sistema financiero ecuatoriano.</p>
            </div>
            <div class="card">
                <h3>📊 Transparencia Total</h3>
                <p>Publicamos indicadores económicos actualizados y reportes de gestión accesibles a todos los ciudadanos.</p>
            </div>
            <div class="card">
                <h3>🌐 Cobertura Nacional</h3>
                <p>Presencia en las principales ciudades del Ecuador con atención personalizada en cada región del país.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
