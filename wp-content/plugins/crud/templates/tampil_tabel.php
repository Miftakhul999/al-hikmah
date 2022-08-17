<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Css only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

</head>
<body>

    <div class="container bg-light py-3">
        
        <h1 style="text-align:left;">
            <b>Kas Harian</b>
        </h1>
        <hr>
        <?php
            $tampil_data = $data;
            $index = 0;
            foreach ($tampil_data as $dt) {
                $index ++;
            }
            $index -=1;
            // var_dump($dt->id);

        ?>
        <div class="row">
            <div class="col-md-9 pt-2">
                <button class="btn btn-md btn-primary mr-4"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><b><span class="dashicons dashicons-insert mt-1  mb-1"></span> Tambah Saldo</b></button>
                <button class="btn btn-md btn-info"  data-bs-toggle="modal" data-bs-target="#exampleModalDua" data-bs-whatever="@getbootstrap"><b><span class="dashicons dashicons-remove mt-1 mb-1"></span> Kurangi Saldo</b></button>
                <button class="btn btn-lg btn-warning mx-2"  data-bs-toggle="modal" data-bs-target="#exampleModalTiga" data-bs-whatever="@getbootstrap"><span class="dashicons dashicons-search mt-1 mb-1"></span></button>
                <?php if($tampil_data != null){ ?>
                    <button class="btn btn-danger btn-lg btn-secondary"  data-bs-toggle="modal" data-bs-target="#exampleModalEmpat" data-bs-whatever="@getbootstrap"><span class="dashicons dashicons-printer mt-1 mb-1"></span></button>
                    <?php } ?>
            </div>
            <div class="col-md-3 ml-auto mr-1">
                <?=  $bulan == null? "<h6>Sisa Saldo</h6>":"<h6>Sisa Saldo Berdasarkan Pencarian</h6>"?>
                    <h4><b><?= $data[0]->saldo?"Rp ". number_format($data[$index]->saldo,2,',','.'):"-" ?></b></h4>
            </div>
        </div>
    <div class="modal mt-4 fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Saldo</h5>
            <button type="button" class="btn-close" style="width:10px;height:10px;margin-right:10px" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="font-size:18px">
            <form method="POST" action="">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nama Aktivitas</label>
                <input type="text" class="form-control" required="required" name="nama" id="recipient-name">
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Nominal Masuk</label>
                <input type="number" class="form-control" name="debet" required="required" id="message-text">
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary w-25"><b>Simpan</b></button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>

    <div class="modal mt-4 fade" id="exampleModalTiga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-warning">
            <h5 class="modal-title" id="exampleModalLabel">Cari Berdasarkan Bulan dan Tahun</h5>
            <button type="button" class="btn-close" style="width:10px;height:10px;margin-right:10px" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="font-size:18px">
            <form method="POST" action="">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label"><b>Pilih Bulan</b></label>
                <select name="bulan" class="form-select form-select-lg py-2 mb-4 pr-6">
                    <option value="0" selected="selected" disabled="disabled">Isi Jika Ingin Memilih Berdasarkan Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <label for="recipient-name" class="col-form-label"><b>Pilih Tahun</b></label>
                <input type="number" name="tahun" placeholder="Isi Bagian Ini Jika Ingin Mencari Berdasarkan Tahun" class="form-control py-2">
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary w-25"><b>Cari</b></button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    
    <div class="modal mt-4 fade" id="exampleModalEmpat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title text-light" id="exampleModalLabel">Cetak Laporan</h5>
            <button type="button" class="btn-close" style="width:10px;height:10px;margin-right:10px" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="font-size:18px">
            <form method="POST" action="">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label"><b>Cetak Sebagai : </b></label>
                <input type="hidden" name="tggl" value="<?= $formatTanggal ?>">
                <select name="ctk" id="ctk" class="form-control" style="width:100px;margin-left:20px">
                    <option value="pdf">PDF</option>
                    <option value="excel">EXCEL</option>
                </select>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary w-25"><b>Cetak</b></button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade mt-4" id="exampleModalDua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Kurangi Saldo</h5>
            <button type="button" class="btn-close" style="width:10px;height:10px" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="font-size:18px">
            <form method="POST" action="">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nama Aktivitas</label>
                <input type="text" class="form-control" required="required" name="nama" id="recipient-name">
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Nominal Keluar</label>
                <input type="number" class="form-control" name="kredit" required="required" id="message-text">
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary w-25"><b>Simpan</b></button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>

        <!-- Table untuk menampilkan data dari hasil query diatas -->
    <table class="table mt-3" style="font-size:15px">
        <tr class="table-info">
            <th><center>No</center></th>
            <th><center>Tanggal</center></th>
            <th><center>Aktivitas</center></th>
            <th><center>Debet</center></th>
            <th><center>Kredit</center></th>
            <th><center>Total Saldo</center></th>
        </tr>
        <?php 
            $no = 1; 
            foreach ($tampil_data as $data) { ?>
        <tr>
            <td><center><?= $no++ ?></center></td>
            <td><center><?= $data->tanggal ?></center></td>
            <!-- Pengkondisian Jika nilai nama kosong maka akan diganti kata Saldo Saat ini -->
            <td><?= $data->nama != '  '? $data->nama: 'Saldo Saat Ini' ?></td>

            <!-- Pengkondisian Jika nilai debet kosong maka akan diganti tanda - -->
            <td><center><?= $data->debet? "Rp". number_format($data->debet,2,',','.'): '<center>-</center>' ?></center></td>

            <!-- Pengkondisian Jika nilai kredit kosong maka akan diganti tanda - -->
            <td><center><?= $data->kredit? "Rp". number_format($data->kredit,2,',','.'): '<center>-</center>' ?></center></td>
            <td><center><?= "Rp". number_format($data->saldo,2,',','.') ?> </center></td>
        </tr>
        <?php } ?>
        <?php if ($tampil_data == null) { ?>
            <tr>
                <td colspan="6"><center>Data Tidak Ditemukan</center></td>
            </tr>
        <?php } ?>
        
    </table>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<?php if($_SESSION['tambahSukses']){ ?>
            <script>
                swal({
                    title: "Selamat", 
                    text: "Anda Berhasil Menambah data kas masuk!", 
                    type: "success"
                }
                );
            </script>
<?php unset($_SESSION['tambahSukses']); } ?>
<?php if($_SESSION['kurangSukses']){ ?>
        <script>
            swal({
                title: "Selamat", 
                text: "Anda Berhasil Menambah data kas Keluar!", 
                type: "success"
                }
            );
        </script>
<?php unset($_SESSION['kurangSukses']); } ?>

</html>