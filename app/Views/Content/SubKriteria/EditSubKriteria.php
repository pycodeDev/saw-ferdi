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
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Kriteria</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kriteria">Nama Kriteria</label>
                        : <b><?php echo $kriteria[0]['nama'] ?></b>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Tambah Sub Kriteria</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="/sub/kriteria/edit/<?php echo $id; ?>">
                <div class="card-body">
                    <input type="hidden" name="kriteria_id" value="<?php echo $kriteria[0]['id']?>">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <div class="form-group">
                        <label for="nama_kriteria">Nama Sub Kriteria</label>
                        <input type="text" name="nama" class="form-control" id="nama_kriteria" placeholder="Input Kriteria" value="<?php echo $sub[0]['nama']?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_kriteria">Kategori Sub Kriteria</label>
                        <select class="form-control" name="nilai">
                            <option value="1" <?php echo $sub[0]['nilai'] == '1' ? "selected" : "" ?>>Sangat Kurang(SK)</option>
                            <option value="2" <?php echo $sub[0]['nilai'] == '2' ? "selected" : "" ?>>Kurang(K)</option>
                            <option value="3" <?php echo $sub[0]['nilai'] == '3' ? "selected" : "" ?>>Cukup(C)</option>
                            <option value="4" <?php echo $sub[0]['nilai'] == '4' ? "selected" : "" ?>>Baik(B)</option>
                            <option value="5" <?php echo $sub[0]['nilai'] == '5' ? "selected" : "" ?>>Sangat Baik(SB)</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-warning">Edit</button>
                  <a href="/sub/kriteria" class="btn btn-primary">Kembali</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </section>
        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?= $this->endSection() ?>