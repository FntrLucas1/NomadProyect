<?php
include 'partials/header.php';
?>

<!-- Hero Section - Inicio -->
<section class="hero-section" style="background: linear-gradient(rgba(13, 27, 42, 0.8), rgba(13, 27, 42, 0.8)), url('assets/images/aventura.jpg') center/cover;">
  <div class="container">
    <div class="hero-content">
      <h1 class="hero-title">Vive la Aventura</h1>
      <p class="hero-subtitle">Descubre lugares increíbles con nuestro equipamiento de alto rendimiento</p>
      <div class="hero-cta">
        <a href="productos.php" class="btn btn-primary">Ver Catálogo</a>
        <a href="#destacados" class="btn btn-outline">Productos Destacados</a>
      </div>
    </div>
  </div>
</section>

<!-- Featured Products - Inicio -->
<section class="container" id="destacados">
  <div class="section-title">
    <h2>Productos Destacados</h2>
  </div>
  
  <div class="products-grid">
    <?php
    require_once 'config/database.php';
    $destacados = $conn->query("SELECT p.*, c.nombre as categoria_nombre 
                               FROM productos p
                               JOIN categorias c ON p.categoria_id = c.id
                               WHERE p.destacado = 1 LIMIT 6");
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

<!-- Blog Preview Section -->
<section class="features-section">
  <div class="container">
    <div class="section-title">
      <h2>Consejos de Aventura</h2>
    </div>
    
    <div class="features-grid">
      <!-- Artículos del blog -->
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-hiking"></i>
        </div>
        <h3 class="feature-title">Preparando tu Primera Excursión</h3>
        <p class="feature-description">Guía completa para principiantes que quieren comenzar en el senderismo.</p>
        <a href="blog.php#articulo1" class="read-more">Leer más</a>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-campground"></i>
        </div>
        <h3 class="feature-title">Mejores Lugares para Acampar</h3>
        <p class="feature-description">Descubre los parques nacionales más impresionantes para tu próxima aventura.</p>
        <a href="blog.php#articulo2" class="read-more">Leer más</a>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-snowflake"></i>
        </div>
        <h3 class="feature-title">Equipamiento para Clima Frío</h3>
        <p class="feature-description">Todo lo que necesitas para mantenerte cálido en condiciones extremas.</p>
        <a href="blog.php#articulo3" class="read-more">Leer más</a>
      </div>
    </div>
    
    <div class="text-center" style="margin-top: 40px;">
      <a href="blog.php" class="btn btn-primary">Ver Más Consejos</a>
    </div>
  </div>
</section>

<?php
include 'partials/footer.php';
?>