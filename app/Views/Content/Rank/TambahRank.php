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
                        <div class="card-header">
                            Data Alternatif
                        </div>
                        <div class="card-body">
                            <strong>Nama Alternatif : <?php echo $alternatif[0]['nama'] ?></strong>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($d_alter); $i++) {
                                    ?>
                                        <td style="font-size:12px;text-align:center;font-weight:bold"><?php echo $d_alter[$i]['nama_kriteria'] ?></td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($d_alter); $i++) {
                                    ?>
                                        <td style="font-size:12px;text-align:center;font-weight:bold"><?php echo $d_alter[$i]['bobot'] ?></td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card card-dark">
                        <div class="card-header">
                            Tambah Data Perangkingan
                        </div>
                        <form method="POST" action="/rank/<?php echo $alternatif[0]['id'] ?>">
                            <div class="card-body">
                                <?= csrf_field(); ?>
                                <?php
                                for ($i = 0; $i < sizeof($form); $i++) {
                                ?>
                                    <div class="form-group row">
                                        <label for="nama_kriteria" class="col-sm-4 col-form-label"><?= key($form[$i]) ?></label>
                                        <div class="col-sm-8">
                                            <select name="kriteria_<?= $i + 1 ?>" class="form-control">
                                                <?php
                                                $a = 0;
                                                foreach ($form[$i][key($form[$i])][0] as $key) :
                                                ?>
                                                    <option value="<?= $key[key($key)] ?>"><?= key($key) ?></option>
                                                <?php
                                                    $a++;
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-footer text-muted">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="/rank" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
<?= $this->endSection() ?> 