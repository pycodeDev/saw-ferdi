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
                    <h3 class="card-title">Data Kriteria</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <a href="/kriteria/tambah" class="btn btn-success btn-sm"><i class="fa fa-pen"></i> Tambah</a>
                    <br/>
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Id Kriteria</th>
                          <th>Nama Kriteria</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (count($data) != 0) {
                          foreach ($data as $val) {?>
                            <tr>
                              <td><?php echo $val["id"]; ?></td>
                              <td><b><?php echo $val["nama"]; ?></b></td>
                              <td>
                                <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                              </td>
                            </tr>
                        <?php
                          }
                        }else{?>
                            <tr><td colspan="3"><b>Tidak Ada Data !!!</b></td></tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
          </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?= $this->endSection() ?>