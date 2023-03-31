<script>
    $(document).ready(function() {
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            // sukses login
            <?php
            if (isset($_SESSION['s_l'])) { ?>
                Toast.fire({
                    type: 'success',
                    title: "Selamat <?= $_SESSION['name'] ?> Anda Berhasil Login"
                })
            <?php
                unset($_SESSION['s_l']);
            }
            ?>

            // sukses input kriteria
            <?php
            if (isset($_SESSION['s_i_kriteria'])) { ?>
                Toast.fire({
                    type: 'success',
                    title: "Berhasil Menambahkan Kriteria"
                })
            <?php
                unset($_SESSION['s_i_kriteria']);
            }
            ?>

            // Gagal input kriteria
            <?php
            if (isset($_SESSION['f_i_kriteria'])) { ?>
                Toast.fire({
                    type: 'error',
                    title: "Gagal Menambahkan Data Kriteria"
                })
            <?php
                unset($_SESSION['f_i_kriteria']);
            }
            ?>
        });
    });
</script>