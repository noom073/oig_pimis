<section>
    <div class="container-fluid bg-light py-3">
        <div class="p-3" style="background-color: #154360;">
            <div class="h4 text-white d-inline">หัวข้อการตรวจราชการ:</div>
            &nbsp;&nbsp;&nbsp;<select class="form-control col-md-4 d-inline" name="lnpection_id" id="list-inspection"></select>
        </div>

        <div class="container">
            <div class="m-3 border bg-white">
                <div class="h5 text-center text-white p-3" style="background-color: #154360;">รายการหัวข้อการตรวจ</div>
                <div class="p-3">
                    <p>1. การปฏิบัติตามนโยบาย (เฉพาะ) ของ ผบ.ทสส./ผบ.ศบท. ประจำปีงบประมาณ พ.ศ.๒๕๖๓</p>
                    <p>2. การปฏิบัติตามนโยบาย (เฉพาะ) ของ ผบ.ทสส./ผบ.ศบท. ประจำปีงบประมาณ พ.ศ.๒๕๖๓</p>
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
                            <input class="form-control" type="text" name="subject_name">
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
<!-- END Modal Create inspection -->

<script>
    $(document).ready(function() {

        function setSubjectIDToModal(select) {
            console.log(select);
            let key = select.selectedIndex;
            let text = select[key].innerText;
            let selected = select[key].value;

            $("input[name='inspection_id']").val(selected);
            $("#add-subject-btn").text(`เพิ่มหัวข้อ${text}`);
        }

        $("#list-inspection").change(function() {
            let inspectionID = $(this).val();

            if (inspectionID) {
                setSubjectIDToModal($(this)[0]);
                $("#add-subject-btn").removeClass('invisible');
            } else {
                $("#add-subject-btn").addClass('invisible');
            }
        });

        $.get({
                /** get inspection */
                url: '<?= site_url('oig_service/service_get_inspection') ?>',
                dataType: 'json'
            })
            .done(res => {
                // console.log(res);
                let option = '<option value="">เลือกประเภทสายการตรวจ</option>';
                res.forEach(element => {
                    option += `<option value="${element.INSPE_ID}">${element.INSPE_NAME}</option> `;
                });

                $('#list-inspection').html(option);
            })
            .fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });

        $("#add-subject-btn").click(function() {
            $("#create-subject-modal").modal();
        });

        $("#add-subject-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            console.log(formData);

            $.post({
                    url: '<?= site_url('controller_user/ajax_add_subject') ?>',
                    data: formData,
                    dataType: 'json'
                })
                .done(res => {
                    console.log(res);
                    if (res.status) {
                        $("#add-subject-form-result").attr('class', 'alert alert-success');
                        $("#add-subject-form-result").text(res.text);
                    } else {
                        $("#add-subject-form-result").attr('class', 'alert alert-danger');
                        $("#add-subject-form-result").text(res.text);
                    }

                    setTimeout(() => {
                        $("#add-subject-form-result").attr('class', '');
                        $("#add-subject-form-result").text('');
                    }, 2500);
                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });

        });
    });
</script>