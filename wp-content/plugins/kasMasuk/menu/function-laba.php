<?php
/**
 * STEP 2
 * Membuat Menu Laba di Admin
 */
session_start();
 add_action('admin_menu', 'menuMasuk');
 function menuMasuk()
 {
    add_menu_page(
        __('KAS MASUK'),
        'Kas Masuk',
        'manage_options',
        'kas-masuk',
        'kas_masuk',
      //   'dashicons-admin-generic',
      //   'dashicons-format-asside',
      //   'dashicons-media-spreadsheet',
      //   'dashicons-external'
      //   'dashicons-plus',
      //   'dashicons-minus',
      //   'dashicons-search',
      //   'dashicons-printer',
      //   'dashicons-insert',
      //   'dashicons-remove',
        'dashicons-download',
        6
    );
 }

function kas_masuk()
 {
   
   $tggl = isset($_POST['tggl'])? $_POST['tggl'] : '';
   $bulan = isset($_POST['bulan'])? $_POST['bulan'] : '';
   $tahun = isset($_POST['tahun'])? $_POST['tahun'] : '';
   $print = isset($_POST['ctk']) ? $_POST['ctk'] :'';

   $id       = isset($_POST['id']) ? $_POST['id'] :'';
   $aksi     = isset($_POST['aksi']) ? $_POST['aksi'] :'';
   $namaEdit = isset($_POST['namaEdit']) ? $_POST['namaEdit'] :'';
   $uangEdit = isset($_POST['uangEdit']) ? $_POST['uangEdit'] :'';

   if($bulan && $tahun != null ){
         $formatTanggal = '%/'.$bulan.'/'.$tahun;
         $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND is_delete = 0";
         $data = showAll('kas_penerimaan',$andWhere);
   }else if($bulan != null && $tahun == 0){
         $formatTanggal = '%/'.$bulan.'/%';
         $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND is_delete = 0";
         $data = showAll('kas_penerimaan',$andWhere);
   }else if($tahun != null && $bulan == null){
         $formatTanggal = '%/'.$tahun;
         $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND is_delete = 0";
         $data =  showAll('kas_penerimaan', $andWhere);
   }
   if($bulan == null && $tahun == null ){
         $formatTanggal = '%/'.date('m/Y');
         $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND is_delete = 0";
         $data =  showAll('kas_penerimaan', $andWhere);
   }
   if($print != null){
         $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $tggl."' AND is_delete = 0";
         $data = showAll('kas_penerimaan',$andWhere);
         if($print == 'excel'){
           // cetakExcel($data);
            cetakExcelKeluarMasuk($data, 'masuk');
         }else{
           // echo "OTW cetak PDF";
            cetakPdfKeluarMasuk($data, 'masuk');
         }
   }

   if ($id && $aksi !=null) {
      if ($aksi == 'edit') {
            $dataUpdate = [
                  'nama' => $namaEdit,
                  'uang' => $uangEdit,
                  'jenis'=> 'masuk'
            ];
            $cek = editData('kas_penerimaan', $id, $dataUpdate);
            if ($cek == 'ok') {
                  $_SESSION["editSukses"] = 'Perubahan Berhasil Disimpan';
            }
      }else if ($aksi == 'hapus') {
            $dataDelete = [
                    'jenis' => 'masuk',
            ];
            $cek = hapusData('kas_penerimaan', $id, $dataDelete);
            if ($cek == 'ok') {
                  $_SESSION["hapusSukses"] = 'Perubahan Berhasil Disimpan';
            }
      }
   }
   include LABA_DIR.'kasMsk.php';
}

?>