<?php
// ==========================================================
// CONFIGURACIÓN Y DATOS DINÁMICOS DE LA PÁGINA (PHP)
// ==========================================================
$site_title       = "ECOLAP | Inicio - Transforma tu Huella Ambiental";
$site_description = "ECOLAP - Plataforma integral para aprender, jugar y rastrear el reciclaje en tu ciudad.";
$site_keywords    = "ECOLAP, reciclaje, sostenibilidad, medio ambiente, economía circular";
$site_author      = "Equipo ECOLAP";
$current_year     = date("Y"); // Obtiene el año actual automáticamente (ej. 2026)
$pagina_actual    = basename($_SERVER['PHP_SELF']); // Detecta el archivo activo

// Enlaces del menú principal
$menu_items = [
    ['titulo' => 'Inicio', 'url' => 'index.php'],
    ['titulo' => 'Aprende y Recicla', 'url' => 'aprende.php']
];

// Estadísticas de la sección Hero
$estadisticas = [
    ['icono' => '♻️', 'numero' => '+1.000', 'etiqueta' => 'Toneladas gestionadas'],
    ['icono' => '🌍', 'numero' => '+25K',   'etiqueta' => 'Comunidad ECOLAP'],
    ['icono' => '📍', 'numero' => '+150',   'etiqueta' => 'Puntos de ruta'],
    ['icono' => '🌱', 'numero' => '98%',    'etiqueta' => 'Impacto positivo']
];

// Módulos principales
$modulos = [
    [
        'icono'       => '📚',
        'titulo'      => 'Aprende y Recicla con ECOLAP',
        'descripcion' => 'Domina el arte del reciclaje con las guías oficiales ECOLAP.',
        'texto_link'  => 'Ir a Aprende ECOLAP',
        'url'         => 'aprende.php'
    ],
    [
        'icono'       => '🎮',
        'titulo'      => 'Juegos Educativos ECOLAP',
        'descripcion' => 'Pon a prueba tus reflejos con ECOLAP Fast-Sorter y Misión Urbana.',
        'texto_link'  => 'Jugar en ECOLAP',
        'url'         => 'juegos.php'
    ],
    [
        'icono'       => '🗺️',
        'titulo'      => 'Ruta de Recolectores ECOLAP',
        'descripcion' => 'Sigue en tiempo real los camiones y recolectores ECOLAP.',
        'texto_link'  => 'Ver Mapa ECOLAP',
        'url'         => 'mapa.php'
    ]
];
?>
<!DOCTYPE html>
<!-- Define el tipo de documento como HTML5 -->
<html lang="es">
<!-- Idioma del documento: español -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta name="author" content="<?php echo htmlspecialchars($site_author); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_keywords); ?>">

    <title><?php echo htmlspecialchars($site_title); ?></title>

    <!-- Carga de Google Fonts Montserrat y Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icono de la pestaña del navegador (favicon) con el logo oficial ECOLAP -->
    <link rel="icon" type="image/png" href="Img/LG_original.png">
    <link rel="apple-touch-icon" href="Img/LG_original.png">

    <!-- Enlace a la hoja de estilos externa styles.css con control de caché dinámico -->
    <link rel="stylesheet" href="styles.css?v=<?php echo file_exists('styles.css') ? filemtime('styles.css') : '1787719118'; ?>">

    <!-- Estilos específicos del banner promocional de la App Móvil ECOLAP -->
    <style>
        .ecolap-app-banner {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(0);
            z-index: 9999;
            background: linear-gradient(135deg, #0b1d16 0%, #1B4D3E 50%, #00A86B 100%);
            color: var(--ecolap-blanco, #FFFFFF);
            padding: 18px 60px 18px 24px;
            border-radius: 18px;
            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.4),
                0 0 30px rgba(0, 255, 135, 0.4),
                0 0 60px rgba(0, 168, 107, 0.2);
            border: 2px solid var(--ecolap-neon, #00FF87);
            display: flex;
            align-items: center;
            gap: 18px;
            max-width: 600px;
            width: calc(100% - 40px);
            animation: ecolap-banner-slide-up 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) 1.5s backwards;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .ecolap-app-banner-icon {
            font-size: 2.2rem;
            flex-shrink: 0;
            animation: ecolap-banner-bounce 2s ease-in-out infinite;
        }

        .ecolap-app-banner-text {
            flex: 1;
            min-width: 0;
        }

        .ecolap-app-banner-text h4 {
            color: var(--ecolap-blanco, #FFFFFF);
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            margin: 0 0 4px 0;
            font-weight: 700;
            line-height: 1.2;
        }

        .ecolap-app-banner-text p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.82rem;
            margin: 0;
            line-height: 1.3;
        }

        .ecolap-app-banner-text p strong {
            color: var(--ecolap-neon, #00FF87);
            text-shadow: 0 0 8px rgba(0, 255, 135, 0.5);
        }

        .ecolap-app-banner-btn {
            background: var(--ecolap-neon, #00FF87);
            color: #0b1d16;
            padding: 12px 20px;
            border: none;
            border-radius: 50px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            white-space: nowrap;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(0, 255, 135, 0.5);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .ecolap-app-banner-btn:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 255, 135, 0.7), 0 0 20px rgba(0, 255, 135, 0.5);
        }

        .ecolap-app-banner-btn:active {
            transform: translateY(0) scale(0.98);
        }

        .ecolap-app-banner-close {
            position: absolute;
            top: 8px;
            right: 10px;
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: var(--ecolap-blanco, #FFFFFF);
            font-size: 1.1rem;
            line-height: 1;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .ecolap-app-banner-close:hover {
            background: #ff4757;
            border-color: #ff4757;
            transform: rotate(90deg) scale(1.1);
            box-shadow: 0 0 12px rgba(255, 71, 87, 0.6);
        }

        .ecolap-app-banner.hidden {
            animation: ecolap-banner-fade-out 0.4s ease forwards;
        }

        @keyframes ecolap-banner-slide-up {
            from { opacity: 0; transform: translateX(-50%) translateY(120%); }
            to { opacity: 1; transform: translateX(-50%) translateY(0); }
        }

        @keyframes ecolap-banner-fade-out {
            from { opacity: 1; transform: translateX(-50%) translateY(0) scale(1); }
            to { opacity: 0; transform: translateX(-50%) translateY(80px) scale(0.9); }
        }

        @keyframes ecolap-banner-bounce {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-6px) rotate(5deg); }
        }

        @media (max-width: 600px) {
            .ecolap-app-banner {
                bottom: 12px;
                padding: 14px 50px 14px 16px;
                gap: 12px;
                border-radius: 14px;
            }
            .ecolap-app-banner-icon { font-size: 1.7rem; }
            .ecolap-app-banner-text h4 { font-size: 0.9rem; }
            .ecolap-app-banner-text p { font-size: 0.75rem; }
            .ecolap-app-banner-btn {
                padding: 10px 16px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 380px) {
            .ecolap-app-banner-btn span.btn-text { display: none; }
        }
    </style>
</head>

<body>

    <!-- ==========================================================
         HEADER / BARRA DE NAVEGACIÓN ECOLAP
         ========================================================== -->
    <header class="ecolap-header">
        <div class="container">
            <nav class="ecolap-nav">
                <a href="index.php" class="ecolap-logo">
                    <div class="ecolap-logo-icon"><img src="Img/LG_original.png" alt="Logo ECOLAP" class="ecolap-logo-img"></div>
                    <div class="ecolap-logo-text">ECO<span>LAP</span></div>
                </a>
                
                <!-- Menú generado dinámicamente con PHP -->
                <ul class="ecolap-menu" id="ecolapMenu">
                    <?php foreach ($menu_items as $item): ?>
                        <?php $clase_activa = ($pagina_actual === $item['url']) ? 'class="active"' : ''; ?>
                        <li>
                            <a href="<?php echo $item['url']; ?>" <?php echo $clase_activa; ?>>
                                <?php echo htmlspecialchars($item['titulo']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button class="ecolap-burger" id="ecolapBurger" aria-label="Menú ECOLAP">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- ==========================================================
         SECCIÓN HERO
         ========================================================== -->
    <section class="ecolap-hero" id="inicio">
        <div class="container">
            <div class="ecolap-hero-content">
                <div class="ecolap-hero-text">
                    <div class="ecolap-badge">
                        <span class="ecolap-badge-dot"></span>
                        Plataforma ECOLAP activa <?php echo $current_year; ?>
                    </div>
                    <h1>Bienvenido a <span>ECOLAP</span>: Transforma tu Huella Ambiental</h1>
                    <p>La solución digital integral de ECOLAP para aprender, jugar y rastrear el reciclaje en tu ciudad.</p>
                    <div class="ecolap-hero-buttons">
                        <a href="aprende.php" class="ecolap-btn-primary">Explorar ECOLAP <span>→</span></a>
                    </div>
                </div>

                <!-- Tarjetas de estadísticas generadas con bucle PHP -->
                <div class="ecolap-hero-stats">
                    <?php foreach ($estadisticas as $stat): ?>
                        <div class="ecolap-stat-card">
                            <div class="ecolap-stat-icon"><?php echo $stat['icono']; ?></div>
                            <div class="ecolap-stat-number"><?php echo htmlspecialchars($stat['numero']); ?></div>
                            <div class="ecolap-stat-label"><?php echo htmlspecialchars($stat['etiqueta']); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         SECCIÓN DE MÓDULOS RESUMIDOS
         ========================================================== -->
    <section class="ecolap-section" id="modulos">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Módulos de la plataforma ECOLAP</span>
                <h2 class="ecolap-section-title">Tres formas de impactar con ECOLAP</h2>
                <p class="ecolap-section-subtitle">ECOLAP integra aprendizaje, gamificación y rastreo en tiempo real para transformar tu relación con el reciclaje.</p>
            </div>

            <!-- Grid de módulos generado con bucle PHP -->
            <div class="ecolap-cards-grid">
                <?php foreach ($modulos as $modulo): ?>
                    <div class="ecolap-card">
                        <div class="ecolap-card-icon"><?php echo $modulo['icono']; ?></div>
                        <h3><?php echo htmlspecialchars($modulo['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($modulo['descripcion']); ?></p>
                        <a href="<?php echo $modulo['url']; ?>" class="ecolap-card-link">
                            <?php echo htmlspecialchars($modulo['texto_link']); ?> <span>→</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         FOOTER ECOLAP
         ========================================================== -->
    <footer class="ecolap-footer">
        <div class="container">
            <div class="ecolap-footer-content">
                <div class="ecolap-footer-brand">
                    <a href="index.php" class="ecolap-logo">
                        <div class="ecolap-logo-icon"><img src="Img/LG_original.png" alt="Logo ECOLAP" class="ecolap-logo-img"></div>
                        <div class="ecolap-logo-text">ECO<span>LAP</span></div>
                    </a>
                    <p>ECOLAP es la plataforma líder en gestión e incentivo del reciclaje.</p>
                    <div class="ecolap-footer-social">
                        <a href="#" class="ecolap-social-link" aria-label="Facebook ECOLAP">f</a>
                        <a href="#" class="ecolap-social-link" aria-label="Twitter ECOLAP">𝕏</a>
                        <a href="#" class="ecolap-social-link" aria-label="Instagram ECOLAP">📷</a>
                        <a href="#" class="ecolap-social-link" aria-label="LinkedIn ECOLAP">in</a>
                    </div>
                </div>
                <div class="ecolap-footer-col">
                    <h4>ECOLAP</h4>
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="aprende.php">Aprende y Recicla</a></li>
                        <li><a href="juegos.php">Juegos Eco</a></li>
                        <li><a href="mapa.php">Ruta Recolectores</a></li>
                    </ul>
                </div>
                <div class="ecolap-footer-col">
                    <h4>Recursos</h4>
                    <ul>
                        <li><a href="#">Guías ECOLAP</a></li>
                        <li><a href="#">Manuales</a></li>
                        <li><a href="#">Investigación</a></li>
                        <li><a href="#">Blog Verde</a></li>
                    </ul>
                </div>
                <div class="ecolap-footer-col">
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="mailto:contacto@ecolap.com">contacto@ecolap.com</a></li>
                        <li><a href="#">Soporte ECOLAP</a></li>
                        <li><a href="#">Alianzas</a></li>
                        <li><a href="#">Prensa</a></li>
                    </ul>
                </div>
            </div>
            <div class="ecolap-footer-bottom">
                <p>© <?php echo $current_year; ?> <span>ECOLAP</span>. Todos los derechos reservados.</p>
                <p>Desarrollado con 💚 para la <span>propuesta oficial ECOLAP</span></p>
            </div>
        </div>
    </footer>

    <!-- ==========================================================
         📱 BANNER PROMOCIONAL APP MÓVIL ECOLAP
         ========================================================== -->
    <div class="ecolap-app-banner" id="ecolapAppBanner" role="alert" aria-live="polite">
        <button class="ecolap-app-banner-close" id="ecolapBannerClose" aria-label="Cerrar banner de la app ECOLAP">
            ✕
        </button>

        <div class="ecolap-app-banner-icon">📱</div>

        <div class="ecolap-app-banner-text">
            <h4>¡Lleva a ECOLAP en tu bolsillo!</h4>
            <p>Descarga nuestra App móvil para <strong>iOS y Android</strong></p>
        </div>

        <a href="ECOLAP.apk" download="ECOLAP.apk" class="ecolap-app-banner-btn">
            <span class="btn-text">Descargar App</span> 🚀
        </a>
    </div>

    <!-- ==========================================================
         SCRIPT JAVASCRIPT
         ========================================================== -->
    <script>
        const burger = document.getElementById('ecolapBurger');
        const menu = document.getElementById('ecolapMenu');

        burger.addEventListener('click', () => {
            burger.classList.toggle('active');
            menu.classList.toggle('active');
        });

        document.querySelectorAll('.ecolap-menu a').forEach(link => {
            link.addEventListener('click', () => {
                burger.classList.remove('active');
                menu.classList.remove('active');
            });
        });

        const banner = document.getElementById('ecolapAppBanner');
        const closeBtn = document.getElementById('ecolapBannerClose');

        closeBtn.addEventListener('click', () => {
            banner.classList.add('hidden');
            setTimeout(() => {
                banner.style.display = 'none';
            }, 400);
        });
    </script>
</body>

</html>