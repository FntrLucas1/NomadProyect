// Funciones para el panel de administración
document.addEventListener('DOMContentLoaded', function() {
  // Confirmación antes de eliminar
  document.querySelectorAll('.btn.danger').forEach(button => {
    button.addEventListener('click', function(e) {
      if (!confirm('¿Estás seguro de que deseas eliminar este elemento? Esta acción no se puede deshacer.')) {
        e.preventDefault();
      }
    });
  });
  
  // Validación de formularios
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
      let valid = true;
      const requiredFields = form.querySelectorAll('[required]');
      
      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          valid = false;
          field.classList.add('error');
          
          // Mostrar mensaje de error
          let errorMessage = field.nextElementSibling;
          if (!errorMessage || !errorMessage.classList.contains('error-message')) {
            errorMessage = document.createElement('div');
            errorMessage.className = 'error-message';
            errorMessage.textContent = 'Este campo es obligatorio';
            field.parentNode.insertBefore(errorMessage, field.nextSibling);
          }
        } else {
          field.classList.remove('error');
          const errorMessage = field.nextElementSibling;
          if (errorMessage && errorMessage.classList.contains('error-message')) {
            errorMessage.remove();
          }
        }
      });
      
      if (!valid) {
        e.preventDefault();
      }
    });
  });
  
  // Editor de texto enriquecido para descripciones
  document.querySelectorAll('.rich-text-editor').forEach(editor => {
    // Implementación básica de un editor de texto
    const toolbar = document.createElement('div');
    toolbar.className = 'editor-toolbar';
    toolbar.innerHTML = `
      <button type="button" data-command="bold" title="Negrita"><strong>B</strong></button>
      <button type="button" data-command="italic" title="Itálica"><em>I</em></button>
      <button type="button" data-command="insertUnorderedList" title="Lista"><ul>·</ul></button>
    `;
    
    editor.parentNode.insertBefore(toolbar, editor);
    
    toolbar.querySelectorAll('button').forEach(btn => {
      btn.addEventListener('click', function() {
        const command = this.dataset.command;
        document.execCommand(command, false, null);
        editor.focus();
      });
    });
  });
  
  // Subida de imágenes
  document.querySelectorAll('.image-upload').forEach(uploader => {
    const input = uploader.querySelector('input[type="file"]');
    const preview = uploader.querySelector('.image-preview');
    
    input.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Previsualización">`;
        };
        reader.readAsDataURL(file);
      }
    });
  });
});