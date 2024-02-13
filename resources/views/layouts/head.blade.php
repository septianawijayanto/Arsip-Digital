<!-- Google Font: Source Sans Pro -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }} | {{ env('STORE_NAME') }}
</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/toastr/toastr.min.css">

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}" /> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<style>
    /* Tooltip container */
    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
        /* If you want dots under the hoverable text */
    }

    /* Tooltip text */
    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        padding: 5px 0;
        border-radius: 6px;

        /* Position the tooltip text - see examples below! */
        position: absolute;
        z-index: 1;
    }

    /* Show the tooltip text when you mouse over the tooltip container */
    .tooltip:hover .tooltiptext {
        visibility: visible;
    }
</style>