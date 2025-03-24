$(function(){
    const UserTable = new DataTable('#tableUtilisateur', {
        ajax: baseUrl+'/users/lireAll',
        columns: [
            { data: 'username' },
            { data: 'email'},
            { data: 'role'},
            { data: 'status'},
            { data: 'createdAt'},
            { data: 'idUsers', sortable: false, render:(data)=>{
                return `<button class="btn btn-danger supprUsers" title="Supprimer" data-id="${data}"><span class="fa fa-trash"></span></button>`;
            }},
        ]
    })
    $('#tableUtilisateur').on('click', '.supprUsers', function(e){
        e.preventDefault();
        const id = $(this).data('id');
        $('#ModalSupprimer').modal('show');
        $('#formDeleteUtilisateur').submit(function(e){
            e.preventDefault();
            Poster(baseUrl+'/users/delete/'+id, (data)=>{
                setTimeout(() => {
                    $('#ModalSupprimer').modal('hide');                
                }, 500);
                
            });
        });
    });
    $('#ModalSupprimer').on('hidden.bs.modal', function (e) {
        $('#formDeleteUtilisateur')[0].reset();
        UserTable.ajax.reload();                                                    
    })
})