<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>" />
    <title>OIG-PIMIS ระบบสารสนเทศเพื่อการบริหารผลการตรวจการปฏิบัติราชการ</title>

    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/datatable/datatables.min.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">

    <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/datatable/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/momentjs/moment-with-locales.min.js') ?>"></script>

    <style>
        ul.q-dropdown {
            list-style-type: none;
            padding-left: 15px;
        }

        ul > li {
            margin: 5px 0;
            padding-left: 0px;
        }

        .has-child {
            cursor: pointer;
        }

        .caret::before {
            content: url(<?= base_url('assets/bootstrap-icons/caret-right-fill.svg')?>); 
            width: 45px; 
            height: 45px;
            padding-right: 5px;
        }

        .caret-down::before {
            content: url(<?= base_url('assets/bootstrap-icons/caret-down.svg')?>); 
            width: 45px; 
            height: 45px;
            padding-right: 5px;
        }

    </style>

</head>

<body>