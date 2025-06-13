// Cambio de imagen principal en vista de producto
document.addEventListener('DOMContentLoaded', function() {
  const mainImage = document.querySelector('.main-image');
  const thumbnails = document.querySelectorAll('.thumbnail');
  
  if (thumbnails.length > 0) {
    thumbnails.forEach(thumb => {
      thumb.addEventListener('click', function() {
        mainImage.src = this.src;
        thumbnails.forEach(t => t.classList.remove('active'));
        this.classList.add('active');
      });
    });
  }
  
  // Selección de tallas
  document.querySelectorAll('.size-option').forEach(option => {
    option.addEventListener('click', function() {
      document.querySelectorAll('.size-option').forEach(opt => {
        opt.classList.remove('selected');
      });
      this.classList.add('selected');
    });
  });
  
  // Selección de colores
  document.querySelectorAll('.color-option').forEach(option => {
    option.addEventListener('click', function() {
      document.querySelectorAll('.color-option').forEach(opt => {
        opt.classList.remove('selected');
      });
      this.classList.add('selected');
    });
  });
  
  // Filtros de productos
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      // Quitar clase activa de todos los botones
      document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('active');
      });
      // Añadir clase activa al botón clickeado
      this.classList.add('active');
      
      // Obtener categoría
      const category = this.dataset.category;
      
      // Filtrar productos
      const productCards = document.querySelectorAll('.product-card');
      productCards.forEach(card => {
        if (category === 'todos' || card.dataset.category === category) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});