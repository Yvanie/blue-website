<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1>Liste des Blogs</h1>                
            </div> 
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary"  id="btncreateBlogs">
                Add Blog
            </button>
            <div class="my-3"></div>
            <table class="table table-bordered" id="blogs_table">
                <thead class="thead-light">
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>CreateAt</th>
                    <th>Author</th>
                    <th></th>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enregistrer un Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="clientMsg"></div>
                <form method="post" id="formAddBlogs" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div id="imageDropzone" class="dropzone">
                                        <div class="fallback">
                                            <input type="file" name="image" />
                                        </div>
                                    </div>
                                    <input type="hidden" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control form" id="title" name="title" placeholder="Enter the blog title...">
                                </div>
                                <div class="form-group">
                                    <label for="authors">Author</label>
                                    <input type="text" class="form-control form" id="authors" name="authors" placeholder="Enter Author Name...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="content">Description</label>
                                    <textarea name="content" id="content" class="form-control form" placeholder="Enter your content ..."></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="idUsers" id="idUsers" class="form-control form" value="<?= $_SESSION['id'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier les informations d'un Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="clientMsg"></div>
                <form method="post" id="formEditBlogs" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div id="imageDropzoneEdit" class="dropzone">
                                        <div class="fallback">
                                            <input type="file" name="image" />
                                        </div>
                                    </div>
                                    <input type="hidden" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control form" id="title" name="title" placeholder="Enter the blog title...">
                                </div>
                                <div class="form-group">
                                    <label for="authors">Author</label>
                                    <input type="text" class="form-control form" id="authors" name="authors" placeholder="Enter Author Name...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="content">Description</label>
                                    <textarea name="content" id="content" class="form-control form" placeholder="Enter your content ..."></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="idUser" id="idUser" class="form-control form" value="<?= $_SESSION['id'] ?>">
                            <input type="hidden" name="idBlogs" id="idBlogs" class="form-control form">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                        <button type="submit" name="submitbtn" class="btn btn-primary"><span class="fa fa-edit"></span> Modifier</button>
                    </div>
                </form>
            </div>
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
                <form method="post" id="formDeleteBlogs">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="color: red;"> Vous êtes sure de vouloir supprimer ce blog? </h2>
                        </div>
                            <input type="hidden" name="idBlogs" id="idBlogs" class="form-control form">
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