<?php
// ==========================================================
// CONFIGURACIÓN Y PROCESAMIENTO PHP (mapa.php)
// ==========================================================
session_start();

$site_title       = "Mapa ECOLAP | Ruta en Tiempo Real (Beta)";
$site_description = "ECOLAP Mapa Beta: rastrea en tiempo real los camiones y recolectores de reciclaje en tu ciudad. Versión prototipo oficial ECOLAP.";
$site_keywords    = "ECOLAP, mapa, GPS, recolectores, ruta de reciclaje, tiempo real, beta";
$site_author      = "Equipo ECOLAP";
$logo_path        = "../../../../../../Img/ecolap.png";
$current_year     = date("Y");
$pagina_actual    = basename($_SERVER['PHP_SELF']);

// Menú principal de navegación
$menu_items = [
    ['titulo' => 'Inicio', 'url' => 'index.php', 'clase' => ''],
    ['titulo' => 'Aprende y Recicla', 'url' => 'aprende.php', 'clase' => ''],
    ['titulo' => 'Juegos Eco', 'url' => 'juegos.php', 'clase' => ''],
    ['titulo' => 'Ruta Recolectores', 'url' => 'mapa.php', 'clase' => ''],
    ['titulo' => 'Unirme a ECOLAP', 'url' => 'login.php', 'clase' => 'ecolap-cta-nav']
];

$mensaje_toast = "";
$exito_toast = false;

// Procesar solicitud de recolección enviada por POST (si aplica)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'agendar') {
    $direccion = trim($_POST['sol_direccion'] ?? '');
    $tipo      = trim($_POST['sol_tipo'] ?? '');
    $fecha     = trim($_POST['sol_fecha'] ?? '');
    $horario   = trim($_POST['sol_horario'] ?? '');

    if (!empty($direccion) && !empty($fecha)) {
        // Aquí conectarías con tu base de datos (PDO / MySQLi) para guardar la solicitud
        $mensaje_toast = "¡Recolección agendada con éxito para el {$fecha} ({$horario})!";
        $exito_toast = true;
    } else {
        $mensaje_toast = "Por favor completa los campos obligatorios.";
        $exito_toast = false;
    }
}
?>
<!DOCTYPE html>
<!-- Define el tipo de documento como HTML5 -->
<html lang="es">
<!-- Idioma del documento: español, importante para accesibilidad y SEO -->

<head>
    <!-- Cabecera con metadatos: información no visible en la página -->

    <meta charset="UTF-8">
    <!-- Codificación UTF-8: permite mostrar correctamente caracteres especiales del español -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Hace la página responsiva y controla el zoom inicial en móviles -->

    <meta name="description" content="<?php echo htmlspecialchars($site_description); ?>">
    <!-- Descripción del módulo mapa para SEO -->

    <meta name="author" content="<?php echo htmlspecialchars($site_author); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_keywords); ?>">
    <!-- Palabras clave para indexación en motores de búsqueda -->

    <title><?php echo htmlspecialchars($site_title); ?></title>
    <!-- Título que aparece en la pestaña del navegador -->

    <!-- Carga de Google Fonts Montserrat y Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Leaflet CSS (Opción gratuita OpenStreetMap) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Icono de la pestaña del navegador (favicon) con el logo oficial ECOLAP -->
    <link rel="icon" type="image/png" href="<?php echo $logo_path; ?>">
    <link rel="apple-touch-icon" href="<?php echo $logo_path; ?>">

    <!-- Hoja de estilos externa con control de caché -->
    <link rel="stylesheet" href="styles.css?v=<?php echo file_exists('styles.css') ? filemtime('styles.css') : time(); ?>">

    <!-- Estilos específicos e interactivos de la interfaz rediseñada -->
    <style>
        .ecolap-map-container {
            position: relative;
            width: 100%;
            height: 540px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        #googleMap {
            width: 100%;
            height: 100%;
        }

        /* Panel de Control Superior Unificado */
        .ecolap-control-panel {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid rgba(82, 183, 136, 0.2);
        }

        /* Pestañas para alternar entre Buscar camión o Agendar */
        .ecolap-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 12px;
        }
        .ecolap-tab-btn {
            background: none;
            border: none;
            padding: 8px 16px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            color: #6c757d;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .ecolap-tab-btn.active {
            background: #e8f5e9;
            color: #2d6a4f;
        }

        /* Formulario Grid Interactivo */
        .ecolap-agendar-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            align-items: end;
        }
        .ecolap-field-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .ecolap-field-group label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #2d6a4f;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .ecolap-field-group input, .ecolap-field-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #d8f3dc;
            border-radius: 10px;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 0.88rem;
            background: #f8f9fa;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }
        .ecolap-field-group input:focus, .ecolap-field-group select:focus {
            border-color: #52b788;
            background: #ffffff;
        }

        /* Botón de Enviar dentro del panel */
        .ecolap-btn-agendar {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 176, 155, 0.3);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 42px;
        }
        .ecolap-btn-agendar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 176, 155, 0.5);
        }

        /* Tarjeta Informativa Flotante en OpenStreetMap */
        .ecolap-floating-card {
            z-index: 1000;
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 15px 20px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        /* Notificación Toast Animada */
        .ecolap-toast {
            visibility: hidden;
            min-width: 300px;
            background-color: #2d6a4f;
            color: #fff;
            text-align: center;
            border-radius: 12px;
            padding: 16px;
            position: fixed;
            z-index: 4000;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }
        .ecolap-toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 3.5s;
        }

        @keyframes fadein { from { bottom: 0; opacity: 0; } to { bottom: 30px; opacity: 1; } }
        @keyframes fadeout { from { bottom: 30px; opacity: 1; } to { bottom: 0; opacity: 0; } }
    </style>
</head>

<body class="ecolap-light">

    <!-- ==========================================================
         HEADER / BARRA DE NAVEGACIÓN ECOLAP
         ========================================================== -->
    <header class="ecolap-header">
        <div class="container">
            <nav class="ecolap-nav">
                <a href="index.php" class="ecolap-logo">
                    <div class="ecolap-logo-icon"><img src="<?php echo $logo_path; ?>" alt="Logo ECOLAP" class="ecolap-logo-img"></div>
                    <div class="ecolap-logo-text">ECO<span>LAP</span></div>
                </a>

                <ul class="ecolap-menu" id="ecolapMenu">
                    <?php foreach ($menu_items as $item): ?>
                        <?php
                            $clases = [];
                            if ($pagina_actual === $item['url']) {
                                $clases[] = 'active';
                            }
                            if (!empty($item['clase'])) {
                                $clases[] = $item['clase'];
                            }
                            $attr_class = !empty($clases) ? 'class="' . implode(' ', $clases) . '"' : '';
                        ?>
                        <li>
                            <a href="<?php echo $item['url']; ?>" <?php echo $attr_class; ?>>
                                <?php echo htmlspecialchars($item['titulo']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button class="ecolap-burger" id="ecolapBurger" aria-label="Abrir menú ECOLAP">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- ==========================================================
         ENCABEZADO: RUTA EN TIEMPO REAL ECOLAP (BETA)
         ========================================================== -->
    <section class="ecolap-hero" id="inicio-mapa">
        <div class="container">
            <div class="ecolap-hero-content" style="grid-template-columns: 1fr; text-align: center;">
                <div class="ecolap-hero-text">
                    <div class="ecolap-badge">
                        <span class="ecolap-badge-dot"></span>
                        Versión Beta Prototipo ECOLAP
                    </div>

                    <h1>Ruta en Tiempo Real <span>ECOLAP</span> (Versión Beta Prototipo)</h1>

                    <p style="max-width: 760px; margin: 0 auto 30px;">
                        Monitoreo GPS en vivo de camiones de reciclaje y gestión directa de recolecciones a domicilio.
                    </p>

                    <div class="ecolap-hero-buttons" style="justify-content: center;">
                        <a href="#panel-mapa" class="ecolap-btn-primary">
                            Abrir Gestión ECOLAP
                            <span>🗺️</span>
                        </a>
                        <a href="#nota-ministerio" class="ecolap-btn-secondary">
                            Nota Ministerial
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         PANEL DE GESTIÓN Y MAPA INTERACTIVO
         ========================================================== -->
    <section class="ecolap-section" id="panel-mapa">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Centro de Operaciones ECOLAP</span>
                <h2 class="ecolap-section-title">Gestión de Recolección y Cobertura</h2>
            </div>

            <div class="ecolap-map-wrapper">
                
                <!-- PANEL DE PESTAÑAS Y FORMULARIO INTEGRADO -->
                <div class="ecolap-control-panel">
                    <div class="ecolap-tabs">
                        <button class="ecolap-tab-btn" id="tab-filtro-btn" onclick="alternarModo('filtro')">
                            🔍 Consultar Rutas Activas
                        </button>
                        <button class="ecolap-tab-btn active" id="tab-agendar-btn" onclick="alternarModo('agendar')">
                            📦 Solicitar Recolección a Domicilio
                        </button>
                    </div>

                    <!-- MODO 1: AGENDAR RECOLECCIÓN -->
                    <form id="vista-agendar" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#panel-mapa">
                        <input type="hidden" name="accion" value="agendar">
                        <div class="ecolap-agendar-grid">
                            <div class="ecolap-field-group">
                                <label for="sol_direccion">📍 Dirección</label>
                                <input type="text" id="sol_direccion" name="sol_direccion" placeholder="Ej. Calle 129 #54-07" required>
                            </div>

                            <div class="ecolap-field-group">
                                <label for="sol_tipo">♻️ Residuo</label>
                                <select id="sol_tipo" name="sol_tipo">
                                    <option value="Plástico">Plástico / PET</option>
                                    <option value="Papel">Papel / Cartón</option>
                                    <option value="Vidrio">Vidrio</option>
                                    <option value="Orgánico">Orgánico</option>
                                    <option value="General">General</option>
                                </select>
                            </div>

                            <div class="ecolap-field-group">
                                <label for="sol_fecha">📅 Fecha deseada</label>
                                <input type="date" id="sol_fecha" name="sol_fecha" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <div class="ecolap-field-group">
                                <label for="sol_horario">⏰ Franja Horaria</label>
                                <select id="sol_horario" name="sol_horario">
                                    <option value="Mañana (08:00 - 12:00)">Mañana (08:00 - 12:00)</option>
                                    <option value="Tarde (13:00 - 17:00)">Tarde (13:00 - 17:00)</option>
                                    <option value="Noche (18:00 - 21:00)">Noche (18:00 - 21:00)</option>
                                </select>
                            </div>

                            <button type="submit" class="ecolap-btn-agendar">
                                Confirmar Orden 🚀
                            </button>
                        </div>
                    </form>

                    <!-- MODO 2: CONSULTAR FILTROS DEL MAPA -->
                    <div id="vista-filtro" style="display: none;">
                        <div class="ecolap-agendar-grid">
                            <div class="ecolap-field-group">
                                <label for="filtro-barrio">📍 Barrio / Sector</label>
                                <select id="filtro-barrio">
                                    <option value="todos">Todos los sectores</option>
                                    <option value="centro">Centro Histórico</option>
                                    <option value="norte">Zona Norte</option>
                                    <option value="sur">Zona Sur</option>
                                </select>
                            </div>
                            <div class="ecolap-field-group">
                                <label for="filtro-tipo">♻️ Material</label>
                                <select id="filtro-tipo">
                                    <option value="todos">Todos</option>
                                    <option value="organica">Orgánica</option>
                                    <option value="plastico">Plástico</option>
                                </select>
                            </div>
                            <div class="ecolap-field-group">
                                <label for="filtro-estado">🚛 Estado</label>
                                <select id="filtro-estado">
                                    <option value="todos">Todos</option>
                                    <option value="en-ruta">En ruta activa</option>
                                </select>
                            </div>
                            <button type="button" class="ecolap-btn-agendar" style="background: #2d6a4f;" onclick="filtrarMapaVisual()">
                                Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CONTENEDOR DEL MAPA -->
                <div class="ecolap-map-container">
                    <div id="googleMap"></div>

                    <!-- Tarjeta flotante adaptada sobre el mapa -->
                    <div class="ecolap-floating-card" id="tarjetaEstado">
                        <h4 id="cardTruckTitle">🚛 Camión ECOLAP #042</h4>
                        <p id="cardTruckLocation">📍 Sector Centro - Av. Principal</p>
                        <span class="ecolap-eta-time" id="cardTruckETA">⏱️ Próximo en 15 min</span>
                    </div>
                </div>

                <!-- Leyenda del mapa -->
                <div class="ecolap-map-legend">
                    <div class="ecolap-legend-item">
                        <span class="ecolap-legend-dot truck"></span> Camiones ECOLAP
                    </div>
                    <div class="ecolap-legend-item">
                        <span class="ecolap-legend-dot collector"></span> Recolectores ECOLAP
                    </div>
                    <div class="ecolap-legend-item">
                        <span class="ecolap-legend-dot point"></span> Solicitudes Agendadas
                    </div>
                </div>

                <p class="ecolap-beta-notice">* Visualización en tiempo real conectada al sistema GPS ECOLAP (ecolap_db).</p>
            </div>
        </div>
    </section>

    <!-- TOAST DE NOTIFICACIÓN DE CONFIRMACIÓN -->
    <div id="toastNotificacion" class="ecolap-toast <?php echo !empty($mensaje_toast) ? 'show' : ''; ?>">
        ✅ <strong>¡Notificación ECOLAP!</strong><br>
        <span id="toast-detalle"><?php echo htmlspecialchars($mensaje_toast ?: 'Guardado en la base de datos de ECOLAP.'); ?></span>
    </div>

    <!-- NOTA INFORMATIVA PARA EL MINISTERIO -->
    <section class="ecolap-section" id="nota-ministerio">
        <div class="container">
            <div class="ecolap-ministry-note">
                <h3>📋 Nota Oficial ECOLAP para el Ministerio de Ambiente</h3>
                <p style="margin-bottom: 14px;"><strong>ECOLAP - Módulo de Rastreo GPS en Versión Beta Prototipo:</strong> La presente interfaz constituye un prototipo funcional desarrollado por el equipo ECOLAP para demostrar la viabilidad técnica de un sistema de monitoreo en tiempo real de la flota de recolección de residuos en la ciudad.</p>
                <p style="margin-bottom: 14px;"><strong>Integración GPS planificada:</strong> En su fase de producción, ECOLAP integrará dispositivos GPS IoT en cada camión recolector y enviará coordenadas en tiempo real mediante redes 4G/5G a una API centralizada.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="ecolap-footer">
        <div class="container">
            <div class="ecolap-footer-bottom">
                <p>©️ <?php echo $current_year; ?> <span>ECOLAP</span>. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- JS General del Proyecto -->
    <script src="app.js?v=<?php echo file_exists('app.js') ? filemtime('app.js') : time(); ?>"></script>

    <!-- Leaflet JS (Librería Gratuita de OpenStreetMap) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- CÓDIGO DE INTEGRACIÓN Y LÓGICA DE INTERACCIÓN -->
    <script>
        let map;
        let marcadoresRecolectores = {};

        document.addEventListener("DOMContentLoaded", function() {
            initEcolapMap();
        });

        function initEcolapMap() {
            const lat = 4.7110;
            const lng = -74.0721;

            map = L.map('googleMap').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const camionIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/1995/1995470.png',
                iconSize: [35, 35],
                iconAnchor: [17, 35],
                popupAnchor: [0, -35]
            });

            L.marker([lat, lng], { icon: camionIcon }).addTo(map)
                .bindPopup('<b>Camión ECOLAP #042</b><br>Sector Centro - Av. Principal')
                .openPopup();

            cargarPuntosReciclajeBD();
            iniciarMonitoreoGpsEnVivo();
        }

        // Alterna dinámicamente las pestañas de Agendar y Consultar
        function alternarModo(modo) {
            const vistaAgendar = document.getElementById('vista-agendar');
            const vistaFiltro = document.getElementById('vista-filtro');
            const btnAgendar = document.getElementById('tab-agendar-btn');
            const btnFiltro = document.getElementById('tab-filtro-btn');

            if (modo === 'agendar') {
                vistaAgendar.style.display = 'block';
                vistaFiltro.style.display = 'none';
                btnAgendar.classList.add('active');
                btnFiltro.classList.remove('active');
            } else {
                vistaAgendar.style.display = 'none';
                vistaFiltro.style.display = 'block';
                btnFiltro.classList.add('active');
                btnAgendar.classList.remove('active');
            }
        }

        function mostrarToastNotificacion() {
            const toast = document.getElementById("toastNotificacion");
            toast.className = "ecolap-toast show";
            setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 4000);
        }

        function filtrarMapaVisual() {
            mostrarToastNotificacion();
            document.getElementById('toast-detalle').innerText = "Filtros aplicados a las rutas del mapa.";
        }

        async function cargarPuntosReciclajeBD() {
            try {
                const response = await fetch('/api/puntos');
                if (!response.ok) throw new Error('No se pudieron cargar los puntos.');
                const puntos = await response.json();

                puntos.forEach(p => {
                    L.marker([parseFloat(p.latitud), parseFloat(p.longitud)]).addTo(map)
                        .bindPopup(`<b>${p.nombre}</b><br>Tipo: ${p.tipo_material}`);
                });
            } catch (e) {}
        }

        function iniciarMonitoreoGpsEnVivo() {
            setInterval(async () => {
                try {
                    const response = await fetch('/api/ubicaciones-recolectores');
                    if (!response.ok) throw new Error('No se pudieron cargar los recolectores.');
                    const recolectores = await response.json();

                    recolectores.forEach(r => {
                        actualizarPosicionRecolector(r.id_recolector, parseFloat(r.latitud), parseFloat(r.longitud), r.nombre);
                    });
                } catch (e) {}
            }, 4000);
        }

        function actualizarPosicionRecolector(id, lat, lng, nombre) {
            if (marcadoresRecolectores[id]) {
                marcadoresRecolectores[id].setLatLng([lat, lng]);
            } else {
                marcadoresRecolectores[id] = L.marker([lat, lng]).addTo(map)
                    .bindPopup(`<b>${nombre}</b>`);
            }
        }
    </script>
</body>
</html>