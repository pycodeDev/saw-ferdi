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
                    <h3 class="card-title">Data Ranking</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <a href="/laporan/cetak" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak</a>
                    <br/>
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Nama Alternatif</th>
                          <th>Hasil</th>
                          <th>Jurusan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        if (count($rank) != 0) {
                          foreach ($rank as $val) {?>
                            <tr>
                              <td><?php echo $val["nama"]; ?></td>
                              <td><b><?php echo $val["hasil"]; ?></b></td>
                              <td><b><?php echo $val['hasil'] > 9 ? "IPA" : "IPS" ?></td>
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