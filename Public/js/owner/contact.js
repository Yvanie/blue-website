$(function () {
  const ContactTable = new DataTable("#tableContact", {
    ajax: baseUrl + "/contact/lireAll",
    columns: [
      { data: "username" },
      { data: "email" },
      { data: "phoneNumber" },
      { data: "subject" },
      { data: "message" },
      { data: "createAt" },

      {
        data: "idContact",
        sortable: false,
        render: (data) => {
          return `<button class="btn btn-danger supprContact" title="Supprimer" data-id="${data}"><span class="fa fa-trash"></span></button>`;
        },
      },
    ],
  });
  $("#tableContact").on("click", ".supprContact", function (e) {
    e.preventDefault();
    const id = $(this).data("id");
    $("#ModalSupprimer").modal("show");
    $("#formDeleteContact").submit(function (e) {
      e.preventDefault();
      Poster(baseUrl + "/contact/delete/" + id, (data) => {
        setTimeout(() => {
          $("#ModalSupprimer").modal("hide");
        }, 500);
      });
    });
  });
  $("#ModalSupprimer").on("hidden.bs.modal", function (e) {
    $("#formDeleteContact")[0].reset();
    ContactTable.ajax.reload();
  });
});
