<div class="modal fade modal_window" id="blog_category_create_modal" tabindex="-1"
    aria-labelledby="blog_category_create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="blog_category_create_modal">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form" class="mt-2" id="form_create"
                    action="{{ route('admin.blog-categories.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Category name"
                                required />

                            <small id="name_help_block" class="form-text text-danger d-none ">
                                Name required and max length 50 characters
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Category slug"
                                required />
                            <small id="slug_help_block" class="form-text text-danger d-none">
                                Slug required, must be unique and max length 60 characters
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-warning mr-2">Reset</button>
                        <button type="submit" class="btn btn-primary" id="btn_store" ">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
