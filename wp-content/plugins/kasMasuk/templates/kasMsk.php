<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</head>
<body>
    <div class="container bg-light py-3">
        <h1><b>Riwayat Kas Masuk</b></h1>
        <div class="row">
            <hr> <br>
            <?php
                $tampil_data = $data;
                foreach ($tampil_data as $data) {
                    $uangMasuk += $data->debet;
                }
            ?>
            <div class="col-md-9">
                <button class="btn btn-lg btn-warning mx-2"  data-bs-toggle="modal" data-bs-target="#exampleModalTiga" data-bs-whatever="@getbootstrap"><span class="dashicons dashicons-search mt-1 mb-1"></span></button>
                <?php if($uangMasuk != 0){ ?>
                    <button class="btn btn-danger btn-lg btn-secondary"  data-bs-toggle="modal" data-bs-target="#exampleModalEmpat" data-bs-whatever="@getbootstrap"><span class="dashicons dashicons-printer mt-1 mb-1"></span></button>
                    <?php } ?>
            </div>
            <div class="modal mt-4 fade" id="exampleModalTiga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="exampleModalLabel">Cari Berdasarkan Bulan</h5>
                            <button type="button" class="btn-close" style="width:10px;height:10px;margin-right:10px" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="font-size:18px">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <!-- <label for="recipient-name" class="col-form-label"><b>Pilih Bulan</b></label> -->
                                    <!-- {% comment %} <input type="month" class="form-control" required="required" name="tanggal" id="recipient-name"> {% endcomment %} -->
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
                <div class="modal-header bg-danger text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
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
            <div class="col-md-3 ml-auto mr-1">
                <?=  $bulan == null? "<h6>Total Uang Masuk</h6>":"<h6>Total Uang Masuk Berdasarkan Pencarian</h6>"?>
                <h4><b><?= $uangMasuk != 0?"Rp ". number_format($uangMasuk,2,',','.'):"-" ?></b></h4>
            </div>
        </div>
        <!-- Table untuk menampilkan data dari hasil query diatas -->
        <table class="table mt-3" style="font-size:15px">
        <tr class="table-info">
            <th><center>No.</center></th>
            <th><center>Tanggal Dana Masuk</center></th>
            <th><center>Sumber Dana</center></th>
            <th><center>Jumlah Uang Masuk</center></th>
            <th><center>Pilihan</center></th>
        </tr>
        <?php
        $no = 1;
        $uangMasuk = 0;
        foreach ($tampil_data as $data) { ?>
        <tr>
            
            <td><center><?= $no++ ?></center></td>
            <td><center><?= $data->tanggal ?></center></td>
            <td><?= $data->nama ?></td>
            <td><center><?= $data->debet? "Rp". number_format($data->debet,2,',','.'): '<center>-</center>' ?></center></td>
            <td>
                <center>
                    <!-- <a href="<?php// admin_url().'/admin.php?page=kas-masuk&act=edit&id='.$data->id; ?>">Ubah</a> -->
                    <button class="btn btn-lg btn-primary"  data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $data->id ?>" data-bs-whatever="@getbootstrap"><span class="dashicons dashicons-edit pt-1"></span></button>
                    <button class="btn btn-lg btn-danger"  data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $data->id ?>" data-bs-whatever="@getbootstrap"><span class="dashicons dashicons-trash pt-1"></span></button></a>
                </center>
            </td>
        </tr>
        
        <div class="modal m-4 fade" id="ModalEdit<?= $data->id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Uang Masuk</h5>
                            <button type="button" class="btn-close" style="width:10px;height:10px;margin-right:10px" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php
                        $id = $data->id;
                        $where = "WHERE wphb_kas_penerimaan.id=".$id;
                        $ambilData = showAll('kas_penerimaan', $where);
                        foreach ($ambilData as $dataSaatIni) { ?>
                        <div class="modal-body" style="font-size:18px">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <input type="hidden" name="aksi" value="edit">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <label for="namaEdit" class="col-form-label"><b>Sumber Dana</b></label>
                                    <input type="text" class="form-control" name="namaEdit" value="<?= $dataSaatIni->nama ?>">

                                    <label for="uangEdit" class="col-form-label"><b>Jumlah Uang Masuk</b></label>
                                    <input type="number" class="form-control" name="uangEdit" value="<?= $data->debet?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary w-25" onClick="javascript:location.reload(true)"><b>Simpan</b></button>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                </div>
            </div>
        </div>
                
        <div class="modal m-4 fade" id="ModalHapus<?= $data->id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-light">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                            <button type="button" class="btn-close" style="width:10px;height:10px;margin-right:10px" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php
                        $id = $data->id;
                        $where = "WHERE wphb_kas_penerimaan.id=".$id;
                        $ambilData = showAll('kas_penerimaan', $where);
                        foreach ($ambilData as $dataSaatIni) { ?>
                        <div class="modal-body" style="font-size:18px">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <input type="hidden" name="aksi" value="hapus">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <label for="namaEdit" class="col-form-label"><b>Apakah anda yakin ingin menghapus data kas masuk dengan sumber dana dari <?= $data->nama ?> ?</b></label>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary w-25"><b>Hapus</b></button>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <?php if ($tampil_data == null) { ?>
            <tr>
                <td colspan="5"><center>Data Tidak Ditemukan</center></td>
            </tr>
        <?php } ?>

    </table>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<?php if($_SESSION['editSukses']){ ?>
            <script>
                swal({
                    title: "Selamat", 
                    text: "Perubahan Data Berhasil Disimpan!", 
                    type: "success"
                },
                    function(){ 
                        location.reload();
                    }
                    );
            </script>
<?php unset($_SESSION['editSukses']); } ?>
<?php if($_SESSION['hapusSukses']){ ?>
        <script>
            swal({
                title: "Selamat", 
                text: "Anda Berhasil Menghapus Data!", 
                type: "success"
                },
            function(){ 
                location.reload();
            }
            );
        </script>
<?php unset($_SESSION['hapusSukses']); } ?>

</html>
