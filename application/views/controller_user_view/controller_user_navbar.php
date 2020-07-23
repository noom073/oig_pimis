<section>
    <nav class="navbar navbar-expand-lg navbar-dark my-bg-blue-one">
        <a class="navbar-brand" href="#">OIG-PIMIS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#controller-user-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="controller-user-navbar">
            <ul class="navbar-nav">
                <li id="type-inspection" class="nav-item">
                    <a class="nav-link" href="<?= site_url('controller_user/index') ?>">ประเภทการตรวจ</a>
                </li>
                <li id="list-inspecting" class="nav-item">
                    <a class="nav-link" href="<?= site_url('controller_user/list_inspecting') ?>">การตรวจราชการ</a>
                </li>
            </ul>

            <div class="ml-auto">
                <a id="time-moment" class="navbar-text text-light">2020</a>
                <?php if ($this->session->isLogged == false) { ?>
                    <a href="<?= site_url('login') ?>" class="navbar-text text-light">Login</a>
                <?php } ?>
                <?php if ($this->session->isLogged == true) { ?>
                    <a href="<?= site_url('login/logout') ?>" class="navbar-text text-light">Logout</a>
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