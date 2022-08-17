<?php
/**
 * STEP 1
 * Membuat Menu di Admin
*/

add_action('admin_menu', 'menuCrud');

function menuCrud()
{
    add_menu_page(
        __('KAS HARIAN'),   //Judul Halaman
        'Kas Harian',       // Judul Menu
        'manage_options',           //Capability
        'manajemen-keuangan',        //slug
        'manajemen_keuangan',       // callback
        'dashicons-media-text',  //icon
        6                           //posisi menu
    );
}
function manajemen_keuangan(){
    $nama  = isset($_POST['nama'])? $_POST['nama'] : '';
    $debet = isset($_POST['debet'])? $_POST['debet'] : '';
    $kredit = isset($_POST['kredit'])? $_POST['kredit'] : '';
    $tggl = isset($_POST['tggl'])? $_POST['tggl'] : '';
    $bulan = isset($_POST['bulan'])? $_POST['bulan'] : '';
    $tahun = isset($_POST['tahun'])? $_POST['tahun'] : '';
    $print = isset($_POST['ctk']) ? $_POST['ctk'] :'';
    
    if ($nama && $debet != null) {
        $data = [
            'nama' => $nama,
            'debet'=> $debet,
        ];
        $insert = pemasukan($data);
        
        if ($insert != null) {
            $_SESSION["tambahSukses"] = 'Perubahan Berhasil Disimpan';
        }
        $andWhere = "WHERE wp_kas_harian.saldo >1";
        $data = tampilsemuadata($andWhere);
    }else if ($nama && $kredit != null) {
        $data = [
            'nama' => $nama,
            'kredit'=> $kredit,
        ];
        $insert = pengeluaran($data);
        if ($insert != null) {
            $_SESSION["kurangSukses"] = 'Perubahan Berhasil Disimpan';
        }
        $andWhere = "WHERE wp_kas_harian.saldo >1";
        $data = tampilsemuadata($andWhere);
        
    }else if($bulan && $tahun != null && $nama == null){
        $formatTanggal = '%/'.$bulan.'/'.$tahun;
        $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND wp_kas_harian.saldo >1";
        $data = tampilSemuaData($andWhere);
    }else if($bulan != null && $nama == null && $tahun == null){
        $formatTanggal = '%/'.$bulan.'/%';
        $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND wp_kas_harian.saldo >1";
        $data = tampilSemuaData($andWhere);
    }else if($tahun != null && $nama == null && $bulan == null){
        $formatTanggal = '%/'.$tahun;
        $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND wp_kas_harian.saldo >1";
        $data = tampilSemuaData($andWhere);
    }
    if($nama == null && $bulan == null && $tahun == null ){
        $formatTanggal = '%/'.date('m/Y');
        $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $formatTanggal."' AND wp_kas_harian.saldo >1";
        $data = tampilsemuadata($andWhere);
    }
    if($tggl && $print != null){
        $andWhere = "WHERE wp_kas_harian.tanggal LIKE '". $tggl."' AND wp_kas_harian.saldo >1";
        $data = tampilSemuaData($andWhere);
        
        if($print == 'excel'){
            cetakExcelKeluarMasuk($data, 'harian');
        }else{
            cetakPdfKeluarMasuk($data, 'harian');
        }
    }else if($tggl == null && $print !=null){
        if($print == 'excel'){
            cetakExcelKeluarMasuk($data, 'harian');
        }else{
            cetakPdfKeluarMasuk($data, 'harian');
        }
    }
    // var_dump($data);
        include TEMP_DIR.'tampil_tabel.php';

}

function pemasukan_keuangan()
{
    include TEMP_DIR.'tampil_pemasukan.php';
}
?>