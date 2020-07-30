<section>
    <nav class="nav bg-light">
        <!-- <a class="btn btn-light" id="add-inspection-event-nav" href="#">เพิ่มการออกหน่วยตรวจราชการ</a> -->
    </nav>
</section>

<section>
    <div class="container-fluid bg-light py-3">
        <div class="h4">ปฏิทินการตรวจราชการ:</div>

        <div class="container">
            <div id="calendar" style="height: 70%; width: 100%; overflow-x: auto;"></div>
        </div>

    </div>
</section>

<!-- Modal add inspection -->
<div class="modal fade" id="add-event-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มการออกหน่วยตรวจราชการ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="add-inspection-form">
                        <div class="form-group">
                            <label>หน่วย</label>
                            <select class="form-control" id="unit-id" name="unit_id">
                                <option value="">ไม่ระบุ</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ประเภทการตรวจ</label>
                            <select class="form-control" id="inspection" name="inp_parent">
                                <option value="">ไม่ระบุ</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>เริ่ม วันที่</label>
                                    <input type="date" name="date_begin" id="date-begin" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>เสร็จสิ้น วันที่</label>
                                    <input type="date" name="date_end" id="date-end" class="form-control">
                                </div>
                            </div>
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
<!-- END Modal add inspection -->

<link href='<?= base_url('assets/fullcalendar/packages/core/main.css') ?>' rel='stylesheet' />
<link href='<?= base_url('assets/fullcalendar/packages/daygrid/main.css') ?>' rel='stylesheet' />
<link href='<?= base_url('assets/fullcalendar/packages/list/main.css') ?>' rel='stylesheet' />

<script src='<?= base_url('assets/fullcalendar/packages/core/main.js') ?>'></script>
<script src='<?= base_url('assets/fullcalendar/packages/daygrid/main.js') ?>'></script>
<script src='<?= base_url('assets/fullcalendar/packages/interaction/main.js') ?>'></script>
<script src='<?= base_url('assets/fullcalendar/packages/list/main.js') ?>'></script>

<script>
    $(document).ready(function() {
        function showActiveMenu() {
            setTimeout(() => {
                $("#list-inspecting.nav-link").addClass("active");                
            }, 1000);
        };
    });
</script>