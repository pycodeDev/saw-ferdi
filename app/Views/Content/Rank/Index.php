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
                        Data Perangkingan
                        <?php
                        if ($jml > 0) { ?>
                            <a href="/eksekusi" class="btn btn-success btn-sm float-right text-white"><i class="fas fa-search"></i> Eksekusi Perangkingan</a>
                        <?php
                        } else { ?>
                            <button type="button" class="btn btn-sm btn-success float-right text-white" title="Tidak ada Data" disabled>
                                <i class="fa fa-search"></i> Eksekusi Perangkingan
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Alternatif</th>
                                    <th>Data Sudah di Input?</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($rank) != 0) {
                                    $no = 1;
                                    for ($i = 0; $i < count($rank); $i++) {
                                ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $rank[$i]['nama_alternatif'] ?></td>
                                            <td><span class="<?= $rank[$i]['status'] == 'sudah' ? "badge badge-success" : "badge badge-danger" ?>"><?= $rank[$i]['status'] ?></span></td>
                                            <td class="text-center">
                                                <a style="border-radius:50%" href="/rank/add/<?php echo $rank[$i]['id_alternatif'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye text-white"></i></a>
                                                <a href="/rank/<?php echo $rank[$i]['id_alternatif'] ?>" style="border-radius:50%" class="btn btn-sm btn-danger"><i class="fa fa-trash text-white"></i></a>
                                            </td>
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