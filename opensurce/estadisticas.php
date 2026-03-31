<?php
/**
 * estadisticas.php - Gráficos e Indicadores Económicos
 * Banco Institucional del Ecuador
 */
$pageTitle = 'Estadísticas';
$basePath  = '';
include 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<section class="hero" style="padding:90px 20px 50px">
    <h1>Estadísticas Económicas</h1>
    <p>Indicadores macroeconómicos del Ecuador 2022–2026</p>
</section>

<!-- ===== RESUMEN DE INDICADORES ===== -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">Resumen 2026</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Cifras destacadas del ejercicio fiscal 2026</p>

        <div class="indicators-grid">
            <div class="indicator-card">
                <div class="icon">📈</div>
                <h3>$116.4B</h3>
                <p>PIB Nacional (USD)</p>
                <span class="trend trend-up">▲ 3.8% crecimiento</span>
            </div>
            <div class="indicator-card">
                <div class="icon">💼</div>
                <h3>3.9%</h3>
                <p>Tasa de Desempleo</p>
                <span class="trend trend-up">▼ Mínimo histórico</span>
            </div>
            <div class="indicator-card">
                <div class="icon">💰</div>
                <h3>1.52%</h3>
                <p>Inflación Anual</p>
                <span class="trend trend-up">▼ Bajo control</span>
            </div>
            <div class="indicator-card">
                <div class="icon">🏭</div>
                <h3>28%</h3>
                <p>Sector Petrolero</p>
                <span class="trend trend-down">▼ Diversificación</span>
            </div>
        </div>
    </div>
</section>

<!-- ===== GRÁFICOS ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Gráficos Interactivos</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Evolución de los principales indicadores económicos</p>

        <div class="charts-grid">
            <!-- Gráfico 1: PIB -->
            <div class="chart-card">
                <h3>📈 Crecimiento del PIB (2022–2026)</h3>
                <canvas id="chartPib"></canvas>
            </div>

            <!-- Gráfico 2: Desempleo -->
            <div class="chart-card">
                <h3>💼 Tasa de Desempleo (2022–2026)</h3>
                <canvas id="chartDesempleo"></canvas>
            </div>

            <!-- Gráfico 3: Inflación -->
            <div class="chart-card">
                <h3>💰 Inflación Anual por Año</h3>
                <canvas id="chartInflacion"></canvas>
            </div>

            <!-- Gráfico 4: Sectorial -->
            <div class="chart-card">
                <h3>🏭 Distribución Sectorial del PIB</h3>
                <canvas id="chartSectorial"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- ===== TABLA DE DATOS ===== -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">Tabla de Indicadores</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Datos históricos 2022–2026</p>

        <div style="overflow-x:auto;margin-top:24px">
            <table style="width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,.1)">
                <thead>
                    <tr style="background:#1a3a52;color:#fff">
                        <th style="padding:14px 18px;text-align:left;font-size:.9rem">Año</th>
                        <th style="padding:14px 18px;text-align:right;font-size:.9rem">PIB (B USD)</th>
                        <th style="padding:14px 18px;text-align:right;font-size:.9rem">Desempleo (%)</th>
                        <th style="padding:14px 18px;text-align:right;font-size:.9rem">Inflación (%)</th>
                        <th style="padding:14px 18px;text-align:right;font-size:.9rem">Variación PIB</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $datos = [
                        ['año' => 2022, 'pib' => 98.8,  'desempleo' => 5.1, 'inflacion' => 3.47, 'variacion' => 3.1],
                        ['año' => 2023, 'pib' => 104.2, 'desempleo' => 4.8, 'inflacion' => 2.45, 'variacion' => 5.5],
                        ['año' => 2024, 'pib' => 108.5, 'desempleo' => 4.5, 'inflacion' => 1.98, 'variacion' => 4.1],
                        ['año' => 2025, 'pib' => 112.1, 'desempleo' => 4.2, 'inflacion' => 1.73, 'variacion' => 3.3],
                        ['año' => 2026, 'pib' => 116.4, 'desempleo' => 3.9, 'inflacion' => 1.52, 'variacion' => 3.8],
                    ];
                    foreach ($datos as $i => $fila):
                        $bg = ($i % 2 === 0) ? '#f8f9fa' : '#ffffff';
                    ?>
                    <tr style="background:<?php echo $bg; ?>">
                        <td style="padding:12px 18px;font-weight:700;color:#1a3a52"><?php echo $fila['año']; ?></td>
                        <td style="padding:12px 18px;text-align:right">$<?php echo number_format($fila['pib'], 1); ?>B</td>
                        <td style="padding:12px 18px;text-align:right"><?php echo $fila['desempleo']; ?>%</td>
                        <td style="padding:12px 18px;text-align:right"><?php echo $fila['inflacion']; ?>%</td>
                        <td style="padding:12px 18px;text-align:right;color:#27ae60;font-weight:600">▲ <?php echo $fila['variacion']; ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
