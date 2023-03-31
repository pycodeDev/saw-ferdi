<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->include('Layout/Header'); ?>
    <?php echo $this->include('Layout/Css'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?php echo $this->include('Layout/Navbar'); ?>
        <?php echo $this->include('Layout/Sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>  
        </div>
    <!-- /.content-wrapper -->

        <?php echo $this->include('Layout/Footer'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->

<?php echo $this->include('Layout/Js'); ?>
<?php echo $this->include('Layout/Toast') ?>

<script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $("#example1").DataTable();
            });

            $(".filter-data").click(function() {
                var id = $("#myselect").val();
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash
                get_data(id, csrfName, csrfHash);
            });
        });
        
        function get_data(id, csrfName, csrfHash) {
            $.ajax({
                url: "/search",
                method: "POST",
                data: {
                    id: id,
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function(data) {
                    var len = data[0]['data'].length;
                    var no = 1;
                    var hasil = [];
                    $('.txt_csrfname').val(data[0]['token']);
                    
                    if (len > 0) {
                        for (var i = 0; i < len; i++) {

                            var row = $('<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + data[0]['data'][i].nama_kriteria + '</td>' +
                                '<td>' + data[0]['data'][i].nama_sub_kriteria + '</td>' +
                                '<td>' + data[0]['data'][i].kategori + '</td>' +
                                '<td><a class="btn btn-sm btn-warning float-right" href="/sub/kriteria/edit/' + data[0]['data'][i].id + '"><i class="fas fa-trash-alt"></i> Edit</a></td>');

                            hasil.push(row);
                            no = no + 1;
                        }
                        $('#dataTable tbody').html(hasil);

                        var id_krit = data[0].id_kriteria;
                        var a = '<a class="btn btn-sm btn-danger float-right" href="/sub_kriteria/del/' + id + '"><i class="fas fa-trash-alt"></i> Hapus All</a>';
                        var b = '<a href="/sub/kriteria/tambah/' + id + '" class="btn btn-success btn-sm float-right text-white"><i class="fas fa-plus"></i> Tambah Data</a>';
                        $('#btn').html(a);
                        $('#btn-add').html(b);
                    } else {
                        var b = '<a href="/sub/kriteria/tambah/' + id + '" class="btn btn-success btn-sm float-right text-white"><i class="fas fa-plus"></i> Tambah Data</a>';
                        $('#dataTable tbody').html('<td colspan="4" align="center">Data Tidak Ada</td>');
                        $('#btn-add').html(b);
                    }
                },
                error: function() {
                    $('#dataTable tbody').html('<td colspan="4" align="center">Error</td>');
                }
            });
        }
    </script>
</body>
</html>
