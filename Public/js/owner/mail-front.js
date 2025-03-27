$(function(){
    const inputs = document.querySelectorAll('#formAddNewsletters .form-control');
    const alertCreate = document.querySelector('#Newsletter #clientMsg');
    const submitBtn = $('#formAddNewsletters button[type="submit"]');
    const originalContent = submitBtn.html(); // Sauvegarder l'icône originale

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
            // Désactiver le bouton et montrer le loading
            submitBtn.prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i>');

            var formData = new FormData(this); 
            
            // Ajouter un timeout de 10 secondes
            const timeoutPromise = new Promise((_, reject) => {
                setTimeout(() => reject(new Error('Request timeout')), 10000);
            });

            // Créer la promesse de la requête
            const fetchPromise = new Promise((resolve) => {
                Poster(baseUrl + '/mail/create', resolve, formData);
            });

            // Utiliser Promise.race pour gérer le timeout
            Promise.race([fetchPromise, timeoutPromise])
                .then((data) => {
                    if (data.type === 'success') {
                        alertCreate.innerHTML = `<span class="success-message">${data.message}</span>`;
                        $('#formAddNewsletters')[0].reset();
                    } else {
                        alertCreate.innerHTML = `<span class="error-message">${data.message}</span>`;
                    }
                })
                .catch((error) => {
                    alertCreate.innerHTML = '<span class="error-message">La requête a pris trop de temps, veuillez réessayer.</span>';
                })
                .finally(() => {
                    // Réactiver le bouton et restaurer l'icône originale
                    submitBtn.prop('disabled', false)
                            .html(originalContent);
                });
        }
    });
});
