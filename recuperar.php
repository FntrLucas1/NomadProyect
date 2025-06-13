<?php
include 'partials/header.php';

if(isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit();
}

$mensaje = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    // Verificar si el email existe
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Generar token
        $token = bin2hex(random_bytes(32));
        $expira = date("Y-m-d H:i:s", strtotime('+1 hour'));
        
        $usuario = $result->fetch_assoc();
        $usuario_id = $usuario['id'];
        
        // Guardar token en la base de datos
        $update_query = "UPDATE usuarios SET token_reset_password = ?, token_expira = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssi", $token, $expira, $usuario_id);
        
        if($update_stmt->execute()) {
            // Enviar email (simulado)
            $reset_link = "http://localhost/nomad-outdoor/reset-password.php?token=$token";
            $mensaje = "Se ha enviado un enlace de recuperación a tu correo.";
        } else {
            $error = "Error al procesar la solicitud. Inténtalo de nuevo.";
        }
    } else {
        $error = "No existe una cuenta con ese correo electrónico.";
    }
}
?>

<section class="recovery-section">
  <h2>Recuperar Contraseña</h2>
  
  <?php if($mensaje): ?>
    <div class="alert success"><?= $mensaje ?></div>
  <?php endif; ?>
  
  <?php if($error): ?>
    <div class="alert error"><?= $error ?></div>
  <?php endif; ?>
  
  <form class="recovery-form" method="POST">
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="email" id="email" name="email" required>
    </div>
    
    <button type="submit" class="btn">Enviar Enlace de Recuperación</button>
  </form>
  
  <div class="login-links">
    <a href="login.php">Volver a Iniciar Sesión</a>
  </div>
</section>

<?php
include 'partials/footer.php';
?>