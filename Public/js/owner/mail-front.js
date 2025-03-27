$(function(){
    const inputs = document.querySelectorAll('#formAddNewsletters .form-control');
    const alertCreate = document.querySelector('#Newsletter #clientMsg');
    $('#formAddNewsletters').submit(function(e) {
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
            Poster(baseUrl + '/mail/create', (data) => {
                if (data.type === 'success') {
                    alertCreate.innerHTML = `<span class="success-message">${data.message}</span>`;
                    $('#formAddNewsletters')[0].reset();
                } else {
                    alertCreate.innerHTML = `<span class="error-message">${data.message}</span>`;
                }
            }, formData);
        }
    });
  });
