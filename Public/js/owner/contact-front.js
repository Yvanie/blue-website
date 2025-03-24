$(function() {
  const inputs = document.querySelectorAll('#formAddContact .form-control');
  const alertCreate = document.querySelector('.cont-content #clientMsg');

  $('#formAddContact').submit(function(e) {
      e.preventDefault(); 

      let isValid = true;  
      inputs.forEach((input) => {
          if (input.value.trim() === '') {
              alertCreate.innerHTML = '<span class="error-message">Please fill all fields</span>';
              isValid = false;
          }
      });
      if (isValid) {
          var formData = new FormData(this); 
          Poster(baseUrl + '/contact/create', (data) => {
              if (data.type === 'success') {
                  alertCreate.innerHTML = `<span class="success-message">${data.message}</span>`;
                  $('#formAddContact')[0].reset();
              } else {
                  alertCreate.innerHTML = `<span class="error-message">${data.message}</span>`;
              }
          }, formData);
      }
  });
});