<section>
    <div class="container-fluid bg-light py-3">
        <div class="p-3" style="background-color: #154360;">
            <div class="h4 text-white d-inline">สายการตรวจราชการ:</div>
            &nbsp;&nbsp;&nbsp;<select class="form-control col-md-4 d-inline" name="lnpection_id" id="list-inspection"></select>
        </div>

        <div class="container">
            <div class="m-3 border bg-white">
                <div class="h5 text-center text-white p-3" style="background-color: #154360;">รายการหัวข้อการตรวจ</div>
                <div class="p-3" id="wait-subject">Please select inspection</div>
                <div class="p-3" id="list-subject">
                    <!-- render data from JS drawListSubject(inspectionID) function -->
                </div>

                <div class="text-center">
                    <button id="add-subject-btn" class="btn btn-primary invisible">เพิ่มหัวข้อการตรวจ</button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal Create subject -->
<div class="modal fade" id="create-subject-modal">
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
                    <form id="add-subject-form">
                        <div class="form-group">
                            <label>ชื่อหัวข้อการตรวจ</label>
                            <input class="form-control" type="text" name="subject_name" required>
                        </div>

                        <div class="form-group">
                            <label>ลำดับ</label>
                            <input class="form-control" type="number" name="order" required>
                        </div>

                        <div class="form-group text-center">
                            <input type="hidden" name="inspection_id" value="">
                            <button class="btn btn-info">บันทึก</button>
                        </div>
                    </form>
                    <div id="add-subject-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Create subject -->

<!-- Modal Edit subject -->
<div class="modal fade" id="edit-subject-modal">
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
                    <form id="edit-subject-form">
                        <div class="form-group">
                            <label>ชื่อหัวข้อการตรวจ:</label>
                            <input class="form-control" id="edit-subject-name" type="text" name="subjectName" required>
                        </div>

                        <div class="form-group">
                            <label>หัวข้อแม่:</label>
                            <select class="form-control" name="parentID" id="edit-parent-subject"></select>
                        </div>

                        <div class="form-group">
                            <label>ลำดับหัวข้อ:</label>
                            <input class="form-control" id="edit-subject-order" type="number" name="subjectOrder" required>
                        </div>

                        <div class="form-group">
                            <label>ระดับชั้นเชิงลึก:</label>
                            <select name="level" class="form-control" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <input id="edit-subject-subjid" type="hidden" name="subjectID" value="">
                            <button class="btn btn-info">บันทึก</button>
                        </div>
                    </form>
                    <div id="edit-subject-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Edit subject -->

<!-- Modal Delete subject -->
<div class="modal fade" id="delete-subject-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ลบหัวข้อการตรวจ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="delete-subject-form">
                        <div class="form-group">
                            <label>ชื่อหัวข้อการตรวจ</label>
                            <div class="" id="delete-subject-name"></div>
                        </div>

                        <div class="form-group text-center">
                            <input id="delete-subject-subjid" type="hidden" name="subjectID" value="">
                            <button class="btn btn-info">ยืนยันการลบ</button>
                        </div>
                    </form>
                    <div id="delete-subject-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Delete subject -->

<script>
    $(document).ready(function() {

        function setSubjectIDToModal(select) {
            // console.log(select);
            let key = select.selectedIndex;
            let text = select[key].innerText;
            let selected = select[key].value;

            $("input[name='inspection_id']").val(selected);
            $("#add-subject-btn").text(`เพิ่มหัวข้อ${text}`);
        }

        let subjects = [];
        function drawListSubject(inspectionID) {
            $.post({
                url: '<?= site_url('oig_service/ajax_get_subject') ?>',
                data: {
                    inspection_id: inspectionID
                },
                dataType: 'json'
            }).done(res => {
                let list = '';
                let num = 0;
                subjects = res; // ADD SUBJECTS TO subjects variable
                res.forEach(element => {
                    num += 1;
                    let editBtn = `<button class="ml-auto btn btn-sm btn-info edit-subject" data-subject-id="${element.SUBJECT_ID}">Edit</button>`;
                    let deleteBtn = `<button class="btn btn-sm btn-danger delete-subject" data-subject-id="${element.SUBJECT_ID}">Delete</button>`;
                    let link = `<a href="<?= site_url('controller_user/subject_question') ?>/${element.SUBJECT_ID}" title="View question">${num}. ${element.SUBJECT_NAME}</a>`;

                    list += `<p class="d-flex">${link} ${editBtn} ${deleteBtn}</p>`;
                });

                $("#list-subject").html(list);
                $("#wait-subject").text('');
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        }

        /** ********************************************************/

        $("#list-inspection").change(function() {
            let inspectionID = $(this).val();

            if (inspectionID) {
                $("#wait-subject").text('Loading data .....');
                setSubjectIDToModal($(this)[0]); /** ตั้งค่า inspecttion key ใส่ไว้ใน modal add subject*/
                drawListSubject(inspectionID);
                $("#add-subject-btn").removeClass('invisible');
            } else {
                $("#add-subject-btn").addClass('invisible');
            }
        });

        /** ********************************************************/

        $.get({
            /** get inspection */
            url: '<?= site_url('oig_service/service_get_inspection') ?>',
            dataType: 'json'
        }).done(res => {
            // console.log(res);
            let option = '<option value="">เลือกประเภทสายการตรวจ</option>';
            res.forEach(element => {
                option += `<option value="${element.INSPE_ID}">[ ${element.INSPE_NAME} ]</option> `;
            });

            $('#list-inspection').html(option);
        }).fail((jhr, status, error) => {
            console.error(jhr, status, error);
        });

        /** ********************************************************/

        $("#add-subject-btn").click(function() {
            $("#create-subject-modal").modal();
        });

        /** ********************************************************/

        $("#add-subject-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            let inspectionID = $("#list-inspection").val();

            $.post({
                url: '<?= site_url('controller_user/ajax_add_subject') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                if (res.status) {
                    $("#add-subject-form-result").attr('class', 'alert alert-success');
                    $("#add-subject-form-result").text(res.text);
                    drawListSubject(inspectionID);
                } else {
                    $("#add-subject-form-result").attr('class', 'alert alert-danger');
                    $("#add-subject-form-result").text(res.text);
                }

                setTimeout(() => {
                    $("#add-subject-form-result").attr('class', '');
                    $("#add-subject-form-result").text('');
                }, 2500);
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        });

        /** ********************************************************/

        $(document).on('click', '.edit-subject', function() {
            let subjectID = $(this).data('subject-id');
            $.post({
                url: '<?= site_url('oig_service/ajax_get_subject_one') ?>',
                data: {
                    subjectID: subjectID
                },
                dataType: 'json'
            }).done(res => {
                console.log(res);
                console.log(subjects);
                let parentSubjOpt = '<option value="">ไม่ระบุ</option>';
                subjects.forEach( element => {
                    parentSubjOpt += `<option value="${element.SUBJECT_ID}" ${ res.SUBJECT_PARENT_ID === element.SUBJECT_ID ? 'selected':'' }>[ ${element.SUBJECT_NAME} ]</option>`;
                });
                $("#edit-parent-subject").html(parentSubjOpt);
                $("#edit-subject-name").val(res.SUBJECT_NAME);
                $("#edit-subject-order").val(res.SUBJECT_ORDER);
                $("#edit-subject-subjid").val(res.SUBJECT_ID);
                $("#edit-subject-modal").modal();
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        });
        /** ********************************************************/

        $("#edit-subject-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            let inspectionID = $("#list-inspection").val();

            $.post({
                url: '<?= site_url('controller_user/ajax_update_subject') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                if (res.status) {
                    $("#edit-subject-form-result").attr('class', 'alert alert-success');
                    $("#edit-subject-form-result").text(res.text);
                    drawListSubject(inspectionID);
                } else {
                    $("#edit-subject-form-result").attr('class', 'alert alert-danger');
                    $("#edit-subject-form-result").text(res.text);
                }

                setTimeout(() => {
                    $("#edit-subject-form-result").attr('class', '');
                    $("#edit-subject-form-result").text('');
                }, 2500);
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        });
        /** ********************************************************/

        $(document).on('click', '.delete-subject', function() {
            let subjectDetail = $(this).siblings('a');
            let subjectID = $(this).data('subject-id');
            console.log(subjectID);
            $("#delete-subject-name").text(subjectDetail.text());
            $("#delete-subject-subjid").val(subjectID);
            $("#delete-subject-modal").modal();
        });
        /** ********************************************************/

        $("#delete-subject-form").submit(function(event) {
            event.preventDefault();
            let inspectionID = $("#list-inspection").val();
            let formData = $(this).serialize();
            $.post({
                url: '<?= site_url('controller_user/ajax_delete_subject') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                if (res.status) {
                    $("#delete-subject-form-result").attr('class', 'alert alert-success');
                    $("#delete-subject-form-result").text(res.text);
                    drawListSubject(inspectionID);
                } else {
                    $("#delete-subject-form-result").attr('class', 'alert alert-danger');
                    $("#delete-subject-form-result").text(res.text);
                }

                setTimeout(() => {
                    $("#delete-subject-form-result").attr('class', '');
                    $("#delete-subject-form-result").text('');
                }, 2500);
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        });

    });
</script>