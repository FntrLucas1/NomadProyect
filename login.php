<?php
include 'partials/header.php';

if(isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Aquí iría la validación de credenciales
    $usuario_valido = true; // Simulación
    
    if($usuario_valido) {
        $_SESSION['usuario_id'] = 1; // ID de usuario simulado
        $_SESSION['usuario_nombre'] = "Nombre Usuario";
        header("Location: perfil.php");
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<section class="login-section">
  <h2>Iniciar Sesión</h2>
  
  <?php if(isset($error)): ?>
    <div class="alert error"><?= $error ?></div>
  <?php endif; ?>
  
  <form class="login-form" method="POST">
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="email" id="email" name="email" required>
    </div>
    
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required>
    </div>
    
    <button type="submit" class="btn">Ingresar</button>
    
    <div class="login-links">
      <a href="registro.php">¿No tienes cuenta? Regístrate</a>
      <a href="recuperar.php">¿Olvidaste tu contraseña?</a>
    </div>
  </form>
</section>

<?php
include 'partials/footer.php';
?>