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
                <h3 class="card-title">Tambah Kriteria</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="/kriteria">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" name="nama" class="form-control" id="nama_kriteria" placeholder="Input Kriteria">
                  </div>
                  <div class="form-group">
                    <label for="bobot_kriteria">Bobot</label>
                    <input type="number" name="bobot" class="form-control" id="bobot_kriteria" placeholder="Input Bobot Kriteria">
                  </div>
                  <div class="form-group">
                    <label for="nama_kriteria">Kategori</label>
                    <select class="form-control" name="kategori">
                        <option value="benefit">Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Tambah</button>
                  <a href="/kriteria" class="btn btn-primary">Kembali</a>
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