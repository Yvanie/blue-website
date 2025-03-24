<div class="container-fluid">
    <div class="card">
        <div class="card-header" id="CreateMail">
            <div class="card-title">
                <h1>Gestion des Utilisateur</h1>
            </div>
        </div>
        <div class="card-body">
            <br><br>
            <table class="table table-bordered" id="tableUtilisateur">
                <thead class="thead-light">
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Statue</th>
                    <th>CreateAt</th>
                    <th></th>
                </thead>

            </table>
        </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="ModalSupprimer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="clientMsg"></div>
                <form method="post" id="formDeleteUtilisateur">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 style="color: red;"> Vous êtes sure de vouloir supprimer ce Utilisateur? </h3>
                        </div>
                            <input type="hidden" name="idUsers" id="idUsers" class="form-control form">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                        <button type="submit" name="submitbtn" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>