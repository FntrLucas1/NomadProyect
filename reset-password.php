<?php
require_once 'config/database.php';
include 'partials/header.php';

if(isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit();
}

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

if(empty($token)) {
    header("Location: recuperar.php");
    exit();
}

// Verificar token
$query = "SELECT id FROM usuarios WHERE token_reset_password = ? AND token_expira > NOW()";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0) {
    $error = "El enlace de recuperación es inválido o ha expirado.";
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $usuario = $result->fetch_assoc();
        $usuario_id = $usuario['id'];
        
        // Actualizar contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE usuarios SET password = ?, token_reset_password = NULL, token_expira = NULL WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("si", $hashed_password, $usuario_id);
        
        if($update_stmt->execute()) {
            $success = "Contraseña actualizada correctamente. Ahora puedes iniciar sesión.";
        } else {
            $error = "Error al actualizar la contraseña. Inténtalo de nuevo.";
        }
    }
}
?>

<section class="reset-password-section">
  <h2>Restablecer Contraseña</h2>
  
  <?php if($error): ?>
    <div class="alert error"><?= $error ?></div>
  <?php endif; ?>
  
  <?php if($success): ?>
    <div class="alert success"><?= $success ?></div>
    <div class="text-center">
      <a href="login.php" class="btn">Iniciar Sesión</a>
    </div>
  <?php else: ?>
    <?php if(empty($error)): ?>
      <form class="reset-password-form" method="POST">
        <div class="form-group">
          <label for="password">Nueva Contraseña</label>
          <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
          <label for="confirm_password">Confirmar Nueva Contraseña</label>
          <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit" class="btn">Restablecer Contraseña</button>
      </form>
    <?php endif; ?>
  <?php endif; ?>
</section>

<?php
include 'partials/footer.php';
?>