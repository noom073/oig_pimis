<section>
    <nav class="navbar navbar-expand-lg navbar-dark my-bg-blue-one">
        <a class="navbar-brand" href="<?= site_url() ?>">OIG-PIMIS</a>

        <div class="ml-auto">
            <a id="time-moment" class="moment navbar-text text-light">2020</a>
            <?php if ($this->session->isLogged == false) { ?>
                <a href="<?= site_url('login') ?>" class="navbar-text text-light">Login</a>
            <?php } ?>
            <?php if ($this->session->isLogged == true) { ?>
                <a href="<?= site_url('login/logout') ?>" class="navbar-text text-light">Logout</a>
            <?php } ?>
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