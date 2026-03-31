<?php
/**
 * nosotros.php - Información Institucional
 * Banco Institucional del Ecuador
 */
$pageTitle = 'Nosotros';
$basePath  = '';
include 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<section class="hero" style="padding:90px 20px 50px">
    <h1>Sobre Nosotros</h1>
    <p>Institución financiera con más de 50 años al servicio del Ecuador</p>
</section>

<!-- ===== HISTORIA ===== -->
<section class="section section-alt">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:start" class="about-grid">
            <div>
                <h2 class="section-title" style="text-align:left">Nuestra Historia</h2>
                <div class="divider" style="margin:0 0 16px"></div>
                <p style="color:#6c757d;margin-bottom:20px">Fundados en 1972, el Banco Institucional del Ecuador ha sido pilar fundamental del desarrollo económico y financiero del país, brindando servicios de calidad a millones de ciudadanos.</p>

                <div class="timeline">
                    <div class="timeline-item">
                        <h4>1972 — Fundación</h4>
                        <p>Creación del Banco Institucional por decreto presidencial para fomentar el ahorro nacional.</p>
                    </div>
                    <div class="timeline-item">
                        <h4>1985 — Expansión Nacional</h4>
                        <p>Apertura de sucursales en Guayaquil, Cuenca y Ambato, alcanzando cobertura nacional.</p>
                    </div>
                    <div class="timeline-item">
                        <h4>1999 — Modernización Digital</h4>
                        <p>Implementación de sistemas informáticos de vanguardia y servicios en línea.</p>
                    </div>
                    <div class="timeline-item">
                        <h4>2010 — Premio a la Excelencia</h4>
                        <p>Reconocimiento internacional por transparencia y gestión financiera responsable.</p>
                    </div>
                    <div class="timeline-item">
                        <h4>2026 — Transformación Digital</h4>
                        <p>Lanzamiento de plataforma digital integral y app móvil para todos los ciudadanos.</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="section-title" style="text-align:left">Datos Institucionales</h2>
                <div class="divider" style="margin:0 0 24px"></div>
                <div class="stats-row" style="justify-content:flex-start;gap:24px;margin-top:0">
                    <div class="stat-item">
                        <h3>50+</h3>
                        <p>Años de experiencia</p>
                    </div>
                    <div class="stat-item">
                        <h3>2,400</h3>
                        <p>Empleados</p>
                    </div>
                    <div class="stat-item">
                        <h3>5</h3>
                        <p>Oficinas principales</p>
                    </div>
                    <div class="stat-item">
                        <h3>1.2M</h3>
                        <p>Clientes atendidos</p>
                    </div>
                </div>

                <div style="margin-top:30px">
                    <img src="assets/img/institucion.jpg"
                         alt="Sede principal del Banco Institucional"
                         style="width:100%;border-radius:8px;box-shadow:0 4px 15px rgba(0,0,0,.1)"
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MISIÓN, VISIÓN Y VALORES ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Misión, Visión y Valores</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Los pilares que guían nuestra gestión institucional</p>

        <div class="cards-grid">
            <div class="card" style="border-top:4px solid #1a3a52">
                <h3>🎯 Misión</h3>
                <p>Promover el desarrollo económico y social del Ecuador mediante la prestación de servicios financieros de calidad, accesibles para todos los ciudadanos, con transparencia, eficiencia e innovación.</p>
            </div>
            <div class="card" style="border-top:4px solid #2c5aa0">
                <h3>🔭 Visión</h3>
                <p>Ser la institución financiera pública referente en Latinoamérica, reconocida por su excelencia operativa, contribución al bienestar social y liderazgo en la transformación digital del sector.</p>
            </div>
            <div class="card" style="border-top:4px solid #e74c3c">
                <h3>⭐ Valores</h3>
                <ul style="list-style:disc;padding-left:20px;color:#6c757d;font-size:.9rem;line-height:2">
                    <li>Transparencia e integridad</li>
                    <li>Responsabilidad social</li>
                    <li>Innovación continua</li>
                    <li>Orientación al ciudadano</li>
                    <li>Trabajo en equipo</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== EQUIPO DIRECTIVO ===== -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">Equipo Directivo</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Líderes comprometidos con el desarrollo institucional</p>

        <div class="team-grid">
            <div class="team-card">
                <div class="team-avatar">👔</div>
                <h3>Dr. Carlos Mendoza</h3>
                <p class="role">Director General</p>
                <p>Economista con PhD en Finanzas Internacionales. 25 años de experiencia en el sector bancario público y privado del Ecuador.</p>
            </div>
            <div class="team-card">
                <div class="team-avatar">👩‍💼</div>
                <h3>Ing. María Rodríguez</h3>
                <p class="role">Directora Financiera</p>
                <p>Especialista en gestión de riesgos financieros y planificación estratégica. Ex funcionaria del Banco Central del Ecuador.</p>
            </div>
            <div class="team-card">
                <div class="team-avatar">💻</div>
                <h3>MSc. Andrés Torres</h3>
                <p class="role">Director de Tecnología</p>
                <p>Ingeniero en Sistemas con maestría en Transformación Digital. Líder de la modernización tecnológica institucional.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<style>
@media (max-width: 768px) {
    .about-grid { grid-template-columns: 1fr !important; }
}
</style>
