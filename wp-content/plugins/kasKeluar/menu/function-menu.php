<?php

add_action('admin_menu', 'menuKeluar');
function menuKeluar(){
    add_menu_page(
        __('KAS KELUAR'),
        'Kas Keluar',
        'manage_options',
        'kas-keluar',
        'kas_keluar',
        'dashicons-upload',
        6
    );
}

function kas_keluar()
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
        $andWhere = "WHERE wphb_kas_harian.tanggal LIKE '". $formatTanggal."'";
        $data = showAll('kas_pengeluaran',$andWhere);
    }else if($bulan != null && $tahun == 0){
        $formatTanggal = '%/'.$bulan.'/%';
        $andWhere = "WHERE wphb_kas_harian.tanggal LIKE '". $formatTanggal."'";
        $data = showAll('kas_pengeluaran',$andWhere);
        
    }else if($tahun != null && $bulan == null){
        $formatTanggal = '%/'.$tahun;
        $andWhere = "WHERE wphb_kas_harian.tanggal LIKE '". $formatTanggal."'";
        $data =  showAll('kas_pengeluaran', $andWhere);
    }
    if($bulan == null && $tahun == null ){
        $formatTanggal = '%/'.date('m/Y');
        $andWhere = "WHERE wphb_kas_harian.tanggal LIKE '". $formatTanggal."'";
        $data =  showAll('kas_pengeluaran', $andWhere);
    }
    if($print != null){
        $andWhere = "WHERE wphb_kas_harian.tanggal LIKE '". $tggl."'";
        $data = showAll('kas_pengeluaran',$andWhere);
        if($print == 'excel'){
            // cetakExcel($data);
            cetakExcelKeluarMasuk($data, 'keluar');
        }else{
            // echo "OTW cetak PDF";
            cetakPdfKeluarMasuk($data, 'keluar');
        }
    }
    
    if ($id && $aksi !=null) {
        if ($aksi == 'edit') {
            $dataUpdate = [
                    'nama' => $namaEdit,
                    'uang' => $uangEdit,
                    'jenis'=> 'keluar'
            ];
            $cek = editData('kas_pengeluaran', $id, $dataUpdate);
            if ($cek == 'ok') {
                $_SESSION["editSukses"] = 'Perubahan Berhasil Disimpan';
            }
        }else if ($aksi == 'hapus') {
            $dataDelete = [
                    'jenis' => 'keluar',
            ];
            $cek = hapusData('kas_pengeluaran', $id, $dataDelete);
            if ($cek == 'ok') {
                $_SESSION["hapusSukses"] = 'Perubahan Berhasil Disimpan';
            }
        }
    }
    include KAS_KELUAR_DIR.'index.php';
 }
?>