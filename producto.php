<?php
require_once 'config/database.php';
include 'partials/header.php';

if(!isset($_GET['id'])) {
    header("Location: productos.php");
    exit();
}

$id = intval($_GET['id']);
$producto = $conn->query("SELECT * FROM productos WHERE id = $id")->fetch_assoc();

if(!$producto) {
    header("Location: productos.php");
    exit();
}
?>

<section class="product-detail">
  <div class="product-images">
    <img src="assets/images/products/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>" class="main-image">
  </div>
  
  <div class="product-info">
    <h1><?= $producto['nombre'] ?></h1>
    <div class="product-price">$<?= number_format($producto['precio'], 2) ?></div>
    <p class="product-description"><?= nl2br($producto['descripcion']) ?></p>
    
    <div class="product-actions">
      <button class="add-to-cart btn">Añadir al carrito</button>
    </div>
    
    <h3>Especificaciones técnicas</h3>
    <table class="specs-table">
      <tr>
        <td>Material</td>
        <td><?= $producto['material_principal'] ?></td>
      </tr>
      <tr>
        <td>Peso</td>
        <td><?= $producto['peso_gramos'] ?> gramos</td>
      </tr>
      <tr>
        <td>Temporada</td>
        <td><?= $producto['temporada'] ?></td>
      </tr>
    </table>
  </div>
</section>

<?php
include 'partials/footer.php';
?>