Dropzone.autoDiscover = false;
$(function () {
    const inputs = document.querySelectorAll('#formAddBlogs .form-control');
    const alertCreate = document.querySelector('#modalCreate #clientMsg');
    const alertEdit = document.querySelector('#ModalEdit #clientMsg');

    // Configuration commune pour les deux Dropzones
    const dropzoneConfig = {
        url: baseUrl + "/blogs/uploadImage",
        paramName: "image",
        maxFiles: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictDefaultMessage: "Déposez votre image ici ou cliquez pour sélectionner",
        init: function () {
            this.on("success", function (file, response) {
                $(this.element).closest('form').find('input[name="image"]').val(response.filename);
            });
            this.on("error", function (file, errorMessage) {
                console.error(errorMessage);
            });
            this.on("removedfile", function (file) {
                $(this.element).closest('form').find('input[name="image"]').val('');
            });
        }
    };

    // Initialisation des Dropzones
    const createDropzone = new Dropzone("#imageDropzone", dropzoneConfig);
    const editDropzone = new Dropzone("#imageDropzoneEdit", dropzoneConfig);

    const BlogsTble = new DataTable('#blogs_table', {
        ajax: baseUrl + '/blogs/lireAll',
        columns: [
            {
                data: 'image', render: (data) => {
                    return `<img src="${data}" width="50" height="50" class="img-circle">`;
                }
            },
            { data: 'title' },
            {
                data: 'content', render: (data) => {
                    return decodeHTMLEntities(data);
                }
            },
            { data: 'createAt' },
            { data: 'authors' },
            {
                data: 'idBlogs', sortable: false, render: (data) => {
                    return `<a class="text-primary editBlogs" role="button" title="Modifier" data-id="${data}" ><i class="fa fa-edit"></i></a> 
                <a class="text-danger supprBlogs" role="button" title="Supprimer" data-id="${data}"><i class="fa fa-trash"></i></a>`;
                }
            },
        ]
    });

    $('#blogs_table').on('click', '.editBlogs', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#ModalEdit').modal('show');

        Getter(baseUrl + '/blogs/lireOne/' + id, (data) => {
            $('#formEditBlogs #idBlogs').val(data.idBlogs);
            $('#formEditBlogs #title').val(data.title);
            $('#formEditBlogs #authors').val(data.authors);
            // Mettre à jour TinyMCE correctement
            if (tinymce.get('formEditBlogs_content')) {
                tinymce.get('formEditBlogs_content').setContent(data.content || '');
            }

            // Réinitialiser Dropzone et afficher l'image existante
            editDropzone.removeAllFiles(true);
            if (data.image) {
                let mockFile = { name: data.image.split('/').pop(), size: 12345 };
                editDropzone.displayExistingFile(mockFile, data.image);
                $('#formEditBlogs input[name="image"]').val(data.image);
            }

        });
    });
    tinymce.init({
        selector: '#content'
    });
    tinymce.init({
        selector:"#formEditBlogs_content"
    })
    $('#formEditBlogs').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        Poster(baseUrl + '/blogs/update', (data) => {
            alertEdit.innerHTML = Msg(data.type, data.message);
            setTimeout(() => {
                $('#ModalEdit').modal('hide');
            }, 1000);
        }, formData);
    })
    $('#ModalEdit').on('hidden.bs.modal', function (e) {
        $('#formEditBlogs')[0].reset();
        editDropzone.removeAllFiles(true);
        if (tinymce.get('content')) {
            tinymce.get('content').setContent('');
        }
        BlogsTble.ajax.reload();
    });

    $('#blogs_table').on('click', '.supprBlogs', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#ModalSupprimer').modal('show');
        $('#formDeleteBlogs').submit(function (e) {
            e.preventDefault();
            Poster(baseUrl + '/blogs/delete/' + id, (data) => {
                setTimeout(() => {
                    $('#ModalSupprimer').modal('hide');
                }, 1000);

            });
        });
    });
    $('#ModalSupprimer').on('hidden.bs.modal', function (e) {
        $('#formDeleteBlogs')[0].reset();
        BlogsTble.ajax.reload();
    })
    $('#formAddBlogs').submit(function (e) {
        e.preventDefault();
        inputs.forEach((input) => {
            if (input.value.trim() == '') {
                alertCreate.innerHTML = Msg("error", "Veuillez remplir tous les champs");
                return;
            }
        })
        var formData = new FormData(this);
        Poster(baseUrl + '/blogs/create', (data) => {
            alertCreate.innerHTML = Msg(data.type, data.message);
            $('#formAddBlogs')[0].reset();
        }, formData);
    })

    var btnAddBlogs = document.querySelector('#btncreateBlogs');
    btnAddBlogs.addEventListener('click', function () {
        $('#modalCreate').modal('show');
    })
    $('#modalCreate').on('hidden.bs.modal', function (e) {
        $('#formAddBlogs')[0].reset();
        createDropzone.removeAllFiles(true);
        if (tinymce.get('content')) {
            tinymce.get('content').setContent('');
        }
        BlogsTble.ajax.reload();
    })
})