class Cart {
  constructor() {
    this.items = JSON.parse(localStorage.getItem('cart')) || [];
    this.updateCartUI();
  }
  
  addItem(productId, name, price, image, quantity = 1, size = null, color = null) {
    const existingItem = this.items.find(item => 
      item.productId === productId && item.size === size && item.color === color
    );
    
    if (existingItem) {
      existingItem.quantity += quantity;
    } else {
      this.items.push({
        productId,
        name,
        price,
        image,
        quantity,
        size,
        color
      });
    }
    
    this.save();
    this.updateCartUI();
    return this.items;
  }
  
  removeItem(index) {
    this.items.splice(index, 1);
    this.save();
    this.updateCartUI();
  }
  
  updateQuantity(index, quantity) {
    if (quantity > 0) {
      this.items[index].quantity = quantity;
    } else {
      this.removeItem(index);
    }
    this.save();
    this.updateCartUI();
  }
  
  clear() {
    this.items = [];
    this.save();
    this.updateCartUI();
  }
  
  getTotal() {
    return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
  }
  
  getCount() {
    return this.items.reduce((count, item) => count + item.quantity, 0);
  }
  
  save() {
    localStorage.setItem('cart', JSON.stringify(this.items));
  }
  
  updateCartUI() {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
      cartCount.textContent = this.getCount();
      cartCount.style.display = this.getCount() > 0 ? 'inline-block' : 'none';
    }
    
    // Actualizar vista del carrito si está abierta
    if (document.querySelector('.cart-view')) {
      this.renderCart();
    }
  }
  
  renderCart() {
    const cartContainer = document.querySelector('.cart-items');
    const cartTotal = document.querySelector('.cart-total');
    
    if (!cartContainer) return;
    
    cartContainer.innerHTML = '';
    
    if (this.items.length === 0) {
      cartContainer.innerHTML = '<p class="empty-cart">Tu carrito está vacío</p>';
      cartTotal.textContent = '$0.00';
      return;
    }
    
    this.items.forEach((item, index) => {
      const cartItem = document.createElement('div');
      cartItem.className = 'cart-item';
      cartItem.innerHTML = `
        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
        <div class="cart-item-details">
          <h4>${item.name}</h4>
          ${item.size ? `<p>Talla: ${item.size}</p>` : ''}
          ${item.color ? `<p>Color: ${item.color}</p>` : ''}
          <div class="cart-item-quantity">
            <button class="quantity-btn minus" data-index="${index}">-</button>
            <span>${item.quantity}</span>
            <button class="quantity-btn plus" data-index="${index}">+</button>
          </div>
        </div>
        <div class="cart-item-price">
          $${(item.price * item.quantity).toFixed(2)}
          <button class="remove-item" data-index="${index}">&times;</button>
        </div>
      `;
      cartContainer.appendChild(cartItem);
    });
    
    cartTotal.textContent = `$${this.getTotal().toFixed(2)}`;
    
    // Event listeners para botones
    document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
      btn.addEventListener('click', () => {
        const index = parseInt(btn.dataset.index);
        this.updateQuantity(index, this.items[index].quantity - 1);
      });
    });
    
    document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
      btn.addEventListener('click', () => {
        const index = parseInt(btn.dataset.index);
        this.updateQuantity(index, this.items[index].quantity + 1);
      });
    });
    
    document.querySelectorAll('.remove-item').forEach(btn => {
      btn.addEventListener('click', () => {
        const index = parseInt(btn.dataset.index);
        this.removeItem(index);
      });
    });
  }
}

// Inicializar carrito
const cart = new Cart();

// Funcionalidad para añadir al carrito
document.querySelectorAll('.add-to-cart').forEach(button => {
  button.addEventListener('click', function() {
    const productCard = this.closest('.product-card') || this.closest('.product-info');
    const productId = productCard.dataset.productId;
    const productName = productCard.querySelector('.product-name').textContent;
    const productPrice = parseFloat(productCard.querySelector('.product-price').textContent.replace('$', ''));
    const productImage = productCard.querySelector('.product-image')?.src || '';
    
    // Obtener talla y color seleccionados
    const selectedSize = productCard.querySelector('.size-option.selected')?.textContent;
    const selectedColor = productCard.querySelector('.color-option.selected')?.dataset.colorName;
    
    cart.addItem(
      productId, 
      productName, 
      productPrice, 
      productImage,
      1,
      selectedSize,
      selectedColor
    );
    
    // Mostrar notificación
    const notification = document.createElement('div');
    notification.className = 'cart-notification';
    notification.innerHTML = `
      <p>¡${productName} añadido al carrito!</p>
      <a href="carrito.php">Ver carrito</a>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
      notification.style.opacity = '0';
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  });
});