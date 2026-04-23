<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href={{ asset ("https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css") }}rel="stylesheet" />
    <link href={{ asset ('assets/css/styles.css') }} rel="stylesheet" />
    <script src={{ asset ( "https://use.fontawesome.com/releases/v6.3.0/js/all.js" ) }}crossorigin="anonymous"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href={{ asset("https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css") }}>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- jQuery HARUS DI ATAS Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Container utama */
        .select2-container--default .select2-selection--multiple {
            min-height: 42px;
            padding: 6px 6px 2px 6px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        /* Input area biar gak aneh */
        .select2-container--default .select2-search--inline .select2-search__field {
            margin-top: 4px;
        }

        /* Badge/tag */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            display: flex;
            align-items: center;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 4px 10px;
            margin: 4px 4px 0 0;
            font-size: 13px;
        }

        /* Tombol X */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            position: static;
            margin-right: 6px;
            color: #fff;
            font-weight: bold;
            font-size: 14px;
        }

        /* Hover X */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ffdddd;
        }

        /* Placeholder */
        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: #6c757d;
            margin-left: 5px;
        }

        /* Focus effect biar bagus */
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .25);
        }
    </style>
</head>