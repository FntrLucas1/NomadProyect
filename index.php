<?php
include 'partials/header.php';
?>

<!-- Hero Section - Index -->
<section class="hero-section">
  <div class="container">
    <div class="hero-content">
      <h1 class="hero-title">Explora sin límites</h1>
      <p class="hero-subtitle">Equipamiento profesional para las aventuras más extremas</p>
      <div class="hero-cta">
        <a href="inicio.php" class="btn btn-primary">Descubrir Productos</a>
        <a href="contacto.php" class="btn btn-outline">Contactar Ahora</a>
      </div>
    </div>
  </div>
</section>

<!-- Featured Products - Index -->
<section class="container">
  <div class="section-title">
    <h2>Equipamiento Destacado</h2>
  </div>
  
  <div class="products-grid">
    <?php
    require_once 'config/database.php';
    $destacados = $conn->query("SELECT p.*, c.nombre as categoria_nombre 
                               FROM productos p
                               JOIN categorias c ON p.categoria_id = c.id
                               WHERE p.destacado = 1 LIMIT 3");
    while($producto = $destacados->fetch_assoc()):
    ?>
      <div class="product-card">
        <?php if($producto['precio_oferta']): ?>
          <span class="product-badge">Oferta</span>
        <?php endif; ?>
        <img src="assets/images/products/<?= $producto['imagen_principal'] ?>" alt="<?= $producto['nombre'] ?>" class="product-image">
        <div class="product-info">
          <span class="product-category"><?= strtoupper($producto['categoria_nombre']) ?></span>
          <h3 class="product-name"><?= $producto['nombre'] ?></h3>
          <p class="product-description"><?= $producto['descripcion_corta'] ?></p>
          <div class="product-footer">
            <div class="product-price">
              <?php if($producto['precio_oferta']): ?>
                <span class="original-price">$<?= number_format($producto['precio'], 2) ?></span>
                <span>$<?= number_format($producto['precio_oferta'], 2) ?></span>
              <?php else: ?>
                $<?= number_format($producto['precio'], 2) ?>
              <?php endif; ?>
            </div>
            <button class="add-to-cart" data-id="<?= $producto['id'] ?>"><i class="fas fa-plus"></i></button>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<!-- Features Section - Index -->
<section class="features-section">
  <div class="container">
    <div class="section-title">
      <h2>Por Qué Elegirnos</h2>
    </div>
    
    <div class="features-grid">
      <div class="feature-card floating">
        <div class="feature-icon">
          <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="feature-title">Calidad Garantizada</h3>
        <p class="feature-description">Todos nuestros productos pasan rigurosas pruebas en condiciones extremas para garantizar su durabilidad.</p>
      </div>
      
      <div class="feature-card floating" style="animation-delay: 0.5s;">
        <div class="feature-icon">
          <i class="fas fa-truck"></i>
        </div>
        <h3 class="feature-title">Envío Rápido</h3>
        <p class="feature-description">Recibe tu equipo en 24-48 horas para que nada te detenga en tu próxima aventura.</p>
      </div>
      
      <div class="feature-card floating" style="animation-delay: 1s;">
        <div class="feature-icon">
          <i class="fas fa-leaf"></i>
        </div>
        <h3 class="feature-title">Sostenibilidad</h3>
        <p class="feature-description">Materiales ecológicos y procesos responsables con el medio ambiente.</p>
      </div>
      
      <div class="feature-card floating" style="animation-delay: 1.5s;">
        <div class="feature-icon">
          <i class="fas fa-headset"></i>
        </div>
        <h3 class="feature-title">Soporte Experto</h3>
        <p class="feature-description">Nuestro equipo de expertos está disponible para asesorarte en cualquier momento.</p>
      </div>
    </div>
  </div>
</section>

<?php
include 'partials/footer.php';
?>