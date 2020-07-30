<section>
    <nav class="nav bg-light">
        <a class="btn btn-light" id="add-inspection-nav" href="#">เพิ่มหัวข้อการตรวจ</a>
        <!-- <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link disabled" href="#">Disabled</a> -->
    </nav>
</section>

<section>
    <div class="container-fluid bg-light py-3">
        <div class="h4">ประเภทการตรวจ:</div>

        <div class="container">
            <div class="table-responsive">
                <table id="inspection-table" class="table table-striped">
                    <thead>
                        <tr>
                            <td>ลำดับ</td>
                            <td>ประเภทการตรวจ</td>
                            <td>#</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Create inspection -->
<div class="modal fade" id="create-inspection-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มหัวข้อการตรวจ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="add-inspection-form">
                        <div class="form-group">
                            <label>ชื่อการตรวจ</label>
                            <input class="form-control" type="text" name="inp_name">
                        </div>
                        <div class="form-group">
                            <label>กลุ่มประเภทการตรวจ</label>
                            <select class="form-control" name="inp_parent">
                                <option value="">ไม่ระบุ</option>
                                <?php foreach ($inpData as $r) { ?>
                                    <option value="<?= $r['INSPE_ID'] ?>"><?= $r['INSPE_NAME'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-info">บันทึก</button>
                        </div>
                    </form>
                    <div id="add-inspection-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Create inspection -->

<!-- Modal edit inspection -->
<div class="modal fade" id="edit-inspection-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขหัวข้อการตรวจ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="edit-inspection-form">
                        <div class="form-group">
                            <label>ชื่อการตรวจ</label>
                            <input class="form-control" type="text" id="edit-inspection-form-inp-name" name="inp_name">
                        </div>
                        <div class="form-group">
                            <label>กลุ่มประเภทการตรวจ</label>
                            <select class="form-control" id="edit-inspection-form-inp-parent" name="inp_parent">
                                <option value="">ไม่ระบุ</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <input type="hidden" name="id" id="edit-inspection-form-rowid">
                            <button class="btn btn-info">บันทึก</button>
                        </div>
                    </form>
                    <div id="edit-inspection-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal edit inspection -->

<script>
    $(document).ready(function() {
        let showActiveMenu = function() {
            setTimeout(() => {
                $("#type-inspection.nav-link").addClass("active");
                console.log('ok');
            }, 1000);

        };

        let generate_table = function() {
            $("#inspection-table").DataTable({
                destroy: true,
                ajax: {
                    url: '<?= site_url('controller_user/ajax_get_inspection') ?>',
                    dataSrc: ''
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        render: (data, type, row, meta) => {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'INSPE_NAME'
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: (data, type, row, meta) => {
                            const editbtn = `<button class="btn btn-primary edit-inspection" data-inspe-id="${row.INSPE_ID}">แก้ไข</button>`;
                            const deletebtn = `<button class="btn btn-danger delete-inspection" data-inspe-id="${row.INSPE_ID}">ลบ</button>`;
                            return `${editbtn} ${deletebtn}`;
                        }
                    },
                ]
            });
        };

        showActiveMenu();
        generate_table();

        $("#add-inspection-nav").click(function() {
            $("#create-inspection-modal").modal();
        });

        $("#add-inspection-form").submit(function(event) {
            event.preventDefault()
            const formData = $(this).serialize();
            $.post({
                    url: '<?= site_url('controller_user/ajax_add_inspection') ?>',
                    data: formData,
                    dataType: 'json'
                })
                .done(res => {
                    console.log(res);

                    if (res.status) {
                        $("#add-inspection-form-result").text(res.text);
                        $("#add-inspection-form-result").prop('class', 'alert alert-success');
                        generate_table();
                    } else {
                        $("#add-inspection-form-result").text(res.text);
                        $("#add-inspection-form-result").prop('class', 'alert alert-waring');
                    }

                    setTimeout(() => {
                        $("#add-inspection-form-result").text('');
                        $("#add-inspection-form-result").prop('class', '');
                    }, 2000);

                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });
        });

        $(document).on("click", ".edit-inspection", function() {
            const id = $(this).attr('data-inspe-id');
            const thisBtn = $(this);
            thisBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...`);

            $.post({
                    url: '<?= site_url('controller_user/ajax_get_inspection_row') ?>',
                    data: {
                        id: id
                    },
                    dataType: 'json'
                })
                .done(res => {
                    thisBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...`);
                    const all_ins = res.all_ins.filter(x => x.INSPE_ID != id);
                    $("#edit-inspection-form-inp-name").val(res.ins_row.INSPE_NAME);
                    $("#edit-inspection-modal").modal();

                    let option = '<option value="">ไม่ระบุ</option>';
                    all_ins.forEach(r => {
                        option += `<option value="${r.INSPE_ID}" ${ r.INSPE_ID == res.ins_row.INSPE_PARENT ? 'selected':'' }>${r.INSPE_NAME}</option>`
                    });
                    $("#edit-inspection-form-inp-parent").html(option);
                    $("#edit-inspection-form-rowid").val(res.ins_row.INSPE_ID);

                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                })
                .always(() => {
                    thisBtn.html('แก้ไข')
                });
        });

        $(document).on("click", ".delete-inspection", function() {
            const id = $(this).attr('data-inspe-id');
            let message = 'ยืนยันการลบข้อมูลหัวข้อการตรวจ';
            if (confirm(message)) {
                $.post({
                        url: '<?= site_url('controller_user/ajax_delete_inspection_row') ?>',
                        data: {
                            id: id
                        },
                        datatype: 'json'
                    })
                    .done(res => {
                        console.log(res);
                        generate_table();
                    })
                    .fail((jhr, status, error) => {
                        console.error(jhr, status, error);
                    });

                return true;
            } else {
                return false;
            }
        });

        $("#edit-inspection-form").submit(function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            $.post({
                    url: '<?= site_url('controller_user/ajax_update_insprection') ?>',
                    data: formData,
                    dataType: 'json'
                })
                .done(res => {
                    console.log(res);
                    if (res.status) {
                        $("#edit-inspection-form-result").text(res.text);
                        $("#edit-inspection-form-result").prop('class', 'alert alert-success');

                        generate_table();
                    } else {
                        $("#edit-inspection-form-result").text(res.text);
                        $("#edit-inspection-form-result").prop('class', 'alert alert-waring');
                    }

                    setTimeout(() => {
                        $("#edit-inspection-form-result").text('');
                        $("#edit-inspection-form-result").prop('class', '');
                    }, 2500)
                })
                .fail((jhr, status, error) => {
                    console.log(jhr, status, error);
                });
        });
    });
</script>