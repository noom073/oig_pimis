<section>
    <nav class="navbar navbar-expand-lg navbar-dark my-bg-blue-one">
        <a class="navbar-brand" href="#">OIG-PIMIS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="auditor-navbar">
            <ul class="navbar-nav">
                <li id="auditor-inspection" class="nav-item">
                    <a class="nav-link" href="#">การตรวจราชการ</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> -->
            </ul>

            <div class="ml-auto">
                <a id="time-moment" class="moment navbar-text text-light">2020</a>
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