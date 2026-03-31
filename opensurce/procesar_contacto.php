<?php
/**
 * procesar_contacto.php - Backend de procesamiento del formulario
 * Banco Institucional del Ecuador
 *
 * Validación de campos, log simulado y redirección con mensajes de sesión.
 */
session_start();

/* Solo aceptar POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contacto.php');
    exit;
}

/* Verificar token CSRF */
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    $_SESSION['contacto_error'] = 'Token de seguridad inválido. Por favor, recargue la página e inténtelo de nuevo.';
    header('Location: contacto.php');
    exit;
}

/* Función auxiliar: sanear texto */
function limpiarTexto(string $valor): string
{
    return trim(htmlspecialchars(strip_tags($valor), ENT_QUOTES, 'UTF-8'));
}

/* Función: validar email */
function validarEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/* Función: validar teléfono */
function validarTelefono(string $tel): bool
{
    return preg_match('/^[+]?[\d\s\-().]{7,20}$/', $tel) === 1;
}

/* ---- Obtener y limpiar campos ---- */
$nombre    = limpiarTexto($_POST['nombre']    ?? '');
$email     = limpiarTexto($_POST['email']     ?? '');
$telefono  = limpiarTexto($_POST['telefono']  ?? '');
$asunto    = limpiarTexto($_POST['asunto']    ?? '');
$categoria = limpiarTexto($_POST['categoria'] ?? '');
$mensaje   = limpiarTexto($_POST['mensaje']   ?? '');

/* Categorías permitidas */
$categoriasPermitidas = ['servicios', 'creditos', 'reclamos', 'informacion', 'otro', ''];

/* ---- Validaciones ---- */
$errores = [];

if (empty($nombre)) {
    $errores[] = 'El nombre completo es requerido.';
}

if (empty($email)) {
    $errores[] = 'El correo electrónico es requerido.';
} elseif (!validarEmail($email)) {
    $errores[] = 'El correo electrónico no tiene un formato válido.';
}

if (!empty($telefono) && !validarTelefono($telefono)) {
    $errores[] = 'El número de teléfono no tiene un formato válido.';
}

if (empty($asunto)) {
    $errores[] = 'El asunto es requerido.';
}

if (!in_array($categoria, $categoriasPermitidas, true)) {
    $errores[] = 'La categoría seleccionada no es válida.';
}

if (empty($mensaje)) {
    $errores[] = 'El mensaje es requerido.';
} elseif (mb_strlen($mensaje) < 10) {
    $errores[] = 'El mensaje debe tener al menos 10 caracteres.';
}

/* ---- Si hay errores, regresar ---- */
if (!empty($errores)) {
    $_SESSION['contacto_error'] = implode(' ', $errores);
    $_SESSION['contacto_old']   = [
        'nombre'    => $nombre,
        'email'     => $email,
        'telefono'  => $telefono,
        'asunto'    => $asunto,
        'categoria' => $categoria,
        'mensaje'   => $mensaje,
    ];
    header('Location: contacto.php');
    exit;
}

/* ---- Registrar en log simulado ---- */
$logDir  = __DIR__ . '/logs';
$logFile = $logDir . '/contacto.log';

if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

$registro = sprintf(
    "[%s] Nombre: %s | Email: %s | Tel: %s | Asunto: %s | Categoría: %s | Mensaje: %s\n",
    date('Y-m-d H:i:s'),
    $nombre,
    $email,
    $telefono ?: 'N/A',
    $asunto,
    $categoria ?: 'N/A',
    str_replace(["\r", "\n"], ' ', $mensaje)
);

// Write log; silently skip if the directory or file is not writable
if (is_writable($logDir) || (is_dir($logDir) && is_writable($logDir))) {
    $written = file_put_contents($logFile, $registro, FILE_APPEND | LOCK_EX);
    // Non-fatal: log failure does not block the user's submission
}

/* ---- Éxito ---- */
// Regenerar token CSRF tras uso exitoso
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

$_SESSION['contacto_success'] =
    '¡Gracias, ' . $nombre . '! Su mensaje ha sido enviado correctamente. ' .
    'Nos pondremos en contacto con usted a la brevedad posible.';

header('Location: contacto.php');
exit;
