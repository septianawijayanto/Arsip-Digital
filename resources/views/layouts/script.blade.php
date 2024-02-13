<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('adminlte') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('adminlte') }}/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- //numerik -->
<script src="{{ asset('js') }}/numerik.js"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('adminlte') }}/plugins/toastr/toastr.min.js"></script>

{{-- <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!-- Select2 -->
<script src="{{ asset('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript" src="{{ asset('style-rupiah') }}/rupiah.js"></script>
<!-- ChartJS -->
{{-- <script src="{{ 'adminlte' }}/plugins/chart.js/Chart.min.js"></script> --}}


<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('adminlte') }}/dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('adminlte') }}/dist/js/pages/dashboard2.js"></script> --}}

<!-- //ini baru -->
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<!-- <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script type="text/javascript">
    $(function() {

        function rupiah(bilangan) {
            var number_string = bilangan.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }
        $(document).ready(function() {
            var flash = "{{ Session::has('sukses') }}";
            if (flash) {
                var pesan = "{{ Session::get('sukses') }}"
                toastr.success("{{ Session::get('sukses') }}")
            }
            var gagal = "{{ Session::has('gagal') }}";
            if (gagal) {
                var pesan = "{{ Session::get('gagal') }}"
                toastr.error("{{ Session::get('gagal') }}")
            }
            var info = "{{ Session::has('info') }}";
            if (info) {
                var pesan = "{{ Session::get('info') }}"
                toastr.info("{{ Session::get('info') }}")
            }
            var peringatan = "{{ Session::has('peringatan') }}";
            if (peringatan) {
                var pesan = "{{ Session::get('peringatan') }}"
                toastr.warning("{{ Session::get('peringatan') }}")
            }

            // btn hapus di klik
            $('body').on('click', '.btn-hapus', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#modal-hapus').find('form').attr('action', url);
                $('#modal-hapus').modal();
            });

        });
    })
</script>