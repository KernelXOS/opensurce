<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="footer-grid">
        <!-- Columna 1: Nosotros -->
        <div class="footer-col">
            <h4>🏛️ Banco Institucional</h4>
            <p>Institución financiera pública comprometida con el desarrollo económico y social del Ecuador.</p>
        </div>

        <!-- Columna 2: Enlaces rápidos -->
        <div class="footer-col">
            <h4>Enlaces</h4>
            <ul>
                <li><a href="<?php echo $basePath ?? ''; ?>index.php">Inicio</a></li>
                <li><a href="<?php echo $basePath ?? ''; ?>mapa.php">Mapa Interactivo</a></li>
                <li><a href="<?php echo $basePath ?? ''; ?>nosotros.php">Nosotros</a></li>
                <li><a href="<?php echo $basePath ?? ''; ?>estadisticas.php">Estadísticas</a></li>
                <li><a href="<?php echo $basePath ?? ''; ?>contacto.php">Contacto</a></li>
            </ul>
        </div>

        <!-- Columna 3: Contacto -->
        <div class="footer-col">
            <h4>Contacto</h4>
            <ul>
                <li>📍 Av. Paseo de la República 5740, Quito</li>
                <li>📞 +593 2 255-1234</li>
                <li>✉️ info@bancoinstitucional.gob.ec</li>
                <li>🕐 Lun–Vie: 08:00 – 17:00</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Banco Institucional del Ecuador. Todos los derechos reservados.</p>
    </div>
</footer>
<!-- /FOOTER -->

<!-- Leaflet.js (cargado al final para mejor rendimiento) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Script principal -->
<script src="<?php echo $basePath ?? ''; ?>js/script.js"></script>

</body>
</html>
