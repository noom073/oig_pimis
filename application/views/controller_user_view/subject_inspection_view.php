<section>
    <div class="container-fluid bg-light py-3">
        <div class="h4">หัวข้อการตรวจราชการ:</div>
        <div>
            <select class="form-control col-md-6" name="" id="list-inspection"></select>
        </div>

        <div class="container">
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

<script>
    $(document).ready(function() {
        let showActiveMenu = function() {
            setTimeout(() => {
                $("#subject-inspection.nav-link").addClass("active");
                console.log('ok');
            }, 1000);
        };

        showActiveMenu();

        $.get({
                /** get inspection */
                url: '<?= site_url('oig_service/service_get_inspection') ?>',
                dataType: 'json'
            })
            .done(res => {
                console.log(res);
                let option = '';
                res.forEach(element => {
                    option += `<option value="${element.INSPE_ID}">${element.INSPE_NAME}</option> `;
                });

                $('#list-inspection').html(option);
            })
            .fail((jhr, status, error) => {
                console.error(jhr, status, error);
            });
    });
</script>