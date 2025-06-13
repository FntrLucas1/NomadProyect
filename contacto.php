<?php
include 'partials/header.php';

$mensaje_exito = '';
$errores = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $asunto = $_POST['asunto'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    
    // Validación
    if(empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }
    
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Ingrese un correo electrónico válido";
    }
    
    if(empty($asunto)) {
        $errores[] = "El asunto es obligatorio";
    }
    
    if(empty($mensaje)) {
        $errores[] = "El mensaje es obligatorio";
    }
    
    if(empty($errores)) {
        // Guardar en base de datos (simulado)
        $mensaje_exito = "¡Gracias por contactarnos! Hemos recibido tu mensaje y te responderemos pronto.";
        
        // Aquí iría el código para guardar en la base de datos
        // $query = "INSERT INTO mensajes_contacto (nombre, email, asunto, mensaje) VALUES (?, ?, ?, ?)";
        // ...
    }
}
?>

<!-- Hero Section - Contacto -->
<section class="hero-section" style="background: linear-gradient(rgba(13, 27, 42, 0.8), rgba(13, 27, 42, 0.8)), url('assets/images/contact-bg.jpg') center/cover;">
  <div class="container">
    <div class="hero-content">
      <h1 class="hero-title">Contáctanos</h1>
      <p class="hero-subtitle">Estamos aquí para ayudarte en tu próxima aventura</p>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
  <div class="container">
    <?php if($mensaje_exito): ?>
      <div class="alert success">
        <i class="fas fa-check-circle"></i>
        <?= $mensaje_exito ?>
      </div>
    <?php endif; ?>
    
    <?php if(!empty($errores)): ?>
      <div class="alert error">
        <i class="fas fa-exclamation-circle"></i>
        <ul>
          <?php foreach($errores as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    
    <div class="contact-container">
      <div class="contact-info">
        <h2 class="contact-title">¿Cómo podemos ayudarte?</h2>
        <p class="contact-description">¿Tienes preguntas sobre nuestros productos o necesitas asesoramiento para tu próxima aventura? Nuestro equipo está listo para ayudarte.</p>
        
        <div class="contact-methods">
          <div class="contact-method">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-text">
              <h4>Nuestra Ubicación</h4>
              <p>Av. Aventura 123, Montaña City</p>
            </div>
          </div>
          
          <div class="contact-method">
            <div class="contact-icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div class="contact-text">
              <h4>Teléfono</h4>
              <p>+1 (123) 456-7890</p>
            </div>
          </div>
          
          <div class="contact-method">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-text">
              <h4>Email</h4>
              <p>info@nomadoutdoor.com</p>
            </div>
          </div>
          
          <div class="contact-method">
            <div class="contact-icon">
              <i class="fas fa-clock"></i>
            </div>
            <div class="contact-text">
              <h4>Horario de Atención</h4>
              <p>Lunes a Viernes: 9am - 6pm</p>
              <p>Sábados: 10am - 4pm</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="contact-form">
        <form method="POST">
          <div class="form-group">
            <label for="name">Nombre Completo *</label>
            <input type="text" id="name" name="nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
          </div>
          
          <div class="form-group">
            <label for="email">Correo Electrónico *</label>
            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
          </div>
          
          <div class="form-group">
            <label for="subject">Asunto *</label>
            <input type="text" id="subject" name="asunto" required value="<?= htmlspecialchars($_POST['asunto'] ?? '') ?>">
          </div>
          
          <div class="form-group">
            <label for="message">Mensaje *</label>
            <textarea id="message" name="mensaje" required><?= htmlspecialchars($_POST['mensaje'] ?? '') ?></textarea>
          </div>
          
          <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Map Section -->
<section class="map-section">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.952912260219!2d3.375295414770757!3d6.527631524025064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1567723392506!5m2!1sen!2sng" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</section>

<?php
include 'partials/footer.php';
?>