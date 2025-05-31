<?php
session_start();
include("conexion.php");

// =============== INICIO DE SESIÓN ===============
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correo'], $_POST['contrasena']) && !isset($_POST['nombre'])) {
    $correo = trim($_POST['correo']);
    $clave = $_POST['contrasena'];

    // Buscar usuario por correo
    $stmt = $conn->prepare("SELECT id, nombre, correo, clave FROM usuarios WHERE correo = ?");
    if (!$stmt) {
        die("Error en la consulta de login: " . $conn->error);
    }

    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($clave, $usuario['clave'])) {
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['usuario_id'] = $usuario['id']; // guardamos el ID para usarlo en recomendaciones

        // Mostrar selección de emoción
        echo '
        <style>
            .overlay {
                position: fixed;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background: rgba(0, 0, 0, 0.6);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
            }

            .modal {
                background: #fff;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                max-width: 400px;
                width: 90%;
                box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            }

            .modal h3 {
                margin-bottom: 15px;
                font-size: 20px;
            }

            .emoji-button {
                font-size: 30px;
                padding: 10px 15px;
                margin: 5px;
                border: none;
                background: transparent;
                cursor: pointer;
                transition: transform 0.2s;
            }

            .emoji-button:hover {
                transform: scale(1.3);
            }
        </style>

        <div class="overlay" id="emotionOverlay">
            <div class="modal">
                <h3>"Dinos cómo te sientes… y déjanos ofrecerte lecturas que comprendan tu alma."</h3>
                <button class="emoji-button" onclick="selectEmotion(\'😄 Alegría\')">😄</button>
                <button class="emoji-button" onclick="selectEmotion(\'😢 Tristeza\')">😢</button>
                <button class="emoji-button" onclick="selectEmotion(\'😠 Ira\')">😠</button>
                <button class="emoji-button" onclick="selectEmotion(\'😨 Miedo\')">😨</button>
                <button class="emoji-button" onclick="selectEmotion(\'😲 Sorpresa\')">😲</button>
                <button class="emoji-button" onclick="selectEmotion(\'😐 Neutral\')">😐</button>
                <button class="emoji-button" onclick="selectEmotion(\'🤢 Asco\')">🤢</button>
            </div>
        </div>

        <script>
            function selectEmotion(emocion) {
                fetch("guardar_emocion.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "emocion=" + encodeURIComponent(emocion)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "ok") {
                        alert("Gracias por compartir tu emoción: " + emocion);
                        document.getElementById("emotionOverlay").style.display = "none";
                        setTimeout(function() {
                            window.location.href = "categorias.php";
                        }, 1000);
                    } else {
                        alert("Error al guardar la emoción.");
                    }
                })
                .catch(error => {
                    alert("Error de red al guardar la emoción.");
                });
            }
        </script>
        ';

        exit;
    } else {
        echo "<script>
            alert('❌ Correo o contraseña incorrectos');
            window.location.href = 'login.php';
        </script>";
        exit;
    }
}

// =============== REGISTRO ===============
if (isset($_POST['nombre'], $_POST['correo'], $_POST['clave'], $_POST['confirmar_clave'], $_POST['genero1'])) {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $clave = $_POST['clave'];
    $clave2 = $_POST['confirmar_clave'];
    $genero_uno = $_POST['genero1'];
    $genero_dos = $_POST['genero2'] ?? null;

    if ($clave !== $clave2) {
        echo "<script>
            alert('⚠️ Las contraseñas no coinciden');
            window.location.href = 'registro.php';
        </script>";
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('⚠️ El correo no es válido');
            window.location.href = 'registro.php';
        </script>";
        exit;
    }

    $verificar = $conn->prepare("SELECT correo FROM usuarios WHERE correo = ?");
    if (!$verificar) {
        die("Error al verificar el correo: " . $conn->error);
    }

    $verificar->bind_param("s", $correo);
    $verificar->execute();
    $verificar->store_result();

    if ($verificar->num_rows > 0) {
        echo "<script>
            alert('⚠️ Este correo ya está registrado');
            window.location.href = 'registro.php';
        </script>";
        exit;
    }
    $verificar->close();

    $clave_segura = password_hash($clave, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (correo, clave, nombre, genero_uno, genero_dos) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparando consulta de registro: " . $conn->error);
    }

    $stmt->bind_param("sssss", $correo, $clave_segura, $nombre, $genero_uno, $genero_dos);

    if ($stmt->execute()) {
        echo "<script>
            alert('✅ Usuario registrado exitosamente');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Error al registrar usuario');
            window.location.href = 'registro.php';
        </script>";
    }

    exit;
}

// =============== PETICIÓN INVÁLIDA ===============
echo "<script>
    alert('⚠️ Petición inválida');
    window.location.href = 'login.php';
</script>";
exit;
?>
