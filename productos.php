<?php
include 'partials/header.php';
require_once 'config/database.php';

// Manejar filtros
$categoria_filtro = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Construir consulta
$query = "SELECT p.*, c.nombre AS categoria_nombre 
          FROM productos p 
          JOIN categorias c ON p.categoria_id = c.id
          WHERE 1";

if ($categoria_filtro != 'todos') {
  $query .= " AND c.nombre = '$categoria_filtro'";
}

if (!empty($busqueda)) {
  $query .= " AND (p.nombre LIKE '%$busqueda%' OR p.descripcion LIKE '%$busqueda%')";
}

$productos = $conn->query($query);

// Obtener categorías para el filtro
$categorias = $conn->query("SELECT * FROM categorias");
?>

<!-- Hero Section - Productos -->
<section class="hero-section" style="background: linear-gradient(rgba(13, 27, 42, 0.8), rgba(13, 27, 42, 0.8)), url('assets/images/products-bg.jpg') center/cover;">
  <div class="container">
    <div class="hero-content">
      <h1 class="hero-title">Nuestro Equipamiento</h1>
      <p class="hero-subtitle">Todo lo que necesitas para tus aventuras</p>
    </div>
  </div>
</section>

<!-- Products Section -->
<section class="container">
  <div class="section-title">
    <h2>Explora Nuestros Productos</h2>
  </div>
  
  <!-- Filtros -->
  <div class="products-filter">
    <a href="?categoria=todos" class="filter-btn <?= $categoria_filtro == 'todos' ? 'active' : '' ?>">Todos</a>
    <?php while($categoria = $categorias->fetch_assoc()): ?>
      <a href="?categoria=<?= urlencode($categoria['nombre']) ?>" class="filter-btn <?= $categoria_filtro == $categoria['nombre'] ? 'active' : '' ?>">
        <?= $categoria['nombre'] ?>
      </a>
    <?php endwhile; ?>
  </div>
  
  <div class="products-grid">
    <?php if($productos->num_rows > 0): ?>
      <?php while($producto = $productos->fetch_assoc()): ?>
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
    <?php else: ?>
      <div class="no-results">
        <i class="fas fa-search"></i>
        <h3>No se encontraron productos</h3>
        <p>Intenta con otros criterios de búsqueda</p>
        <a href="productos.php" class="btn btn-primary">Ver Todos</a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php
include 'partials/footer.php';
?>