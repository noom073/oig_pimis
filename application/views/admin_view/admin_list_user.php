<section>
    <div class="container-fluid bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Manage user</li>
                <li class="breadcrumb-item">Privilege</li>
            </ol>
        </nav>

        <div class="table-responsive">
            <table id="user-table" class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Number</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Active</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal edit user -->
<div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-user-form">
                    <div class="container">
                        <div class="row py-3">
                            <div class="col-md-6">
                                <div>
                                    <label> Email:</label>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="email" id="form-edit-user-email" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label> Name:</label>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="name" id="form-edit-user-name">
                                </div>
                            </div>
                        </div>

                        <div class="row py-3">
                            <div class="col-md-6">
                                <div>
                                    <label> Type user:</label>
                                </div>
                                <div>
                                    <select class="form-control" name="type_user" id="form-edit-user-type"></select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label> User active:</label>
                                </div>
                                <div>
                                    <select class="form-control" name="user_active" id="form-edit-user-active" required>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row py-3">
                            <div class="col-md-12">
                                <div class="" id="form-edit-user-result"></div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- end Modal edit user -->

<!-- Modal add user -->
<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-user-form">
                    <div class="container">
                        <div class="row py-3">
                            <div class="col-md-6">
                                <div>
                                    <label> Email:</label>
                                </div>
                                <div>
                                    <input class="form-control" type="email" name="email" id="form-add-user-email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label> Name:</label>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="name" id="form-add-user-name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row py-3">
                            <div class="col-md-6">
                                <div>
                                    <label> Type user:</label>
                                </div>
                                <div>
                                    <select class="form-control" name="type_user" id="form-add-user-type" required>
                                        <?php foreach ($types as $r) { ?>
                                            <option value="<?= $r['TYPE_ID'] ?>"><?= $r['TYPE_NAME'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label> User active:</label>
                                </div>
                                <div>
                                    <select class="form-control" name="user_active" id="form-user-active" required>
                                        <option value="y">Active</option>
                                        <option value="n">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row py-3">
                            <div class="col-md-12">
                                <div class="" id="form-add-user-result"></div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- end Modal add user -->

<!-- Modal delete user -->
<div class="modal fade" id="delete-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row py-3">
                        <div class="col-md-6">
                            <div>
                                <label> Email:</label>
                            </div>
                            <div>
                                <div class="form-control" id="delete-user-email"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label> Name:</label>
                            </div>
                            <div>
                                <div class="form-control" id="delete-user-name"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row py-3">
                        <div class="col-md-12">
                            <div class="" id="form-delete-user-result"></div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-danger" id="delete-user-submit">Delete User</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- end Modal delete user -->



<script>
    $(document).ready(function() {
        console.log('ok');
        setTimeout(() => {
            $("#admin-navbar > .navbar-nav > li#admin-manage-user").addClass("active");

        }, 1000);
        generateTable();

        // show user datatable 
        function generateTable() {
            $("#user-table").DataTable({
                destroy: true,
                ajax: {
                    url: "<?= site_url('admin/ajax_get_user') ?>",
                    dataSrc: 'user'
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        render: (data, type, row, meta) => {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'NAME'
                    },
                    {
                        data: 'EMAIL'
                    },
                    {
                        data: 'TYPE_NAME',
                        className: 'text-center'
                    },
                    {
                        data: 'USER_ACTIVE',
                        className: 'text-center',
                        render: (data, type, row, meta) => {
                            let active = '';
                            if (data == 'y') {
                                active = 'Active';
                            } else {
                                active = 'Inactive';
                            }
                            return active;
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: (data, type, row, meta) => {
                            let editBtn = `<button class="btn btn-primary edit-user" data-email="${row.EMAIL}">Edit</button>`;
                            let deleteBtn = `<button class="btn btn-danger delete-user" data-email="${row.EMAIL}" data-name="${row.NAME}">Delete</button>`;
                            return `${editBtn} ${deleteBtn}`;
                        }
                    }
                ]
            });
        }

        // modal edit user
        $(document).on("click", ".edit-user", function(event) {
            let email = $(this).attr("data-email");

            $.ajax({
                url: "<?= site_url('admin/ajax_get_user_detail') ?>",
                data: {
                    email: email
                },
                type: "post",
                dataType: "json",
                success: (res) => {
                    // console.log(res);
                    $("#form-edit-user-name").val(res.user.NAME);
                    $("#form-edit-user-email").val(res.user.EMAIL);

                    let typeUserOption = "";
                    res.types.forEach(function(element) {
                        let typeSelected = element.TYPE_ID == res.user.USER_TYPE ? 'selected' : '';
                        typeUserOption += `<option value="${element.TYPE_ID}" ${typeSelected}>${element.TYPE_NAME}</option>`;
                    });

                    let userActiveOption = "";
                    console.log(res.user.USER_ACTIVE);
                    userActiveOption += `<option value="y" ${res.user.USER_ACTIVE == 'y' ? 'selected' : ''}>Active</option>`;
                    userActiveOption += `<option value="n" ${res.user.USER_ACTIVE == 'n' ? 'selected' : ''}>Inactive</option>`;

                    $("select#form-edit-user-type").html(typeUserOption);
                    $("select#form-edit-user-active").html(userActiveOption);
                    $("#edit-user-modal").modal();
                },
                error: (jhr, status, error) => {
                    console.log(jhr, status, error);
                }

            });
        });

        // edit user submit
        $("#edit-user-form").submit(function(event) {
            event.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                url: "<?= site_url('admin/ajax_update_user') ?>",
                data: data,
                type: "post",
                dataType: "json",
                success: (res) => {
                    console.log(res);
                    if (res.status) {
                        $("#form-edit-user-result").attr("class", "alert alert-success");
                        $("#form-edit-user-result").text(res.text);
                        generateTable();
                    } else {
                        $("#form-edit-user-result").attr("class", "alert alert-warning");
                        $("#form-edit-user-result").text(res.text);
                    }
                    setTimeout(() => {
                        $("#form-edit-user-result").attr("class", "");
                        $("#form-edit-user-result").text("");
                    }, 2500);
                },
                error: (jhr, status, error) => {
                    console.log(jhr, status, error);
                }

            });
        });

        $("#add-user-nav").click(function() {
            console.log('add-user-modal');
            $("#add-user-modal").modal();
        });

        $("#add-user-form").submit(function(event) {
            event.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                url: "<?= site_url('admin/ajax_add_user') ?>",
                data: data,
                type: "post",
                dataType: "json",
                success: (res) => {
                    console.log(res);
                    if (res.status) {
                        $("#form-add-user-result").attr("class", "alert alert-success");
                        $("#form-add-user-result").text(res.text);
                        generateTable();
                    } else {
                        $("#form-add-user-result").attr("class", "alert alert-warning");
                        $("#form-add-user-result").text(res.text);
                    }
                    setTimeout(() => {
                        $("#form-add-user-result").attr("class", "");
                        $("#form-add-user-result").text("");
                    }, 2500);
                },
                error: (jhr, status, error) => {
                    console.log(jhr, status, error);
                }
            });
        });

        $(document).on("click", ".delete-user", function(event) {
            event.preventDefault();
            let email = $(this).attr("data-email");
            let name = $(this).attr("data-name");
            $("#delete-user-email").text(email);
            $("#delete-user-submit").attr("data-email", email);
            $("#delete-user-name").text(name);
            $("#delete-user-modal").modal();
        });

        $(document).on("click", "#delete-user-submit", function(event) {
            event.preventDefault();
            let email = $(this).attr("data-email");
            $.ajax({
                url: "<?= site_url('admin/ajax_delete_user') ?>",
                data: {
                    email: email
                },
                type: "post",
                dataType: "json",
                success: (res) => {
                    console.log(res);
                    if (res.status) {
                        $("#form-delete-user-result").attr("class", "alert alert-success");
                        $("#form-delete-user-result").text(res.text);
                        generateTable();
                    } else {
                        $("#form-delete-user-result").attr("class", "alert alert-warning");
                        $("#form-delete-user-result").text(res.text);
                    }
                    setTimeout(() => {
                        $("#form-delete-user-result").attr("class", "");
                        $("#form-delete-user-result").text("");
                    }, 2500);
                },
                error: (jhr, status, error) => {
                    console.log(jhr, status, error);
                }
            });
        });

    });
</script>