<section>
    <div class="container-fluid bg-light">
        <div>
            <h3>รายการ การตรวจราชการ</h3>
        </div>

        <div class="container">
            <div id="calendar" style="height: 70%; width: 100%; overflow-x: auto;"></div>
        </div>

    </div>
</section>

<!-- Modal edit inspection -->
<div class="modal fade" id="add-event-modal">
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
                $("#controller-user-navbar > .navbar-nav > li#list-inspecting")
                    .addClass("active");

                $("a.nav-link#add-inspection-event-nav")
                    .addClass("active");
            }, 1000);
        };

        function genCalendar() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'list'],
                // locale: 'th'
                header: {
                    left: 'prev,next, today',
                    center: 'title',
                    right: 'dayGridMonth, dayGridDay, listDay'
                },
                editable: true,
                dateClick: (data) => {
                    console.log(data);
                },
                eventClick: (data) => {
                    console.log(data);
                },
                eventTextColor: '#fff',
                events: [{
                    title: 'Long Event',
                    start: '2020-07-07',
                    end: '2020-07-10'
                }]
            });

            calendar.render();
            console.log(calendar)
        };

        function get_unit() {
            $.get({
                    url: '<?= site_url('oig_service/service_get_unit') ?>',
                    dataType: 'json'
                })
                .done(res => {
                    console.log(res);
                    let option = '';
                    res.forEach(element => {
                        option += `<option value="${element.NPRT_UNIT}">${element.NPRT_ACM}</option>`;
                    });

                    $("#unit-id").html(option);
                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });
        };

        function get_inspection() {
            $.get({
                    url: '<?= site_url('oig_service/service_get_inspection') ?>',
                    dataType: 'json'
                })
                .done(res => {
                    console.log(res);
                    let option = '';
                    res.forEach(element => {
                        option += `<option value="${element.INSPE_ID}">${element.INSPE_NAME}</option>`;
                    });

                    $("#inspection").html(option);
                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });
        }

        showActiveMenu();
        genCalendar();
        get_unit();
        get_inspection();

        $("#add-inspection-event-nav").click(function() {
            $("#add-event-modal").modal();
        });

        $("#edit-inspection-form").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();

            $.post({
                    url: '<?= site_url('controller_user/ajax_insert_inspection_event') ?>',
                    data: formData,
                    dataType: 'json'
                })
                .done(res => {
                    console.log(res);
                })
                .fail((jhr, status, error) => {
                    console.error(jhr, status, error);
                });
        });

        $("#date-begin").change(function() {
            let value = $(this).val();
            $("#date-end").prop({
                'min': value
            });
        });

        $("#date-end").change(function() {
            let value = $(this).val();
            $("#date-begin").prop({
                'max': value
            });
        });

    });
</script>