<section>
    <nav class="nav bg-light">
        <!-- <a class="btn btn-light" id="add-inspection-event-nav" href="#">เพิ่มการออกหน่วยตรวจราชการ</a> -->
    </nav>
</section>

<section>
    <div class="container-fluid bg-light py-3">
        <div class="h4">ปฏิทินการตรวจราชการ:</div>

        <div class="container">
            <div id="loading-calendar">Calendar is loading .....</div>
            <div id="calendar" style="height: 70%; width: 100%;"></div>
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

<!-- <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'> -->
<link href='<?= base_url('assets/fullcalendar/lib/main.css') ?>' rel='stylesheet' />
<script src='<?= base_url('assets/fullcalendar/lib/main.js') ?>'></script>

<script>
    $(document).ready(function() {
        function showActiveMenu() {
            setTimeout(() => {
                $("#list-inspecting.nav-link").addClass("active");
            }, 1000);
        };

        function genCalendar() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                // locale: 'th'
                // themeSystem: 'bootstrap',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listDay'
                },
                editable: true,
                dateClick: (data) => {
                    console.log(data);
                },
                eventClick: (data) => {
                    console.log(data.event);
                },
                eventTextColor: '#fff',
                events: {
                    url: '<?= site_url('oig_service/ajax_get_event_data') ?>',
                    failure: function() {
                        console.error('there was an error while fetching events!');
                    }
                },
                loading: (isLoading) => {
                    if (isLoading === false) {
                        $("#loading-calendar").prop('class', 'invisible');
                    } else {
                        $("#loading-calendar").prop('class', 'visible');
                    }
                }
            });

            calendar.render();
        };

        function get_unit() {
            $.get({
                    url: '<?= site_url('oig_service/service_get_unit') ?>',
                    dataType: 'json'
                })
                .done(res => {
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
        get_unit();
        get_inspection();
        genCalendar();

        $("#add-inspection-event-nav").click(function() {
            $("#add-event-modal").modal();
        });

        $("#add-inspection-form").submit(function(event) {
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