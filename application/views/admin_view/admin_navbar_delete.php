<section>
    <nav class="navbar navbar-expand-lg navbar-dark my-bg-blue-one">
        <a class="navbar-brand" href="#">ระบบสารสนเทศเพื่อการบริหารผลการตรวจการปฏิบัติราชการ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="admin-navbar">
            <div class="ml-auto">
                <a id="time-moment" class="moment navbar-text text-light"></a>
                <?php if ($this->session->isLogged == false) { ?>
                    <a href="<?= site_url('login') ?>" class="btn btn-sm btn-danger">Login</a>
                <?php } ?>
                <?php if ($this->session->isLogged == true) { ?>
                    <a href="<?= site_url('login/logout') ?>" class="btn btn-sm btn-danger">Logout</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</section>
<script>
    $(document).ready(function() {
        let mm = moment()
        mm.locale('th')
        // const t = mm.format('MMMM Do YYYY, h:mm:ss a');
        const t = mm.format('ddd D MMMM')
        const y = parseInt(mm.format('YYYY')) + 543
        const date = `${t} ${y}`
        $("#time-moment").text(date)
    });
</script>