/* ====================================================
   OPENSURCE - JavaScript Principal
   Descripción: Menú responsivo, mapa, filtros, gráficos
                y validación de formularios
   ==================================================== */

/* ====================================================
   1. MENÚ RESPONSIVO
   ==================================================== */
(function () {
    'use strict';

    var toggle = document.getElementById('menuToggle');
    var nav    = document.getElementById('navbarNav');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', nav.classList.contains('open'));
        });

        // Cerrar menú al hacer click en un enlace
        var links = nav.querySelectorAll('a');
        links.forEach(function (link) {
            link.addEventListener('click', function () {
                nav.classList.remove('open');
            });
        });
    }

    // Marcar enlace activo según URL
    var currentPath = window.location.pathname.split('/').pop() || 'index.php';
    var navLinks = document.querySelectorAll('.navbar-nav a');
    navLinks.forEach(function (link) {
        var href = link.getAttribute('href').split('/').pop();
        if (href === currentPath) {
            link.classList.add('active');
        }
    });
})();

/* ====================================================
   2. MAPA INTERACTIVO (Leaflet.js)
   ==================================================== */

/**
 * Inicializa un mapa Leaflet en el contenedor indicado.
 * @param {string} mapId  - ID del elemento HTML del mapa
 * @param {number} lat    - Latitud del centro
 * @param {number} lng    - Longitud del centro
 * @param {number} zoom   - Nivel de zoom inicial
 * @returns {L.Map|null}  - Instancia del mapa o null si no existe el contenedor
 */
function initializeMap(mapId, lat, lng, zoom) {
    var container = document.getElementById(mapId);
    if (!container || typeof L === 'undefined') return null;

    var map = L.map(mapId).setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18
    }).addTo(map);

    return map;
}

/**
 * Agrega marcadores al mapa desde un array de ubicaciones.
 * @param {L.Map}   map       - Instancia del mapa Leaflet
 * @param {Array}   locations - Array de objetos de ubicación
 * @returns {Array}           - Array de marcadores creados
 */
function addMarkersToMap(map, locations) {
    if (!map || !locations || !locations.length) return [];

    var markers = [];

    locations.forEach(function (loc) {
        var services = Array.isArray(loc.services) ? loc.services.join(', ') : '';

        var popupContent =
            '<div style="min-width:200px;font-family:Segoe UI,sans-serif">' +
            '<h3 style="color:#1a3a52;margin:0 0 6px;font-size:1rem">' + loc.name + '</h3>' +
            '<p style="color:#6c757d;font-size:.85rem;margin:0 0 6px">' + loc.desc + '</p>' +
            (loc.address    ? '<p style="font-size:.82rem;margin:0 0 4px">📍 ' + loc.address    + '</p>' : '') +
            (loc.population ? '<p style="font-size:.82rem;margin:0 0 4px">👥 ' + loc.population + '</p>' : '') +
            (services       ? '<p style="font-size:.82rem;margin:0">🏢 ' + services + '</p>' : '') +
            '</div>';

        var marker = L.marker([loc.lat, loc.lng])
            .addTo(map)
            .bindPopup(popupContent);

        marker.locationData = loc;
        markers.push(marker);
    });

    return markers;
}

/* ====================================================
   3. FILTROS DEL MAPA
   ==================================================== */

/**
 * Aplica filtros de búsqueda/región a los marcadores del mapa.
 * @param {L.Map}  map        - Instancia del mapa
 * @param {Array}  markers    - Array de marcadores
 * @param {string} searchText - Texto de búsqueda
 * @param {string} region     - Región seleccionada
 */
function applyMapFilters(map, markers, searchText, region) {
    if (!map || !markers) return;

    var visible = [];

    markers.forEach(function (marker) {
        var loc  = marker.locationData;
        var name = (loc.name || '').toLowerCase();
        var reg  = (loc.region || '').toLowerCase();
        var txt  = searchText.toLowerCase().trim();

        var matchSearch = !txt || name.indexOf(txt) !== -1;
        var matchRegion = !region || reg === region;

        if (matchSearch && matchRegion) {
            if (!map.hasLayer(marker)) marker.addTo(map);
            visible.push(loc);
        } else {
            if (map.hasLayer(marker)) map.removeLayer(marker);
        }
    });

    updateLocationsPanel(visible);
}

/**
 * Actualiza el panel informativo con las ubicaciones visibles.
 * @param {Array} locations - Ubicaciones visibles
 */
function updateLocationsPanel(locations) {
    var panel = document.getElementById('locationsPanel');
    var count = document.getElementById('visibleCount');

    if (count) count.textContent = locations.length;

    if (!panel) return;

    if (!locations.length) {
        panel.innerHTML = '<p style="color:#6c757d;font-size:.9rem">No se encontraron ubicaciones.</p>';
        return;
    }

    var html = '<div class="locations-list">';
    locations.forEach(function (loc) {
        html +=
            '<div class="location-item" onclick="focusLocation(' + loc.lat + ',' + loc.lng + ')">' +
            '<strong>' + loc.name + '</strong>' +
            '<span>' + (loc.region ? loc.region.charAt(0).toUpperCase() + loc.region.slice(1) : '') + '</span>' +
            '</div>';
    });
    html += '</div>';
    panel.innerHTML = html;
}

// Variable global del mapa principal (usada por focusLocation)
var _mainMap = null;

/**
 * Centra el mapa en una ubicación específica.
 */
function focusLocation(lat, lng) {
    if (_mainMap) {
        _mainMap.setView([lat, lng], 12);
    }
}

/* ====================================================
   4. INICIALIZACIÓN DEL MAPA EN mapa.php
   ==================================================== */
document.addEventListener('DOMContentLoaded', function () {

    // --- Mapa principal (mapa.php) ---
    var mapContainer = document.getElementById('map');
    if (mapContainer && typeof locationsData !== 'undefined') {
        _mainMap = initializeMap('map', -1.8312, -78.1834, 7);
        var allMarkers = addMarkersToMap(_mainMap, locationsData);
        updateLocationsPanel(locationsData);

        // Filtros
        var searchInput  = document.getElementById('searchInput');
        var regionSelect = document.getElementById('regionSelect');
        var resetBtn     = document.getElementById('resetFilters');

        function applyFilters() {
            var txt = searchInput ? searchInput.value : '';
            var reg = regionSelect ? regionSelect.value : '';
            applyMapFilters(_mainMap, allMarkers, txt, reg);
        }

        if (searchInput)  searchInput.addEventListener('input',  applyFilters);
        if (regionSelect) regionSelect.addEventListener('change', applyFilters);
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                if (searchInput)  searchInput.value  = '';
                if (regionSelect) regionSelect.value = '';
                applyFilters();
                _mainMap.setView([-1.8312, -78.1834], 7);
            });
        }
    }

    // --- Mapa preview (index.php) ---
    var previewContainer = document.getElementById('map-preview');
    if (previewContainer && typeof locationsData !== 'undefined') {
        var previewMap = initializeMap('map-preview', -1.8312, -78.1834, 6);
        addMarkersToMap(previewMap, locationsData);
    }

    // --- Mapa contacto (contacto.php) ---
    var contactoContainer = document.getElementById('map-contacto');
    if (contactoContainer) {
        var contactMap = initializeMap('map-contacto', -0.1807, -78.4678, 13);
        if (contactMap) {
            L.marker([-0.1807, -78.4678])
                .addTo(contactMap)
                .bindPopup('<b>Oficina Principal</b><br>Av. Paseo de la República 5740, Quito')
                .openPopup();
        }
    }

    /* ====================================================
       5. GRÁFICOS CHART.JS (estadisticas.php)
       ==================================================== */
    if (typeof Chart !== 'undefined') {

        // Colores institucionales
        var colorPrimario   = '#1a3a52';
        var colorSecundario = '#2c5aa0';
        var colorAcento     = '#e74c3c';
        var colores = [colorPrimario, colorSecundario, colorAcento, '#27ae60', '#f39c12'];

        // --- Gráfico 1: Crecimiento del PIB (línea) ---
        var ctxPib = document.getElementById('chartPib');
        if (ctxPib) {
            new Chart(ctxPib, {
                type: 'line',
                data: {
                    labels: ['2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                        label: 'PIB (miles de millones USD)',
                        data: [98.8, 104.2, 108.5, 112.1, 116.4],
                        borderColor: colorSecundario,
                        backgroundColor: 'rgba(44,90,160,.1)',
                        borderWidth: 3,
                        pointBackgroundColor: colorSecundario,
                        pointRadius: 5,
                        fill: true,
                        tension: .4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } },
                    scales: {
                        y: { beginAtZero: false, grid: { color: 'rgba(0,0,0,.05)' } }
                    }
                }
            });
        }

        // --- Gráfico 2: Tasa de Desempleo (barras) ---
        var ctxDesempleo = document.getElementById('chartDesempleo');
        if (ctxDesempleo) {
            new Chart(ctxDesempleo, {
                type: 'bar',
                data: {
                    labels: ['2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                        label: 'Tasa de Desempleo (%)',
                        data: [5.1, 4.8, 4.5, 4.2, 3.9],
                        backgroundColor: [colorPrimario, colorSecundario, colorAcento, '#27ae60', '#f39c12'],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,.05)' } }
                    }
                }
            });
        }

        // --- Gráfico 3: Inflación Anual (donut) ---
        var ctxInflacion = document.getElementById('chartInflacion');
        if (ctxInflacion) {
            new Chart(ctxInflacion, {
                type: 'doughnut',
                data: {
                    labels: ['2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                        data: [3.47, 2.45, 1.98, 1.73, 1.52],
                        backgroundColor: colores,
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: {
                            callbacks: {
                                label: function (ctx) {
                                    return ctx.label + ': ' + ctx.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });
        }

        // --- Gráfico 4: Distribución Sectorial (pastel) ---
        var ctxSectorial = document.getElementById('chartSectorial');
        if (ctxSectorial) {
            new Chart(ctxSectorial, {
                type: 'pie',
                data: {
                    labels: ['Petróleo', 'Manufactura', 'Agricultura', 'Servicios', 'Otros'],
                    datasets: [{
                        data: [28, 22, 18, 24, 8],
                        backgroundColor: colores,
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: {
                            callbacks: {
                                label: function (ctx) {
                                    return ctx.label + ': ' + ctx.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });
        }
    }

    /* ====================================================
       6. VALIDACIÓN DE FORMULARIOS
       ==================================================== */
    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            if (!validateForm('contactForm')) {
                e.preventDefault();
            }
        });
    }
});

/**
 * Valida un formulario por su ID.
 * @param {string} formId - ID del formulario a validar
 * @returns {boolean}     - true si es válido
 */
function validateForm(formId) {
    var form  = document.getElementById(formId);
    var valid = true;

    if (!form) return false;

    // Limpiar errores previos
    form.querySelectorAll('.error').forEach(function (el) { el.classList.remove('error'); });
    form.querySelectorAll('.error-msg').forEach(function (el) { el.classList.remove('show'); });

    // Campos requeridos
    form.querySelectorAll('[required]').forEach(function (field) {
        if (!field.value.trim()) {
            setFieldError(field, 'Este campo es requerido.');
            valid = false;
        }
    });

    // Validar email
    var emailField = form.querySelector('input[type="email"]');
    if (emailField && emailField.value.trim() && !isValidEmail(emailField.value.trim())) {
        setFieldError(emailField, 'Ingrese un correo electrónico válido.');
        valid = false;
    }

    // Validar teléfono (solo dígitos y signos básicos)
    var phoneField = form.querySelector('input[type="tel"]');
    if (phoneField && phoneField.value.trim()) {
        var phoneRegex = /^[+]?[\d\s\-().]{7,20}$/;
        if (!phoneRegex.test(phoneField.value.trim())) {
            setFieldError(phoneField, 'Ingrese un número de teléfono válido.');
            valid = false;
        }
    }

    return valid;
}

/**
 * Marca un campo con error y muestra el mensaje.
 */
function setFieldError(field, message) {
    field.classList.add('error');
    var errorMsg = field.parentElement.querySelector('.error-msg');
    if (errorMsg) {
        errorMsg.textContent = message;
        errorMsg.classList.add('show');
    }
}

/**
 * Valida formato de email.
 * @param {string} email
 * @returns {boolean}
 */
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}
