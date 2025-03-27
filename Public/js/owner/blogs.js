$(function(){
    const inputs = document.querySelectorAll('#formAddBlogs .form-control');
    const alertCreate = document.querySelector('#modalCreate #clientMsg');
    const alertEdit = document.querySelector('#ModalEdit #clientMsg');
    
    const BlogsTble = new DataTable('#blogs_table', {
        ajax: baseUrl+'/blogs/lireAll',
        columns: [
            { data: 'image', render:(data)=>{
                return `<img src="${data}" width="50" height="50" class="img-circle">`;
            }},
            { data: 'title' },
            { data: 'content'},
            { data: 'createAt' },
            { data: 'authors'},
            { data: 'idBlogs', sortable: false, render:(data)=>{
                return `<button class="btn btn-primary editBlogs" title="Modifier" data-id="${data}" ><span class="fa fa-edit"></span></button> 
                <button class="btn btn-danger supprBlogs" title="Supprimer" data-id="${data}"><span class="fa fa-trash"></span></button>`; 
            } },
        ]
    });

    $('#blogs_table').on('click', '.editBlogs', function(e){
        e.preventDefault();
        const id = $(this).data('id');
        $('#ModalEdit').modal('show');
        Getter(baseUrl+'/blogs/lireOne/'+id, (data)=>{
            $('#formEditBlogs #idBlogs').val(data.idBlogs);
            $('#formEditBlogs #title').val(data.title);
            $('#formEditBlogs #authors').val(data.authors);
            $('#formEditBlogs #content').val(data.content);
            (data.image)? $('#formEditBlogs #image').val(data.image) : $('#formEditBlogs #image').val('');
        })
    });
    $('#formEditBlogs').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        Poster(baseUrl+'/blogs/update', (data)=>{
            alertEdit.innerHTML=Msg(data.type, data.message);
            setTimeout(() => {
                $('#ModalEdit').modal('hide');                
            }, 1000);
        }, formData);
    })
    $('#ModalEdit').on('hidden.bs.modal', function (e) {
        $('#formEditBlogs')[0].reset(); 
        BlogsTble.ajax.reload();
    }); 

    $('#blogs_table').on('click', '.supprBlogs', function(e){
        e.preventDefault();
        const id = $(this).data('id');
        $('#ModalSupprimer').modal('show');
        $('#formDeleteBlogs').submit(function(e){
            e.preventDefault();
            Poster(baseUrl+'/blogs/delete/'+id, (data)=>{
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
    $('#formAddBlogs').submit(function(e){
        e.preventDefault();
        inputs.forEach((input)=>{
            if(input.value.trim()==''){
                alertCreate.innerHTML=Msg("error", "Veuillez remplir tous les champs");
                return;
            }
        })
        var formData = new FormData(this);
        Poster(baseUrl+'/blogs/create', (data)=>{
            alertCreate.innerHTML=Msg(data.type, data.message);
            $('#formAddBlogs')[0].reset();
        }, formData);
    })

    var btnAddBlogs = document.querySelector('#btncreateBlogs');
    btnAddBlogs.addEventListener('click', function(){
        $('#modalCreate').modal('show');
    })
    $('#modalCreate').on('hidden.bs.modal', function (e) {
        $('#formAddBlogs')[0].reset();
        BlogsTble.ajax.reload();                                                    
    })
})