<div class="container-fluid">
    <div class="card">
        <div class="card-header" id="CreateContact">
            <div class="card-title">
                <h1>Gestion des Contact</h1>
            </div>
        </div>
        <div class="card-body">
            <br><br>
            <table class="table table-bordered" id="tableContact">
                <thead class="thead-light">
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>SUbject</th>
                    <th>Messge</th>
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
                <form method="post" id="formDeleteContact">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="color: red;"> Vous êtes sure de vouloir supprimer ce Contact? </h2>
                        </div>
                            <input type="hidden" name="idContact" id="idContact" class="form-control form">
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