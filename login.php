<?php
// ==========================================================
// INICIO DE SESIÓN Y CONFIGURACIÓN PHP (login.php)
// ==========================================================
session_start();

$site_title   = "ECOLAP | Iniciar sesión";
$logo_path    = "../../../../../../Img/ecolap.png";
$mensaje      = "";
$tipo_mensaje = "";
$email_previo = $_COOKIE['ecolap_email'] ?? '';

// Cuentas demo y rutas por rol en el servidor
$cuentas_demo = [
    'admin@ecolap.com'      => ['password' => 'admin123',      'rol' => 'administrador', 'nombre' => 'Administrador ECOLAP'],
    'recolector@ecolap.com' => ['password' => 'recolector123', 'rol' => 'recolector',    'nombre' => 'Recolector ECOLAP'],
    'usuario@ecolap.com'    => ['password' => 'usuario123',    'rol' => 'usuario',       'nombre' => 'Usuario ECOLAP']
];

$rutas_por_rol = [
    'administrador' => 'panel_admin/ecolap-html/index.php',
    'admin'         => 'panel_admin/ecolap-html/index.php',
    'recolector'    => 'mapa.php',
    'conductor'     => 'mapa.php',
    'usuario'       => 'index.php'
];

// Función para determinar rol por correo si no está en las cuentas demo
function determinarRolPorCorreo(string $correo): string {
    $correoLimpio = strtolower(trim($correo));
    if (preg_match('/admin/i', $correoLimpio)) {
        return 'administrador';
    }
    if (preg_match('/recolector|conductor/i', $correoLimpio)) {
        return 'recolector';
    }
    return 'usuario';
}

// Procesar envío del formulario por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email      = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $recordarme = isset($_POST['recordarme']);
    $email_previo = $email;

    if (empty($email) || empty($password)) {
        $mensaje      = "Completa todos los campos.";
        $tipo_mensaje = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje      = "Ingresa un correo electrónico válido.";
        $tipo_mensaje = "error";
    } else {
        // Determinar rol (en producción aquí iría la consulta PDO/MySQLi a la base de datos)
        $correo_lower = strtolower($email);
        if (isset($cuentas_demo[$correo_lower])) {
            $rol    = $cuentas_demo[$correo_lower]['rol'];
            $nombre = $cuentas_demo[$correo_lower]['nombre'];
        } else {
            $rol    = determinarRolPorCorreo($correo_lower);
            $nombre = explode('@', $correo_lower)[0];
        }

        if (!isset($rutas_por_rol[$rol])) {
            $mensaje      = "No tienes un rol válido asignado. Contacta al administrador.";
            $tipo_mensaje = "error";
        } else {
            // Guardar datos en sesión PHP
            $_SESSION['usuario_ecolap'] = [
                'nombre' => $nombre,
                'correo' => $correo_lower,
                'rol'    => $rol
            ];

            // Cookie para "Recordarme" (30 días)
            if ($recordarme) {
                setcookie('ecolap_email', $correo_lower, time() + (86400 * 30), "/");
            } else {
                setcookie('ecolap_email', '', time() - 3600, "/");
            }

            // Redirigir a la ruta correspondiente al rol
            header("Location: " . $rutas_por_rol[$rol]);
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($site_title); ?></title>
    <link rel="icon" type="image/png" href="<?php echo $logo_path; ?>">

    <style>
        :root {
            --bg-1: #04140d;
            --bg-2: #06301f;
            --verde-neon: #39e58c;
            --verde-medio: #00a86b;
            --verde-oscuro: #063b29;
            --panel: rgba(6, 40, 27, 0.55);
            --panel-borde: rgba(57, 229, 140, 0.28);
            --input-bg: rgba(3, 20, 13, 0.65);
            --texto-claro: #eafff2;
            --texto-tenue: #9fc9b3;
            --error: #ff6b6b;
            --exito: #6dffb3;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background:
                radial-gradient(circle at 15% 20%, rgba(57, 229, 140, .16), transparent 40%),
                radial-gradient(circle at 85% 75%, rgba(0, 168, 107, .18), transparent 45%),
                linear-gradient(160deg, var(--bg-1), var(--bg-2));
            color: var(--texto-claro);
        }

        /* ---------- Navbar ---------- */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 42px;
            background: rgba(4, 20, 13, 0.55);
            border-bottom: 1px solid rgba(57, 229, 140, .15);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--verde-medio), var(--verde-neon));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 0 18px rgba(57, 229, 140, .5);
        }

        .brand-name {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .5px;
        }
        .brand-name span { color: var(--verde-neon); }

        .back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 999px;
            border: 1px solid var(--panel-borde);
            color: var(--texto-claro);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
            background: rgba(255, 255, 255, .02);
        }
        .back-link:hover {
            background: rgba(57, 229, 140, .1);
            border-color: var(--verde-neon);
        }

        /* ---------- Layout principal ---------- */
        .contenido {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 40px;
            max-width: 1280px;
            margin: 0 auto;
            padding: 64px 42px 80px;
            align-items: start;
        }

        /* ---------- Columna izquierda ---------- */
        .panel-izq { padding-top: 12px; }

        .globo {
            width: 92px;
            height: 92px;
            border-radius: 24px;
            background: radial-gradient(circle at 35% 30%, rgba(255,255,255,.15), transparent 60%), rgba(57, 229, 140, .12);
            border: 1px solid var(--panel-borde);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 44px;
            margin-bottom: 28px;
            box-shadow: 0 0 40px rgba(57, 229, 140, .18);
        }

        .titulo-hero {
            font-size: 44px;
            font-weight: 800;
            line-height: 1.15;
            margin: 0 0 20px;
        }
        .titulo-hero .resalte { color: var(--verde-neon); }

        .parrafo-hero {
            color: var(--texto-tenue);
            font-size: 17px;
            line-height: 1.6;
            max-width: 480px;
            margin: 0 0 36px;
        }

        /* ---------- Columna derecha: tarjeta de login ---------- */
        .panel-der {
            background: var(--panel);
            border: 1px solid var(--panel-borde);
            border-radius: 26px;
            padding: 34px;
            box-shadow: 0 25px 60px rgba(0,0,0,.45);
            backdrop-filter: blur(8px);
        }

        .tabs {
            display: flex;
            background: rgba(255,255,255,.04);
            border-radius: 999px;
            padding: 5px;
            margin-bottom: 26px;
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 14.5px;
            cursor: pointer;
            border: none;
            background: transparent;
            color: var(--texto-tenue);
            transition: .2s ease;
        }
        .tab.activo {
            background: linear-gradient(120deg, var(--verde-medio), var(--verde-neon));
            color: #063018;
            box-shadow: 0 6px 18px rgba(57, 229, 140, .35);
        }

        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px;
            border-radius: 14px;
            border: none;
            background: #fff;
            color: #1f1f1f;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: .2s ease;
        }
        .btn-google:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(0,0,0,.25); }
        .g-icon {
            font-weight: 900;
            color: #4285F4;
            font-size: 18px;
        }

        .divisor {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0;
            color: var(--texto-tenue);
            font-size: 13px;
        }
        .divisor::before, .divisor::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,.12);
        }

        .form-group { margin-bottom: 18px; text-align: left; }

        label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 8px;
            font-size: 12.5px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--verde-neon);
        }

        .input-wrap { position: relative; }

        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1.5px solid rgba(57, 229, 140, .2);
            background: var(--input-bg);
            color: var(--texto-claro);
            font-size: 15px;
            outline: none;
            transition: .2s ease;
        }
        input::placeholder { color: #5f8672; }
        input:focus {
            border-color: var(--verde-neon);
            box-shadow: 0 0 0 4px rgba(57, 229, 140, .15);
        }

        .toggle-pass {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
            opacity: .7;
            padding: 4px;
        }

        .fila-opciones {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            color: var(--texto-tenue);
            margin: 4px 0 22px;
        }

        .recordarme { display: flex; align-items: center; gap: 8px; }
        .recordarme input { width: auto; padding: 0; accent-color: var(--verde-neon); }

        .fila-opciones a { color: var(--verde-neon); text-decoration: none; font-weight: 600; }
        .fila-opciones a:hover { text-decoration: underline; }

        button.submit-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 800;
            color: #06301f;
            background: linear-gradient(120deg, var(--verde-medio), var(--verde-neon));
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 0 30px rgba(57, 229, 140, .35);
            transition: .2s ease;
        }
        button.submit-button:hover:not(:disabled) {
            filter: brightness(1.07);
            transform: translateY(-2px);
        }
        button.submit-button:disabled { opacity: .7; cursor: not-allowed; transform: none; }

        .spinner {
            width: 16px; height: 16px;
            border: 2.5px solid rgba(6,48,31,.35);
            border-top-color: #06301f;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            display: none;
        }
        .spinner.visible { display: inline-block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .message {
            min-height: 20px;
            margin-top: 14px;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
        }
        .error { color: var(--error); }
        .success { color: var(--exito); }

        .crear-cuenta {
            text-align: center;
            margin-top: 22px;
            font-size: 14px;
            color: var(--texto-tenue);
        }
        .crear-cuenta a { color: var(--verde-neon); font-weight: 700; text-decoration: none; }
        .crear-cuenta a:hover { text-decoration: underline; }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }
        .shake { animation: shake .35s; }

        /* ---------- Responsive ---------- */
        @media (max-width: 980px) {
            .contenido { grid-template-columns: 1fr; padding: 40px 24px 60px; }
            .titulo-hero { font-size: 32px; }
        }
        @media (max-width: 480px) {
            .navbar { padding: 14px 18px; }
            .panel-der { padding: 24px; }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="brand">
            <div class="brand-icon">🌱</div>
            <div class="brand-name">ECO<span>LAP</span></div>
        </div>
        <a href="index.php" class="back-link">← Volver a ECOLAP</a>
    </nav>

    <div class="contenido">
        <!-- Columna izquierda: branding -->
        <section class="panel-izq">
            <div class="globo">🌎</div>
            <h1 class="titulo-hero">Súmate al Cambio <span class="resalte">Verde</span> con ECOLAP</h1>
            <p class="parrafo-hero">
                Aprende, juega y transforma el planeta junto a una comunidad global de agentes de cambio ambiental.
            </p>
        </section>

        <!-- Columna derecha: formulario -->
        <section class="panel-der <?php echo ($tipo_mensaje === 'error') ? 'shake' : ''; ?>">
            <div class="tabs">
                <button class="tab activo" id="tabLogin" type="button">Iniciar Sesión</button>
                <button class="tab" id="tabRegistro" type="button">Registrarse</button>
            </div>

            <button type="button" class="btn-google" id="btnGoogle">
                <span class="g-icon">G</span> Continuar con Google
            </button>

            <div class="divisor">O ingresa con tu cuenta</div>

            <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
                <div class="form-group">
                    <label for="email">✉️ Correo electrónico</label>
                    <div class="input-wrap">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?php echo htmlspecialchars($email_previo); ?>"
                            placeholder="tu@correo.com"
                            autocomplete="email"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">🔒 Contraseña</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                            style="padding-right: 42px;"
                        >
                        <button type="button" class="toggle-pass" id="togglePass" aria-label="Mostrar contraseña">👁️</button>
                    </div>
                </div>

                <div class="fila-opciones">
                    <label class="recordarme" for="recordarme" style="text-transform:none;font-weight:500;letter-spacing:0;color:var(--texto-tenue);">
                        <input type="checkbox" id="recordarme" name="recordarme" <?php echo !empty($email_previo) ? 'checked' : ''; ?>> Recordarme
                    </label>
                    <a href="recuperar.php">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="submit-button" id="submitButton">
                    <span class="spinner" id="spinner"></span>
                    <span id="submitText">Iniciar Sesión en ECOLAP</span>
                </button>

                <div id="message" class="message <?php echo htmlspecialchars($tipo_mensaje); ?>" role="status">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            </form>

            <div class="crear-cuenta">
                ¿No tienes cuenta? <a href="registro.php">Crea una cuenta ECOLAP</a>
            </div>
        </section>
    </div>

    <script>
        // ---------- Tabs ----------
        document.getElementById('tabRegistro').addEventListener('click', () => {
            window.location.href = 'registro.php';
        });

        // ---------- Mostrar/ocultar contraseña ----------
        const passwordInput = document.getElementById('password');
        const togglePass = document.getElementById('togglePass');
        togglePass.addEventListener('click', () => {
            const visible = passwordInput.type === 'text';
            passwordInput.type = visible ? 'password' : 'text';
            togglePass.textContent = visible ? '👁️' : '🙈';
        });

        // ---------- Google (decorativo por ahora) ----------
        const message = document.getElementById('message');
        document.getElementById('btnGoogle').addEventListener('click', () => {
            message.textContent = 'El inicio de sesión con Google estará disponible pronto.';
            message.className = 'message error';
        });

        // ---------- Indicador visual al enviar formulario ----------
        const loginForm = document.getElementById('loginForm');
        const submitButton = document.getElementById('submitButton');
        const submitText = document.getElementById('submitText');
        const spinner = document.getElementById('spinner');

        loginForm.addEventListener('submit', () => {
            submitButton.disabled = true;
            spinner.classList.add('visible');
            submitText.textContent = 'Verificando...';
        });
    </script>
</body>
</html>