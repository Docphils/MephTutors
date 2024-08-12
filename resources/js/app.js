import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
function updateRequestType(value) {
    const conditionalFields = document.querySelectorAll('.conditional-fields');
  
    conditionalFields.forEach(field => {
      field.style.display = value === field.dataset.type ? 'block' : 'none';
    });
  }