<?php
require_once 'config/database.php';
include 'partials/header.php';

if(!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener datos del usuario
$query = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Obtener pedidos del usuario
$pedidos_query = "SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY fecha_pedido DESC LIMIT 5";
$pedidos_stmt = $conn->prepare($pedidos_query);
$pedidos_stmt->bind_param("i", $usuario_id);
$pedidos_stmt->execute();
$pedidos = $pedidos_stmt->get_result();
?>

<section class="profile-section">
  <h2>Mi Perfil</h2>
  
  <div class="profile-info">
    <div class="info-group">
      <label>Nombre:</label>
      <span><?= htmlspecialchars($usuario['nombre']) ?></span>
    </div>
    
    <div class="info-group">
      <label>Email:</label>
      <span><?= htmlspecialchars($usuario['email']) ?></span>
    </div>
    
    <div class="info-group">
      <label>Dirección:</label>
      <span><?= htmlspecialchars($usuario['direccion'] ?? 'No especificada') ?></span>
    </div>
    
    <a href="editar-perfil.php" class="btn">Editar Perfil</a>
  </div>
  
  <div class="profile-orders">
    <h3>Mis Últimos Pedidos</h3>
    
    <?php if($pedidos->num_rows > 0): ?>
      <table class="orders-table">
        <thead>
          <tr>
            <th>Número de Pedido</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while($pedido = $pedidos->fetch_assoc()): ?>
            <tr>
              <td><?= $pedido['numero_pedido'] ?></td>
              <td><?= date('d/m/Y', strtotime($pedido['fecha_pedido'])) ?></td>
              <td>$<?= number_format($pedido['total'], 2) ?></td>
              <td><?= $pedido['estado_id'] ?></td>
              <td>
                <a href="pedido.php?id=<?= $pedido['id'] ?>" class="btn small">Ver Detalles</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No tienes pedidos recientes.</p>
    <?php endif; ?>
  </div>
</section>

<?php
include 'partials/footer.php';
?>