<?php
require_once '../config/database.php';
session_start();

if(!isset($_SESSION['usuario_id']) || !$_SESSION['es_admin']) {
    header("Location: ../index.php");
    exit();
}

// Obtener productos
$productos = $conn->query("SELECT p.*, c.nombre as categoria, m.nombre as marca 
                          FROM productos p
                          JOIN categorias c ON p.categoria_id = c.id
                          JOIN marcas m ON p.marca_id = m.id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administrar Productos</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <header class="admin-header">
    <div class="container">
      <h1>Administrar Productos</h1>
      <nav class="admin-nav">
        <a href="index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="pedidos.php">Pedidos</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="../logout.php">Cerrar Sesión</a>
      </nav>
    </div>
  </header>
  
  <main class="container admin-container">
    <a href="agregar-producto.php" class="btn">Agregar Nuevo Producto</a>
    
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Marca</th>
          <th>Precio</th>
          <th>Stock</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while($producto = $productos->fetch_assoc()): ?>
          <tr>
            <td><?= $producto['id'] ?></td>
            <td><?= $producto['nombre'] ?></td>
            <td><?= $producto['categoria'] ?></td>
            <td><?= $producto['marca'] ?></td>
            <td>$<?= number_format($producto['precio'], 2) ?></td>
            <td><?= $producto['stock'] ?></td>
            <td>
              <a href="editar-producto.php?id=<?= $producto['id'] ?>" class="btn small">Editar</a>
              <a href="eliminar-producto.php?id=<?= $producto['id'] ?>" class="btn small danger">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>
</body>
</html>