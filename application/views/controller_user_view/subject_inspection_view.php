<section>
    <div class="container-fluid bg-light py-3">
        <div class="p-3" style="background-color: #154360;">
            <div class="h4 text-white d-inline">สายการตรวจราชการ:</div>
            &nbsp;&nbsp;&nbsp;<select class="form-control col-md-4 d-inline" name="lnpection_id" id="list-inspection"></select>
        </div>

        <div class="container">
            <div class="m-3 border bg-white">
                <div class="h5 text-center text-white p-3" style="background-color: #154360;">รายการหัวข้อการตรวจ</div>
                <div class="text-center">
                    <button id="add-subject-btn" class="btn btn-primary invisible">เพิ่มหัวข้อการตรวจ</button>
                </div>
                <div class="p-3" id="wait-subject">Please select inspection</div>
                <div class="p-3" id="list-subject">
                    <!-- render data from JS drawListSubject(inspectionID) function -->
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

<!-- Modal Create sub-subject -->
<div class="modal fade" id="create-sub-subject-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มหัวข้อย่อย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="add-sub-subject-form">
                        <div class="form-group">
                            <label>ชื่อหัวข้อการตรวจย่อย</label>
                            <input class="form-control" type="text" name="subject_name" required>
                        </div>

                        <div class="form-group">
                            <label>หัวข้อแม่:</label>
                            <select class="form-control" name="parentID" id="add-sub-subject-parent-subject"></select>
                        </div>

                        <div class="form-group">
                            <label>ลำดับ</label>
                            <input class="form-control" type="number" name="order" value="1" required>
                        </div>

                        <div class="form-group text-center">
                            <input type="hidden" name="inspection_id" value="">
                            <button class="btn btn-info">บันทึก</button>
                        </div>
                    </form>
                    <div id="add-sub-subject-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Create sub-subject -->

<!-- Modal Edit subject -->
<div class="modal fade" id="edit-subject-modal">
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
                    <form id="edit-subject-form">
                        <div class="form-group">
                            <label>ชื่อหัวข้อการตรวจ:</label>
                            <input class="form-control" id="edit-subject-name" type="text" name="subjectName" required>
                        </div>

                        <div class="form-group">
                            <label>ระดับชั้นเชิงลึก:</label>
                            <select name="level" class="form-control" id="edit-subject-level" required></select>
                        </div>

                        <div class="form-group">
                            <label>หัวข้อแม่:</label>
                            <select class="form-control" name="parentID" id="edit-parent-subject"></select>
                        </div>

                        <div class="form-group">
                            <label>ลำดับหัวข้อ:</label>
                            <input class="form-control" id="edit-subject-order" type="number" name="subjectOrder" required>
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
            $("#add-subject-btn").text(`เพิ่มหัวข้อสำหรับ ${text}`);
        }

        let subjects = []; // SET SUBJECTS TO GLOBAL

        function drawListSubject(inspectionID) {
            $.post({
                url: '<?= site_url('oig_service/ajax_get_subject') ?>',
                data: {
                    inspection_id: inspectionID
                },
                dataType: 'json'
            }).done(res => {
                subjects = res;
                let treeArrays = generateTreeArray(res);
                let html = generateTreeView(treeArrays);
                $("#list-subject").html(html);
                $("#wait-subject").text('');
                /*let list = '';
                let num = 0;
                subjects = res; // ADD SUBJECTS TO subjects global variable
                res.forEach(element => {
                    num += 1;
                    let name = `${num}. ${element.SUBJECT_NAME}`;
                    let link = `<a href="<?= site_url('controller_user/subject_question') ?>/${element.SUBJECT_ID}" class="ml-auto btn btn-sm btn-light" title="View question">คำถาม</a>`;
                    let editBtn = `<button class="btn btn-sm btn-info edit-subject" data-subject-id="${element.SUBJECT_ID}">Edit</button>`;
                    let deleteBtn = `<button class="btn btn-sm btn-danger delete-subject" data-subject-id="${element.SUBJECT_ID}">Delete</button>`;

                    list += `<div>
                        <div>
                            <p class="d-flex">${name} ${link} ${editBtn} ${deleteBtn}</p>                            
                        </div>
                        <div class="collapse show">
                            <p> lorem .</p>
                        </div>
                    <div>`;
                });
                $("#list-subject").html(list);
                $("#wait-subject").text('');*/
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        }

        $(document).on('click', '.has-child', function() {
            $(this).parent().siblings('ul').first('.q-dropdown').toggleClass('d-none');
            $(this).toggleClass("caret-down");
        });

        function generateTreeArray(arrays, parentID = '0') {
            let items = arrays.filter(r => r.SUBJECT_PARENT_ID === parentID)
                .sort( (a, b) => a.SUBJECT_ORDER - b.SUBJECT_ORDER)
                .map(item => {
                    let child = generateTreeArray(arrays, item.SUBJECT_ID);
                    if (child.length) {
                        item.child = child;
                    }
                    return item;
                });
            return items;
        }

        function generateTreeView(treeArray, num = '', display = 'show') {
            let classDisplay = display === 'show' ? '' : 'd-none';
            let html = '<ul class="q-dropdown ' + classDisplay + '">';
            treeArray.forEach((r, index) => {
                let ahead = num === '' ? '' : num + '.';
                let label = ahead + (+index + 1);
                let link = `<a href="<?= site_url('controller_user/subject_question') ?>/${r.SUBJECT_ID}" class="ml-auto btn btn-sm btn-primary" title="View question">คำถาม</a>`;
                let editBtn = `<button class="btn btn-sm btn-info edit-subject" data-subject-id="${r.SUBJECT_ID}">Edit</button>`;
                let deleteBtn = `<button class="btn btn-sm btn-danger delete-subject" data-subject-id="${r.SUBJECT_ID}">Delete</button>`;
                let newSubject = `<button class="btn btn-sm btn-light add-sub-subject" data-subject-id="${r.SUBJECT_ID}" data-level="${r.SUBJECT_LEVEL}">
                <svg class="bi text-primary" width="1em" height="1em">
                    <use xlink:href="<?= base_url('assets/bootstrap-icons/bootstrap-icons.svg#plus-circle') ?>"/>
                </svg>
                </button>`;

                if (r.child) {
                    html += `<li class="d-block">
                        <div class="d-flex">
                            <span class="has-child caret">
                                ${label}. ${r.SUBJECT_NAME}                            
                            </span>
                            <div class="ml-auto">${newSubject} ${link} ${editBtn} ${deleteBtn}</div>
                        </div>                        
                        ${generateTreeView(r.child, label, 'none')}
                    </li>`;
                } else {
                    html += `<li class="d-block">
                        <div class="d-flex">
                            <span>
                                ${label}. ${r.SUBJECT_NAME}                            
                            </span>
                            <div class="ml-auto">${newSubject} ${link} ${editBtn} ${deleteBtn}</div>
                        </div>
                    </li>`;
                }
            });
            html += '</ul>';
            return html;
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
        $(document).on('click', ".add-sub-subject", function() {
            let subjectID = $(this).data('subject-id');
            let lv = +($(this).data('level')) +1;
            $("#add-sub-subject-form").data('level', lv); //FILL DATA(LEVEL) +1 TO FORM #add-sub-subject-form
            let subject = subjects.filter( r => r.SUBJECT_ID == subjectID);
            let option = '';
            subject.forEach(r => {
                option = `<option value="${r.SUBJECT_ID}" selected>${r.SUBJECT_NAME}</option>`;
            });

            $("#add-sub-subject-parent-subject").html(option);
            $("#create-sub-subject-modal").modal();
        });

        $("#add-sub-subject-form").submit(function(event) {
            event.preventDefault();
            let subjectID = $(this).data('subject-id');
            let level = $(this).data('level');
            let inspectionID = $("#list-inspection").val();
            let formData = $(this).serialize()+`&level=${level}`;
            console.log(formData);
            $("#add-sub-subject-parent-subject");

            $.post({
                url: '<?= site_url('controller_user/ajax_add_sub_subject') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                if (res.status) {
                    $("#add-sub-subject-form-result").attr('class', 'alert alert-success');
                    $("#add-sub-subject-form-result").text(res.text);
                    drawListSubject(inspectionID);
                } else {
                    $("#add-sub-subject-form-result").attr('class', 'alert alert-danger');
                    $("#add-sub-subject-form-result").text(res.text);
                }

                setTimeout(() => {
                    $("#add-sub-subject-form-result").attr('class', '');
                    $("#add-sub-subject-form-result").text('');
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
                let parentSubjOpt = '<option value="0">ไม่ระบุ</option>';
                subjects.forEach(element => {
                    parentSubjOpt += `<option value="${element.SUBJECT_ID}" ${ res.SUBJECT_PARENT_ID === element.SUBJECT_ID ? 'selected':'' }>[ ${element.SUBJECT_NAME} ]</option>`;
                });

                let option = '';
                for (let index = 0; index < 4; index++) {
                    option += `<option value="${index+1}" ${ res.SUBJECT_LEVEL == index+1 ? 'selected':''}>${index+1}</option>`;
                }
                
                $("#edit-parent-subject").html(parentSubjOpt);
                $("#edit-subject-level").html(option);
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