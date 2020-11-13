<section>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin-menu-navbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="admin-menu-navbar">
            <div class="navbar-nav">
                <a id="type-inspection" class="nav-link text-info" href="<?= site_url('controller_user/index') ?>">ประเภทการตรวจ</a>
                <a id="subject-inspection" class="nav-link text-info" href="<?= site_url('controller_user/subject_inspection') ?>">หัวข้อการตรวจราชการ</a>
                <a id="list-inspecting" class="nav-link text-info" href="<?= site_url('controller_user/list_inspecting') ?>">ปฏิทินการตรวจราชการ</a>
            </div>
        </div>
    </nav>
</section>