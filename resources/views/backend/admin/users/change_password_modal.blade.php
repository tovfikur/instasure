<style>


.inp {
    position: relative;
    margin: auto;
    width: 100%;
    max-width: 280px;
    border-radius: 3px;
    overflow: hidden;
}

.inp .label {
    position: absolute;
    top: 20px;
    left: 12px;
    font-size: 16px;
    color: rgba(0, 0, 0, 0.5);
    font-weight: 500;
    transform-origin: 0 0;
    transform: translate3d(0, 0, 0);
    transition: all 0.2s ease;
    pointer-events: none;
}

.inp .focus-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.05);
    z-index: -1;
    transform: scaleX(0);
    transform-origin: left;
}

.inp input {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 100%;
    border: 0;
    font-family: inherit;
    padding: 16px 12px 0 12px;
    height: 56px;
    font-size: 16px;
    font-weight: 400;
    background: rgba(0, 0, 0, 0.02);
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.3);
    color: #000;
    transition: all 0.15s ease;
}

.inp input:hover {
    background: rgba(0, 0, 0, 0.04);
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.5);
}

.inp input:not(:-moz-placeholder-shown)+.label {
    color: rgba(0, 0, 0, 0.5);
    transform: translate3d(0, -12px, 0) scale(0.75);
}

.inp input:not(:-ms-input-placeholder)+.label {
    color: rgba(0, 0, 0, 0.5);
    transform: translate3d(0, -12px, 0) scale(0.75);
}

.inp input:not(:placeholder-shown)+.label {
    color: rgba(0, 0, 0, 0.5);
    transform: translate3d(0, -12px, 0) scale(0.75);
}

.inp input:focus {
    background: rgba(0, 0, 0, 0.05);
    outline: none;
    box-shadow: inset 0 -2px 0 #0077FF;
}

.inp input:focus+.label {
    color: #0077FF;
    transform: translate3d(0, -12px, 0) scale(0.75);
}

.inp input:focus+.label+.focus-bg {
    transform: scaleX(1);
    transition: all 0.1s ease;
}

#password_change_modal {
    display: flex;
    justify-content: center;
}

.submit_button {
    display: flex;
    justify-content: center;
    margin: 20px;
}

.submit_button button {
    width: 100%;
    height: 30px;
    background: #01329c;
    color: #fff;
    border-radius: 7px;
}
</style>

<div class="modal fade" id="password_change_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <form action="/users/{{ Auth::user()->id}}/change-password" id="change_password_form" method="post">
                    <!-- /.modal-header -->

                    <div class="card">
                        <div class="card-body">

                            @csrf
                            @method('post')
                            <div class="form-group row inp">
                                <label for="user_type" class="col-sm-4 col-form-label label"></label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="user_type"
                                        value="{{ ucwords(str_remove_dashes_custom($user->user_type)) }}">
                                </div>
                            </div>
                            <!-- /form-group  -->

                            <div class="form-group row inp">
                                <label for="name" class="col-sm-4 col-form-label label"></label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="name"
                                        value="{{ ucwords(str_remove_dashes_custom($user->name)) }}">
                                </div>
                            </div>
                            <!-- /form-group  -->

                            <div class="form-group row inp">
                                <label for="phone" class="col-sm-4 col-form-label label"></label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="phone"
                                        value="{{ ucwords(str_remove_dashes_custom($user->phone)) }}">
                                </div>
                            </div>
                            <!-- /form-group  -->


                            <div class="form-group row inp">
                                <label for="password" class="col-sm-4 col-form-label label">New Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <!-- /form-group  -->


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="d-flex submit_button">
                        <button type="Submit" class="btn btn-info">
                            Save
                        </button>
                    </div>
                </form>
                <!-- /form -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->