<?php
// ==========================================================
// CONFIGURACIÓN Y DATOS DINÁMICOS DE LA PÁGINA (juegos.php)
// ==========================================================
$site_title       = "Juegos Eco | ECOLAP - Aprende Jugando";
$site_description = "ECOLAP Games: minijuegos interactivos para aprender sobre reciclaje mientras te diviertes. Fast-Sorter, Misión Urbana y más.";
$site_keywords    = "ECOLAP, juegos, reciclar, aprender jugando, Fast-Sorter, Misión Urbana, eco gaming";
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

// Catálogo de juegos ECOLAP
$juegos = [
    [
        'etiqueta'        => 'Nuevo',
        'emoji'           => '⚡',
        'titulo'          => 'ECOLAP Fast-Sorter',
        'descripcion'     => 'Clasifica la basura antes de que se agote el tiempo. Demuestra tus reflejos separando residuos en el contenedor correcto y alcanza el ranking más alto de ECOLAP.',
        'caracteristicas' => [
            '3 niveles de dificultad',
            'Sistema de puntuación',
            'Ranking online ECOLAP'
        ],
        'url'             => 'https://www.cokitos.com/reciclar-basura/play/'
    ],
    [
        'etiqueta'        => 'Popular',
        'emoji'           => '🚛',
        'titulo'          => 'Misión Reciclaje Urbano',
        'descripcion'     => 'Limpia la ciudad virtual recogiendo residuos con el camión ECOLAP. Completa rutas verdes, evita obstáculos y ayuda a mantener tu comunidad 100% limpia y sostenible.',
        'caracteristicas' => [
            'Conduce el camión ECOLAP',
            '10 misiones urbanas',
            'Modo multijugador'
        ],
        'url'             => 'https://www.google.com/doodles'
    ],
    [
        'etiqueta'        => 'Educativo',
        'emoji'           => '🧠',
        'titulo'          => 'ECOLAP Quiz Ambiental',
        'descripcion'     => 'Pon a prueba tus conocimientos sobre reciclaje, sostenibilidad y cambio climático. Responde preguntas, gana insignias ECOLAP y demuestra que eres un experto ambiental.',
        'caracteristicas' => [
            '+200 preguntas ECOLAP',
            'Sistema de insignias',
            'Categorías temáticas'
        ],
        'url'             => 'https://www.kahoot.com/'
    ],
    [
        'etiqueta'        => 'Relajado',
        'emoji'           => '🌳',
        'titulo'          => 'ECOLAP Plant Forest',
        'descripcion'     => 'Recicla en el juego y planta árboles virtuales en tiempo real. Cada acción dentro de ECOLAP Plant Forest se convierte en un árbol real plantado en alianza con ONGs ambientales.',
        'caracteristicas' => [
            'Simulador de bosque',
            'Impacto real ambiental',
            'Eventos especiales'
        ],
        'url'             => 'https://www.miniclip.com/games'
    ]
];

// Pasos de la sección "¿Cómo jugar?"
$pasos_juego = [
    [
        'icono'       => '1️⃣',
        'titulo'      => 'Crea tu cuenta ECOLAP',
        'descripcion' => 'Regístrate gratis en ECOLAP con tu correo electrónico. Solo te tomará un minuto y desbloqueas tu perfil de jugador ambiental.'
    ],
    [
        'icono'       => '2️⃣',
        'titulo'      => 'Elige tu juego favorito',
        'descripcion' => 'Explora el catálogo ECOLAP Games y selecciona el minijuego que más te guste. Cada juego tiene niveles y retos diferentes.'
    ],
    [
        'icono'       => '3️⃣',
        'titulo'      => 'Juega y aprende',
        'descripcion' => 'Diviértete mientras aprendes sobre reciclaje. Cada partida en ECOLAP te acerca a ser un agente de cambio ambiental certificado.'
    ],
    [
        'icono'       => '4️⃣',
        'titulo'      => 'Sube en el ranking ECOLAP',
        'descripcion' => 'Compite con la comunidad ECOLAP, gana insignias y desbloquea logros especiales. ¡Tu impacto ambiental también se mide en el juego!'
    ]
];

// Estadísticas de logros y ranking
$logros_stats = [
    ['icono' => '🏆', 'numero' => '+50',    'etiqueta' => 'Insignias ECOLAP disponibles'],
    ['icono' => '⭐', 'numero' => 'Top 10', 'etiqueta' => 'Ranking semanal ECOLAP'],
    ['icono' => '🎁', 'numero' => '+100',   'etiqueta' => 'Recompensas desbloqueables'],
    ['icono' => '🌍', 'numero' => '+10K',   'etiqueta' => 'Jugadores activos ECOLAP']
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

    <!-- Carga de Google Fonts: Montserrat y Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon oficial ECOLAP -->
    <link rel="icon" type="image/png" href="<?php echo $logo_path; ?>">
    <link rel="apple-touch-icon" href="<?php echo $logo_path; ?>">

    <!-- Hoja de estilos externa con control de caché -->
    <link rel="stylesheet" href="styles.css?v=<?php echo file_exists('styles.css') ? filemtime('styles.css') : time(); ?>">
</head>

<body>

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
         ENCABEZADO LLAMATIVO - ECOLAP GAMES
         ========================================================== -->
    <section class="ecolap-hero" id="inicio-juegos">
        <div class="container">
            <div class="ecolap-hero-content" style="grid-template-columns: 1fr; text-align: center;">
                <div class="ecolap-hero-text">
                    <div class="ecolap-badge">
                        <span class="ecolap-badge-dot"></span>
                        ECOLAP Games Online
                    </div>

                    <h1>ECOLAP <span>Games</span>: Aprende Jugando por el Planeta</h1>

                    <p style="max-width: 720px; margin: 0 auto 30px;">
                        Demuestra tus reflejos, limpia la ciudad y compite en el ranking ECOLAP. Cada partida es una lección ambiental divertida que transforma el mundo.
                    </p>

                    <div class="ecolap-hero-buttons" style="justify-content: center;">
                        <a href="#catalogo-juegos" class="ecolap-btn-primary">
                            Jugar Ahora
                            <span>🎮</span>
                        </a>
                        <a href="#como-jugar" class="ecolap-btn-secondary">
                            ¿Cómo funciona?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         CATÁLOGO DE JUEGOS ECOLAP
         ========================================================== -->
    <section class="ecolap-section" id="catalogo-juegos">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Minijuegos interactivos</span>
                <h2 class="ecolap-section-title">Catálogo ECOLAP Games</h2>
                <p class="ecolap-section-subtitle">Selecciona un juego y empieza tu aventura ecológica. Todos los juegos ECOLAP son gratuitos y 100% en línea.</p>
            </div>

            <div class="ecolap-games-grid">
                <?php foreach ($juegos as $juego): ?>
                    <div class="ecolap-game-card">
                        <div class="ecolap-game-image">
                            <span class="ecolap-game-badge"><?php echo htmlspecialchars($juego['etiqueta']); ?></span>
                            <div class="ecolap-game-emoji"><?php echo $juego['emoji']; ?></div>
                        </div>

                        <div class="ecolap-game-content">
                            <h3><?php echo htmlspecialchars($juego['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($juego['descripcion']); ?></p>

                            <ul>
                                <?php foreach ($juego['caracteristicas'] as $caracteristica): ?>
                                    <li><?php echo htmlspecialchars($caracteristica); ?></li>
                                <?php endforeach; ?>
                            </ul>

                            <a href="<?php echo htmlspecialchars($juego['url']); ?>" target="_blank" rel="noopener noreferrer" class="ecolap-game-btn">
                                Jugar Ahora 🎮
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         SECCIÓN "CÓMO FUNCIONA" - INSTRUCCIONES
         ========================================================== -->
    <section class="ecolap-section" id="como-jugar">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Guía rápida ECOLAP</span>
                <h2 class="ecolap-section-title">¿Cómo jugar en ECOLAP?</h2>
                <p class="ecolap-section-subtitle">Sigue estos 4 pasos para empezar tu aventura en los juegos interactivos de ECOLAP.</p>
            </div>

            <div class="ecolap-cards-grid">
                <?php foreach ($pasos_juego as $paso): ?>
                    <div class="ecolap-card">
                        <div class="ecolap-card-icon"><?php echo $paso['icono']; ?></div>
                        <h3><?php echo htmlspecialchars($paso['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($paso['descripcion']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ==========================================================
         SECCIÓN DE LOGROS Y RANKING
         ========================================================== -->
    <section class="ecolap-section" id="logros">
        <div class="container">
            <div class="ecolap-section-header">
                <span class="ecolap-section-tag">Sistema de progresión ECOLAP</span>
                <h2 class="ecolap-section-title">Logros y Ranking ECOLAP</h2>
                <p class="ecolap-section-subtitle">Cada partida suma puntos, insignias y niveles en tu perfil de jugador ambiental ECOLAP.</p>
            </div>

            <div class="ecolap-hero-stats">
                <?php foreach ($logros_stats as $stat): ?>
                    <div class="ecolap-stat-card">
                        <div class="ecolap-stat-icon"><?php echo $stat['icono']; ?></div>
                        <div class="ecolap-stat-number"><?php echo htmlspecialchars($stat['numero']); ?></div>
                        <div class="ecolap-stat-label"><?php echo htmlspecialchars($stat['etiqueta']); ?></div>
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
                        <li><a href="aprende.php#guias">Guías ECOLAP</a></li>
                        <li><a href="#como-jugar">Tutoriales</a></li>
                        <li><a href="#logros">Ranking</a></li>
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