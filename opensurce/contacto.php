<?php
/**
 * contacto.php - Formulario de Contacto
 * Banco Institucional del Ecuador
 */
session_start();
$pageTitle = 'Contacto';
$basePath  = '';
include 'includes/header.php';

/* Recuperar mensajes de sesión */
$successMsg = '';
$errorMsg   = '';

if (isset($_SESSION['contacto_success'])) {
    $successMsg = $_SESSION['contacto_success'];
    unset($_SESSION['contacto_success']);
}
if (isset($_SESSION['contacto_error'])) {
    $errorMsg = $_SESSION['contacto_error'];
    unset($_SESSION['contacto_error']);
}

/* Recuperar valores previos del formulario (en caso de error) */
$oldValues = isset($_SESSION['contacto_old']) ? $_SESSION['contacto_old'] : [];
unset($_SESSION['contacto_old']);
?>

<!-- ===== HERO ===== -->
<section class="hero" style="padding:90px 20px 50px">
    <h1>Contáctenos</h1>
    <p>Estamos aquí para ayudarle. Envíenos su consulta y le responderemos a la brevedad.</p>
</section>

<!-- ===== SECCIÓN CONTACTO ===== -->
<section class="section">
    <div class="container">

        <?php if ($successMsg): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($successMsg); ?></div>
        <?php endif; ?>

        <?php if ($errorMsg): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($errorMsg); ?></div>
        <?php endif; ?>

        <div class="contact-layout">

            <!-- Formulario -->
            <div>
                <h2 class="section-title" style="text-align:left">Enviar Mensaje</h2>
                <div class="divider" style="margin:0 0 24px"></div>

                <form id="contactForm" action="procesar_contacto.php" method="POST" novalidate>
                    <!-- Token CSRF -->
                    <?php
                    if (empty($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }
                    ?>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <div class="form-group">
                        <label for="nombre">Nombre completo *</label>
                        <input type="text" id="nombre" name="nombre" required
                               placeholder="Ej: Juan Pérez"
                               value="<?php echo htmlspecialchars($oldValues['nombre'] ?? ''); ?>">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico *</label>
                        <input type="email" id="email" name="email" required
                               placeholder="Ej: juan@ejemplo.com"
                               value="<?php echo htmlspecialchars($oldValues['email'] ?? ''); ?>">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono"
                               placeholder="Ej: +593 9 8765 4321"
                               value="<?php echo htmlspecialchars($oldValues['telefono'] ?? ''); ?>">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="asunto">Asunto *</label>
                        <input type="text" id="asunto" name="asunto" required
                               placeholder="Ej: Consulta sobre cuenta de ahorro"
                               value="<?php echo htmlspecialchars($oldValues['asunto'] ?? ''); ?>">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select id="categoria" name="categoria">
                            <option value="">Seleccione una categoría</option>
                            <option value="servicios" <?php echo ($oldValues['categoria'] ?? '') === 'servicios' ? 'selected' : ''; ?>>Servicios financieros</option>
                            <option value="creditos"  <?php echo ($oldValues['categoria'] ?? '') === 'creditos'  ? 'selected' : ''; ?>>Créditos y préstamos</option>
                            <option value="reclamos"  <?php echo ($oldValues['categoria'] ?? '') === 'reclamos'  ? 'selected' : ''; ?>>Reclamos y quejas</option>
                            <option value="informacion" <?php echo ($oldValues['categoria'] ?? '') === 'informacion' ? 'selected' : ''; ?>>Información general</option>
                            <option value="otro"      <?php echo ($oldValues['categoria'] ?? '') === 'otro'      ? 'selected' : ''; ?>>Otro</option>
                        </select>
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje *</label>
                        <textarea id="mensaje" name="mensaje" required
                                  placeholder="Escriba su consulta o mensaje aquí..."><?php echo htmlspecialchars($oldValues['mensaje'] ?? ''); ?></textarea>
                        <span class="error-msg"></span>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%">
                        📨 Enviar Mensaje
                    </button>
                </form>
            </div>

            <!-- Información de contacto + mapa -->
            <div>
                <h2 class="section-title" style="text-align:left">Información de Contacto</h2>
                <div class="divider" style="margin:0 0 24px"></div>

                <div class="contact-info">
                    <div class="contact-info-item">
                        <span class="ci-icon">📍</span>
                        <div>
                            <strong>Dirección</strong>
                            <p>Av. Paseo de la República 5740<br>Quito, Pichincha, Ecuador</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <span class="ci-icon">📞</span>
                        <div>
                            <strong>Teléfono</strong>
                            <p>+593 2 255-1234<br>+593 2 255-5678 (alt.)</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <span class="ci-icon">✉️</span>
                        <div>
                            <strong>Correo Electrónico</strong>
                            <p>info@bancoinstitucional.gob.ec<br>contacto@bancoinstitucional.gob.ec</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <span class="ci-icon">🕐</span>
                        <div>
                            <strong>Horario de Atención</strong>
                            <p>Lunes a Viernes: 08:00 – 17:00<br>Sábados: 09:00 – 13:00</p>
                        </div>
                    </div>
                </div>

                <!-- Mapa embebido de la oficina principal -->
                <div style="margin-top:24px">
                    <h4 style="color:#1a3a52;margin-bottom:12px;font-size:.95rem">🗺️ Ubicación de Oficina Principal</h4>
                    <div id="map-contacto"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
