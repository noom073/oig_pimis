<section>
    <div class="container-fluid bg-light py-3">
        <div class="border bg-white">
            <div class="h5 text-center text-white p-3" style="background-color: #154360;">การดำเนินการของหน่วยรับตรวจ</div>
            <div class="p-3">
                <p>
                    <span class="h5">สายการตรวจราชการ:</span>
                    <span class="loading-head-detail">Loading .....</span>
                    <span class="text-success" id="inspection-name"></span>
                </p>
                <p>
                    <span class="h5">หัวข้อการตรวจราชการ:</span>
                    <span class="loading-head-detail">Loading .....</span>
                    <span class="text-success" id="subject-name"></span>
                </p>
            </div>
            <div class="container">
                <div class="h5 p-3 text-center text-white" style="background-color: #154360;">รายการคำถาม</div>
                <div class="p-3" id="wait-question">Loading question .....</div>
                <div class="p-3" id="list-question"></div>

            </div>

            <div class="text-center">
                <button id="add-question-btn" class="btn btn-primary">เพิ่มรายการคำถาม</button>
            </div>
        </div>
    </div>
</section>

<!-- Modal Create question -->
<div class="modal fade" id="create-question-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มรายการคำถาม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="add-question-form">
                        <div class="form-group">
                            <label>คำถาม</label>
                            <textarea class="form-control" name="questionName" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>ลำดับ</label>
                            <input class="form-control" type="number" name="order" required>
                        </div>

                        <div class="form-group text-center">
                            <input type="hidden" name="subjectID" value="">
                            <button class="btn btn-info">บันทึก</button>
                        </div>
                    </form>
                    <div id="add-question-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Create subject -->

<!-- Modal Edit question -->
<div class="modal fade" id="edit-question-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขรายการคำถาม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="edit-question-form">
                        <div class="form-group">
                            <label>คำถาม</label>
                            <textarea class="form-control" name="editQuestionName" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>ลำดับ</label>
                            <input class="form-control" type="number" name="editOrder" required>
                        </div>

                        <div class="form-group text-center">
                            <input type="hidden" name="editQuestionID" value="">
                            <button class="btn btn-info">บันทึก</button>
                        </div>
                    </form>
                    <div id="edit-question-form-result"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Edit subject -->

<script>
    $(document).ready(function() {

        function drawQuestion() {
            $.post({
                /** โหลดข้อมูล subject และ inspection */
                url: '<?= site_url('oig_service/ajax_get_question') ?>',
                data: {
                    subjectID: '<?= $subjectID ?>'
                },
                dataType: 'json'
            }).done(res => {
                // console.log(res);
                let list = '';
                let num = 1;
                res.forEach(element => {
                    list += `<div class="d-flex my-3">
                        <span title="updated: ${element.TIME_UPDATE}">${num}. ${element.Q_NAME}</span>
                        <button class="ml-auto btn btn-sm btn-info edit-question-btn" data-qid="${element.Q_ID}">แก้ไข</button>
                    </div>`;

                    num++;
                });
                $("#list-question").html(list);
                $("#wait-question").prop('class', 'd-none');
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        }

        drawQuestion();

        $.post({
            /** โหลดข้อมูล subject และ inspection */
            url: '<?= site_url('oig_service/ajax_get_subject_and_inspection_by_subject') ?>',
            data: {
                subjectID: '<?= $subjectID ?>'
            },
            dataType: 'json'
        }).done(res => {
            // console.log(res);
            $(".loading-head-detail").addClass('d-none');
            $("#inspection-name").text(res.INSPECTION.INSPE_NAME);
            $("#subject-name").text(res.SUBJECT.SUBJECT_NAME);
            $("input[name='subjectID']").val(res.SUBJECT.SUBJECT_ID);
        }).fail((jhr, status, error) => {
            console.error(jhr, status, error);
        });
        /***************************************************** */

        $("#add-question-btn").click(function() {
            $("#create-question-modal").modal();
        });
        /***************************************************** */

        $("#add-question-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            let thisForm = $(this)[0];
            $.post({
                url: '<?= site_url('controller_user/ajax_add_question') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                // console.log(res);
                if (res.status) {
                    $("#add-question-form-result").prop('class', 'alert alert-success');
                    $("#add-question-form-result").text(res.text);
                    drawQuestion();

                    setTimeout(() => {
                        $("#add-question-form-result").prop('class', '');
                        $("#add-question-form-result").text('');
                        thisForm.reset();
                    }, 1500);
                } else {
                    $("#add-question-form-result").prop('class', 'alert alert-danger');
                    $("#add-question-form-result").text(res.text);
                }
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        });
        /***************************************************** */

        $(document).on('click', ".edit-question-btn", function() {
            let qid = $(this).data('qid');

            $.post({
                /** โหลดข้อมูล subject และ inspection */
                url: '<?= site_url('oig_service/ajax_get_question_one') ?>',
                data: {
                    questionID: qid
                },
                dataType: 'json'
            }).done(res => {
                // console.log(res);
                $("textarea[name='editQuestionName']").text(res.Q_NAME);
                $("input[name='editOrder']").val(res.Q_ORDER);
                $("input[name='editQuestionID']").val(res.Q_ID);

                $("#edit-question-modal").modal();
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        });

        $("#edit-question-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            $.post({
                /** โหลดข้อมูล subject และ inspection */
                url: '<?= site_url('controller_user/ajax_update_question') ?>',
                data: formData,
                dataType: 'json'
            }).done(res => {
                // console.log(res);
                if (res.status) {
                    $("#edit-question-form-result").prop('class', 'alert alert-success');
                    $("#edit-question-form-result").text(res.text);
                    drawQuestion();

                    setTimeout(() => {
                        $("#edit-question-form-result").prop('class', '');
                        $("#edit-question-form-result").text('');
                    }, 1500);
                } else {
                    $("#edit-question-form-result").prop('class', 'alert alert-danger');
                    $("#edit-question-form-result").text(res.text);
                }
            }).fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
        });
    });
</script>