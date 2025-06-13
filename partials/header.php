<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nomad Outdoor - Exploración sin límites</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
  <!-- Header -->
  <header class="main-header">
    <div class="container">
      <div class="header-content">
        <a href="index.php" class="brand-logo">
          <i class="fas fa-mountain"></i>
          Nomad Outdoor
        </a>
        
        <nav class="main-nav">
          <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Inicio</a>
          <a href="inicio.php" class="<?= basename($_SERVER['PHP_SELF']) == 'inicio.php' ? 'active' : '' ?>">Explorar</a>
          <a href="productos.php" class="<?= basename($_SERVER['PHP_SELF']) == 'productos.php' ? 'active' : '' ?>">Productos</a>
          <a href="contacto.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contacto.php' ? 'active' : '' ?>">Contacto</a>
          <a href="blog.php">Blog</a>
        </nav>
        
        <div class="nav-actions">
          <form class="search-form" action="productos.php" method="GET">
            <input type="text" name="busqueda" placeholder="Buscar aventuras...">
            <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
          </form>
          <a href="carrito.php" class="cart-btn">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
          </a>
          <?php if(isset($_SESSION['usuario_id'])): ?>
            <a href="perfil.php" class="user-btn">
              <i class="fas fa-user"></i>
            </a>
          <?php else: ?>
            <a href="login.php" class="btn btn-outline">Ingresar</a>
          <?php endif; ?>
        </div>
        
        <button class="mobile-menu-btn">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>
  
  <div class="mobile-menu">
    <a href="index.php">Inicio</a>
    <a href="inicio.php">Explorar</a>
    <a href="productos.php">Productos</a>
    <a href="contacto.php">Contacto</a>
    <a href="blog.php">Blog</a>
    <?php if(isset($_SESSION['usuario_id'])): ?>
      <a href="perfil.php">Mi Cuenta</a>
      <a href="logout.php">Cerrar Sesión</a>
    <?php else: ?>
      <a href="login.php">Iniciar Sesión</a>
    <?php endif; ?>
  </div>