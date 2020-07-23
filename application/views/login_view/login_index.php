<section>
    <div class="col-md-4 mx-auto bg-light">
        <div class="p-3">
            <div class="text-center mb-3">
                <div class="h2">ระบบสารสนเทศเพื่อการบริหารผลการตรวจการปฏิบัติราชการ</div>
                <div class="">Performance Inspection Management Information System</div>
                <img src="<?= base_url('assets/images/logo.png'); ?>" width="125px" alt="สจร.ทหาร">
                <div>สำนักงานจเรทหาร กองบัญชาการกองทัพไทย</div>
            </div>

            <form id="login-form">
                <div class="form-group mt-2">
                    <label>RTARF-Mail address:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="email">
                        <div class="input-group-append">
                            <span class="input-group-text">@rtarf.mi.th</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div>
                    <button type="submit" id="login-form-submit" class="btn btn-primary">Submit</button>
                    <strong id="login-form-result"></strong>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $("#login-form").submit(function(event) {
            console.log('ok');
            event.preventDefault();
            $("#login-form-submit").attr('disabled', true);
            $("#login-form-result").html(`                
                <span>Loading...</span>
                <span class="spinner-border spinner-border-sm"></span>`
            );
            
            let formData = $(this).serialize();
            $.ajax({
                url: "<?= site_url('login/ajax_adlogin_process') ?>",
                data: formData,
                type: "post",
                dataType: "json",
                success: (res) => {
                    console.log(res);
                    if (res.status) {
                        $("#login-form-result").text(res.data.nameth); 

                        setTimeout(() => {
                            if (res.data.usertype == 'admin') {
                                window.location.href = '<?= site_url('admin/index') ?>';
                            } else if(res.data.usertype == 'auditor') {
                                window.location.href = '<?= site_url('auditor/index') ?>';
                            } else if(res.data.usertype == 'user') {
                                window.location.href = '<?= site_url('user/index') ?>';
                            } else if(res.data.usertype == 'control') {
                                window.location.href = '<?= site_url('controler_user/index') ?>';
                            } else if(res.data.usertype == 'viewer') {
                                window.location.href = '<?= site_url('viewer/index') ?>';
                            }                             
                            else {
                                window.location.href = '<?= site_url('login/index') ?>';
                            }                             
                        },2000);
                        
                    } else {
                        setTimeout(() => {      
                            $("#login-form-result").text(`! ${res.text}`);      
                            $("#login-form-submit").attr('disabled', false);                                
                        },1500);
                    }
                    
                },
                error: (jhr, status, error) => {
                    console.log(jhr, status, error);
                }
            });
        });
    });
</script>