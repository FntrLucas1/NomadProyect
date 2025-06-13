// Función para el menú móvil
document.addEventListener('DOMContentLoaded', function() {
  const menuBtn = document.querySelector('.mobile-menu-btn');
  const mobileMenu = document.querySelector('.mobile-menu');
  
  if (menuBtn) {
    menuBtn.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
    });
  }
  
  // Cerrar menú al hacer clic en un enlace
  const menuLinks = document.querySelectorAll('.mobile-menu a');
  menuLinks.forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
    });
  });
});

// Funcionalidad de búsqueda
document.querySelector('.search-form')?.addEventListener('submit', function(e) {
  e.preventDefault();
  const searchTerm = this.querySelector('input').value.trim();
  if (searchTerm) {
    window.location.href = `productos.php?busqueda=${encodeURIComponent(searchTerm)}`;
  }
});

// Inicializar tooltips
document.querySelectorAll('[data-tooltip]').forEach(element => {
  element.addEventListener('mouseenter', function() {
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = this.dataset.tooltip;
    
    const rect = this.getBoundingClientRect();
    tooltip.style.top = `${rect.bottom + window.scrollY}px`;
    tooltip.style.left = `${rect.left + rect.width / 2}px`;
    tooltip.style.transform = 'translateX(-50%)';
    
    document.body.appendChild(tooltip);
    
    this.addEventListener('mouseleave', () => {
      tooltip.remove();
    });
  });
});