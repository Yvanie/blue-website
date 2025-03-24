$(function(){
    const EmailTable = new DataTable('#tableMail', {
        ajax: baseUrl+'/mail/lireAll',
        columns: [
            { data: 'email'},
            { data: 'createAt'},
            { data: 'confirmtoken'},
            { data: 'status'},
            { data: 'idNewsletters', sortable: false, render:(data)=>{
                return `<button class="btn btn-danger supprMail" title="Supprimer" data-id="${data}"><span class="fa fa-trash"></span></button>`;
            }},
        ]
    })
    $("#tableMail").on("click", ".supprMail", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        $("#ModalSupprimer").modal("show");
        $("#formDeleteMail").submit(function (e) {
          e.preventDefault();
          Poster(baseUrl + "/mail/delete/" + id, (data) => {
            setTimeout(() => {
              $("#ModalSupprimer").modal("hide");
            }, 500);
          });
        });
      });
      $("#ModalSupprimer").on("hidden.bs.modal", function (e) {
        $("#formDeleteMail")[0].reset();
        EmailTable.ajax.reload();
      });
})