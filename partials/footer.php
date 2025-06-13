  <!-- Footer -->
  <footer class="main-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-column">
          <h3>Nomad Outdoor</h3>
          <p>Proveemos el mejor equipamiento para aventureros que buscan explorar los límites de la naturaleza con seguridad y estilo.</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        
        <div class="footer-column">
          <h3>Enlaces Rápidos</h3>
          <div class="footer-links">
            <a href="index.php"><i class="fas fa-chevron-right"></i> Inicio</a>
            <a href="inicio.php"><i class="fas fa-chevron-right"></i> Explorar</a>
            <a href="productos.php"><i class="fas fa-chevron-right"></i> Productos</a>
            <a href="contacto.php"><i class="fas fa-chevron-right"></i> Contacto</a>
            <a href="blog.php"><i class="fas fa-chevron-right"></i> Blog de Aventuras</a>
          </div>
        </div>
        
        <div class="footer-column">
          <h3>Categorías</h3>
          <div class="footer-links">
            <?php
            require_once 'config/database.php';
            $categorias = $conn->query("SELECT nombre FROM categorias LIMIT 5");
            while($categoria = $categorias->fetch_assoc()):
            ?>
              <a href="productos.php?categoria=<?= urlencode($categoria['nombre']) ?>">
                <i class="fas fa-chevron-right"></i> <?= htmlspecialchars($categoria['nombre']) ?>
              </a>
            <?php endwhile; ?>
          </div>
        </div>
        
        <div class="footer-column">
          <h3>Boletín Informativo</h3>
          <p>Suscríbete para recibir ofertas exclusivas y consejos para tus aventuras.</p>
          <form class="newsletter-form" method="POST">
            <input type="email" name="email" placeholder="Tu correo electrónico" required>
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> Nomad Outdoor. Todos los derechos reservados. Diseñado con ❤️ para aventureros.</p>
      </div>
    </div>
  </footer>

  <script src="assets/js/main.js"></script>
  <script src="assets/js/cart.js"></script>
  <script src="assets/js/products.js"></script>
</body>
</html>