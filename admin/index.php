<?php
require_once '../config/database.php';
session_start();

// Verificar si el usuario es administrador
if(!isset($_SESSION['usuario_id']) || !$_SESSION['es_admin']) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <header class="admin-header">
    <div class="container">
      <h1>Panel de Administración</h1>
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
    <h2>Resumen</h2>
    
    <div class="admin-stats">
      <?php
      $productos_count = $conn->query("SELECT COUNT(*) as total FROM productos")->fetch_assoc()['total'];
      $pedidos_count = $conn->query("SELECT COUNT(*) as total FROM pedidos")->fetch_assoc()['total'];
      $usuarios_count = $conn->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()['total'];
      ?>
      
      <div class="stat-card">
        <h3>Productos</h3>
        <p><?= $productos_count ?></p>
      </div>
      
      <div class="stat-card">
        <h3>Pedidos</h3>
        <p><?= $pedidos_count ?></p>
      </div>
      
      <div class="stat-card">
        <h3>Usuarios</h3>
        <p><?= $usuarios_count ?></p>
      </div>
    </div>
    
    <div class="recent-orders">
      <h3>Pedidos Recientes</h3>
      <?php
      $pedidos = $conn->query("SELECT p.*, e.nombre as estado 
                             FROM pedidos p 
                             JOIN estados_pedido e ON p.estado_id = e.id
                             ORDER BY fecha_pedido DESC LIMIT 5");
      ?>
      
      <table class="admin-table">
        <thead>
          <tr>
            <th>Número</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php while($pedido = $pedidos->fetch_assoc()): ?>
            <tr>
              <td><?= $pedido['numero_pedido'] ?></td>
              <td><?= $pedido['usuario_id'] ?></td>
              <td><?= date('d/m/Y', strtotime($pedido['fecha_pedido'])) ?></td>
              <td>$<?= number_format($pedido['total'], 2) ?></td>
              <td><?= $pedido['estado'] ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>