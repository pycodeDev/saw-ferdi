<?= $this->extend('Index') ?>
<?= $this->section('content') ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Main row -->
          <div class="row">
            <section class="col-lg-12 connectedSortable">
                <!-- general form elements -->
                <!-- Card -->
                <div class="card card-dark">
                    <div class="card-header ">
                        Data Hasil Keputusan
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Nama Alternatif</th>
                                    <th>Keputusan Jurusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($rank) != 0) {
                                    $no = 1;
                                    for ($i = 0; $i < count($rank); $i++) {
                                ?>
                                        <tr>
                                            <td><?php echo $rank[$i]['nama'] ?></td>
                                            <td><?php
                                                if ($rank[$i]['hasil'] > 9) {?>
                                                    IPA
                                                <?php
                                                }else {?>
                                                    IPS
                                                <?php    
                                                }
                                            ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </section>
          </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?= $this->endSection() ?>