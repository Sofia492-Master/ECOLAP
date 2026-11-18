<?php
// ==========================================================
// CONFIGURACIÓN Y DATOS DINÁMICOS DE LA PÁGINA (aprende.php)
// ==========================================================
$site_title       = "Aprende y Recicla | ECOLAP - Plataforma de Investigación";
$site_description = "Módulo Aprende de ECOLAP: guías, manuales y recursos sobre separación de residuos, compostaje y economía circular.";
$site_keywords    = "ECOLAP, aprender a reciclar, separación de residuos, compostaje, economía circular, medio ambiente";
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

// Guías educativas principales
$guias = [
    [
        'icono'       => '🗂️',
        'titulo'      => 'Guía ECOLAP de Separación de Residuos',
        'descripcion' => 'Aprende el método oficial ECOLAP para clasificar correctamente los residuos en la fuente: orgánicos, reciclables, peligrosos y no aprovechables. Incluye códigos de colores y ejemplos prácticos.',
        'temas'       => [
            'Códigos de colores oficiales',
            'Identificación de materiales',
            'Errores comunes al reciclar',
            'Casos especiales y peligrosos'
        ],
        'texto_link'  => 'Acceder a la Guía ONU',
        'url'         => 'https://www.un.org/es/observances/environment-day'
    ],
    [
        'icono'       => '🌻',
        'titulo'      => 'Manual de Compostaje Urbano ECOLAP',
        'descripcion' => 'Convierte tus residuos orgánicos en abono natural de alta calidad. El manual práctico de ECOLAP te enseña técnicas profesionales de compostaje doméstico, urbano y comunitario.',
        'temas'       => [
            'Compostaje en casa y balcón',
            'Técnicas de vermicompostaje',
            'Manejo de olores y humedad',
            'Aplicaciones del compost'
        ],
        'texto_link'  => 'Manual FAO Compostaje',
        'url'         => 'https://www.fao.org/home/es'
    ],
    [
        'icono'       => '♻️',
        'titulo'      => 'Economía Circular y Normativa Ambiental',
        'descripcion' => 'Descubre el modelo de Economía Circular que ECOLAP promueve: producción responsable, consumo consciente y regeneración de recursos. Incluye marco legal y políticas públicas.',
        'temas'       => [
            'Principios de la Economía Circular',
            'Legislación ambiental vigente',
            'Huella de carbono y agua',
            'Empresas y casos de éxito'
        ],
        'texto_link'  => 'Recursos Economía Circular',
        'url'         => 'https://ellenmacarthurfoundation.org/es'
    ]
];

// Recursos oficiales recomendados
$recursos = [
    [
        'icono'       => '🏛️',
        'titulo'      => 'Ministerio de Ambiente',
        'descripcion' => 'Portal oficial con políticas públicas, normativas vigentes y campañas de educación ambiental en América Latina.',
        'texto_link'  => 'Visitar sitio oficial',
        'url'         => 'https://www.minambiente.gov.co/'
    ],
    [
        'icono'       => '🌐',
        'titulo'      => 'ONU Medio Ambiente (PNUMA)',
        'descripcion' => 'Programa de las Naciones Unidas para el Medio Ambiente. Informes globales, datos y soluciones frente a la crisis climática.',
        'texto_link'  => 'Ir a PNUMA',
        'url'         => 'https://www.unep.org/es'
    ],
    [
        'icono'       => '🐼',
        'titulo'      => 'WWF - World Wildlife Fund',
        'descripcion' => 'Organización internacional líder en conservación. Guías prácticas, reportes científicos y herramientas de impacto ambiental.',
        'texto_link'  => 'Visitar WWF',
        'url'         => 'https://www.wwf.org.co/'
    ],
    [
        'icono'       => '🌍',
        'titulo'      => 'Zero Waste International Alliance',
        'descripcion' => 'Alianza internacional que promueve el movimiento Basura Cero. Casos de estudio, certificaciones y estrategias comunitarias.',
        'texto_link'  => 'Ver Zero Waste',
        'url'         => 'https://zwia.org/'
    ],
    [
        'icono'       => '🧪',
        'titulo'      => 'EPA - Environmental Protection Agency',
        'descripcion' => 'Agencia ambiental de Estados Unidos con base de datos completa sobre reciclaje, gestión de residuos y ciencia ambiental.',
        'texto_link'  => 'Ir a EPA Recycle',
        'url'         => 'https://www.epa.gov/recycle'
    ],
    [
        'icono'       => '📊',
        'titulo'      => 'Banco Mundial - Cambio Climático',
        'descripcion' => 'Informes, datos y financiamiento para proyectos de sostenibilidad y mitigación del cambio climático a nivel global.',
        'texto_link'  => 'Ver informes',
        'url'         => 'https://www.bancomundial.org/es/topic/climatechange'
    ]
];

// Datos curiosos sobre el impacto del reciclaje
$datos_curiosos = [
    ['icono' => '⏱️', 'numero' => '500 años',   'etiqueta' => 'Tarda en degradarse una botella de plástico'],
    ['icono' => '💧', 'numero' => '70%',        'etiqueta' => 'Del agua potable se contamina por residuos'],
    ['icono' => '🌳', 'numero' => '17 árboles', 'etiqueta' => 'Se salvan por cada tonelada de papel reciclado'],
    ['icono' => '⚡', 'numero' => '75%',        'etiqueta' => 'De energía se ahorra reciclando aluminio']
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta name="author" content="<?php echo htmlspecialchars($site_author); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_keywords); ?>">

    <title><?php echo htmlspecialchars($site_title); ?></title>

    <!-- Carga de fuentes tipográficas Montserrat y Poppins desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon oficial ECOLAP -->
    <link rel="icon" type="image/png" href="<?php echo $logo_path; ?>">
    <link rel="apple-touch-icon" href="<?php echo $logo_path; ?>">

    <!-- Hoja de estilos externa con control de caché -->
    <link rel="stylesheet" href="styles.css?v=<?php echo file_exists('styles.css') ? filemtime('styles.css') : time(); ?>">
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
         BANNER DE TÍTULO - PLATAFORMA DE INVESTIGACIÓN ECOLAP
         ========================================================== -->
    <section class="ecolap-hero" id="inicio-aprende">
        <div class="container">
            <div class="ecolap-hero-content" style="grid-template-columns: 1fr; text-align: center;">
                <div class="ecolap-hero-text">
                    <div class="ecolap-badge">
                        <span class="ecolap-badge-dot"></span>
                        Módulo de Investigación ECOLAP
                    </div>

                    <h1>Plataforma de Investigación <span>ECOLAP</span>: Guías y Tutoriales</h1>

                    <p style="max-width: 720px; margin: 0 auto 30px;">
                        Accede a recursos pedagógicos verificados, guías oficiales y manuales prácticos de ECOLAP para convertirte en un agente de cambio ambiental certificado.
                    </p>

                    <div class="ecolap-hero-buttons" style="justify-content: center;">
                        <a href="#guias" class="ecolap-btn-primary">
                            Ver Guías ECOLAP
                            <span>→</span>
                        </a>
                        <a href="#recursos" class="ecolap-btn-secondary">
                            Recursos Oficiales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         SECCIÓN DE TARJETAS EDUCATIVAS - GUÍAS ECOLAP
         ========================================================== -->
    <section class="ecolap-section" id="guias">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Investigación ECOLAP</span>
                <h2 class="ecolap-section-title">Guías y Tutoriales ECOLAP</h2>
                <p class="ecolap-section-subtitle">Tres pilares de conocimiento desarrollados por el equipo de investigación de ECOLAP para una formación ambiental completa.</p>
            </div>

            <div class="ecolap-cards-grid">
                <?php foreach ($guias as $guia): ?>
                    <div class="ecolap-card">
                        <div class="ecolap-card-icon"><?php echo $guia['icono']; ?></div>
                        <h3><?php echo htmlspecialchars($guia['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($guia['descripcion']); ?></p>

                        <ul style="margin-bottom: 22px; padding-left: 20px; list-style: disc; color: var(--ecolap-gris-texto); font-size: 0.9rem;">
                            <?php foreach ($guia['temas'] as $tema): ?>
                                <li><?php echo htmlspecialchars($tema); ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="<?php echo htmlspecialchars($guia['url']); ?>" target="_blank" rel="noopener noreferrer" class="ecolap-card-link">
                            <?php echo htmlspecialchars($guia['texto_link']); ?>
                            <span>↗</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         SECCIÓN DE RECURSOS RECOMENDADOS
         ========================================================== -->
    <section class="ecolap-section ecolap-games" id="recursos">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Fuentes oficiales ECOLAP</span>
                <h2 class="ecolap-section-title">Recursos Recomendados por ECOLAP</h2>
                <p class="ecolap-section-subtitle">Enlaces verificados a ministerios, organismos internacionales y entidades especializadas en medio ambiente y reciclaje.</p>
            </div>

            <div class="ecolap-cards-grid">
                <?php foreach ($recursos as $recurso): ?>
                    <div class="ecolap-card">
                        <div class="ecolap-card-icon"><?php echo $recurso['icono']; ?></div>
                        <h3><?php echo htmlspecialchars($recurso['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($recurso['descripcion']); ?></p>
                        <a href="<?php echo htmlspecialchars($recurso['url']); ?>" target="_blank" rel="noopener noreferrer" class="ecolap-card-link">
                            <?php echo htmlspecialchars($recurso['texto_link']); ?>
                            <span>↗</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         SECCIÓN DE DATOS CURIOSOS ECOLAP
         ========================================================== -->
    <section class="ecolap-section" id="datos-ecolap">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Sabías que...</span>
                <h2 class="ecolap-section-title">Datos que ECOLAP quiere compartir</h2>
                <p class="ecolap-section-subtitle">Información verificada que demuestra el impacto real del reciclaje en nuestro planeta.</p>
            </div>

            <div class="ecolap-hero-stats">
                <?php foreach ($datos_curiosos as $dato): ?>
                    <div class="ecolap-stat-card">
                        <div class="ecolap-stat-icon"><?php echo $dato['icono']; ?></div>
                        <div class="ecolap-stat-number"><?php echo htmlspecialchars($dato['numero']); ?></div>
                        <div class="ecolap-stat-label"><?php echo htmlspecialchars($dato['etiqueta']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         FOOTER / PIE DE PÁGINA ECOLAP
         ========================================================== -->
    <footer class="ecolap-footer">
        <div class="container">
            <div class="ecolap-footer-content">
                <div class="ecolap-footer-brand">
                    <a href="index.php" class="ecolap-logo">
                        <div class="ecolap-logo-icon"><img src="<?php echo $logo_path; ?>" alt="Logo ECOLAP" class="ecolap-logo-img"></div>
                        <div class="ecolap-logo-text">ECO<span>LAP</span></div>
                    </a>
                    <p>ECOLAP es la plataforma líder en gestión e incentivo del reciclaje. Transformamos comunidades a través de la innovación verde y la tecnología sostenible.</p>
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
                        <li><a href="#guias">Guías ECOLAP</a></li>
                        <li><a href="#recursos">Manuales</a></li>
                        <li><a href="#datos-ecolap">Investigación</a></li>
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
                <p>© <?php echo $current_year; ?> <span>ECOLAP</span>. Todos los derechos reservados. Plataforma oficial de gestión ambiental.</p>
                <p>Desarrollado con 💚 para la <span>propuesta oficial ECOLAP</span></p>
            </div>
        </div>
    </footer>

    <!-- ==========================================================
         SCRIPT JAVASCRIPT compartido (app.js)
         ========================================================== -->
    <script src="app.js?v=<?php echo file_exists('app.js') ? filemtime('app.js') : time(); ?>"></script>
</body>

</html>