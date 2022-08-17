<?php

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function showAll($tableName, $andWhere = '')
{
    global $wpdb;

    $nama_tabel = $wpdb->prefix.$tableName;
    $sql = "SELECT ".$nama_tabel.".*,wp_kas_harian.tanggal AS tanggal FROM ".$nama_tabel." LEFT JOIN wp_kas_harian ON ".$nama_tabel.".kas_harian_id=wp_kas_harian.id ".$andWhere." AND ".$nama_tabel.".is_delete = 0 ORDER BY ".$nama_tabel.".id ASC";
    $query = $wpdb->get_results($sql);
    return $query;
}


function cetakPdfKeluarMasuk($data,$status='')
{
        $dompdf = new Dompdf();
        if ($status == 'masuk') {
            $sts = 'MASUK';
        }else if ($status == 'keluar') {
            $sts = 'KELUAR';
        }else if ($status == 'harian') {
            $sts = 'HARIAN';
        }
        $html = '<center><h3>LAPORAN KEUANGAN '.$sts.' <br> TBTK AL-HIKMAH MULYOHARJO</h3></center><hr/><br/>';
        $html .= '<table style="margin-left:20px; margin-top:10px">
        <tr>
            <td>Tanggal cetak</td>
            <td>:</td>
            <td>'.date("d/m/Y").'</td>
        </tr>';
        if ($status == 'harian') {
            $html.= "<tr>
                        <td>Sisa Saldo</td>
                        <td>:</td>
                        <td> Rp ".number_format($data[0]->saldo,2,',','.')."</td>
                    </tr>
                </table>
            <br>
            <br>
            ";
        }else{
            $html.="</table><br><br>";
        }
    $html .= '<table border="1" width="100%">
        <tr>
            <th><center>No</center></th>
            <th><center>Tanggal</center></th>';
        if ($status == 'harian') {
            $html.= "
                <th><center>Aktivitas</center></th>
                <th><center>Debet</center></th>
                <th><center>Kredit</center></th>
                <th><center>Total Saldo</center></th>";
        }else if($status == 'keluar'){
            $html.= "
                <th><center>Penggunaan Dana</center></th>
                <th><center>Jumlah Uang Keluar</center></th>
            ";
        }else if($status == 'masuk'){
            $html.= "
                <th><center>Sumber Dana</center></th>
                <th><center>Jumlah Uang Masuk</center></th>
            ";
        }
    $html.='</tr>';

        $no = 1; 
        $tampil_data = $data;
        foreach ($tampil_data as $data) { 
        $html .= "<tr>";
        $html .= "<td>".$no++."</td>";
        $html .= "<td>".$data->tanggal."</td>";

        if ($status == 'masuk') {
            $html .= "<td>". $data->nama."</td>";
            $data->debet != null? $html .= "<td><center>Rp ". number_format($data->debet,2,',','.')."</center></td>": $html .= "<td><center>-</center></td>";
        }else if ($status == 'keluar') {
            $html .= "<td>". $data->nama."</td>";
            $data->kredit != null? $html .= "<td><center>Rp ". number_format($data->kredit,2,',','.')."</center></td>": $html .= "<td><center>-</center></td>";
        }else if ($status == 'harian') {
            $data->nama != ' '? $html .= "<td>". $data->nama."</td>": $html .= "<td>Saldo Saat Ini</td>";
            $data->debet != null? $html .= "<td><center>Rp ". number_format($data->debet,2,',','.')."</center></td>": $html .= "<td><center>-</center></td>";
            $data->kredit != null? $html .= "<td><center>Rp ". number_format($data->kredit,2,',','.')."</center></td>": $html .= "<td><center>-</center></td>";
            $html .= "<td><center>Rp ". number_format($data->saldo,2,',','.')."</center></td>";
        }
        $html .= "</tr>";
    }
        $html .= "</table>";
        $html .= "</html>";
        $dompdf->loadHtml($html);
        // Setting ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'potrait');
        // Rendering dari HTML Ke PDF
        $dompdf->render();
        // Melakukan output file Pdf
        ob_end_clean();
        $tanggal = date('sHdmY');
        $dompdf->stream('laporan_kas_'.$status.'_'.$tanggal.'.pdf');
}
function cetakExcelKeluarMasuk($data, $status)
{
    if ($status == 'masuk') {
        $sts = 'MASUK';
    }else if ($status == 'keluar') {
        $sts = 'KELUAR';
    }else if ($status == 'harian') {
        $sts = 'HARIAN';
    }
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->mergeCells("A1:K1");
            $sheet->setCellValue('A1', 'LAPORAN KEUANGAN '.$sts);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
            
            $sheet->mergeCells("A2:K2");
            $sheet->setCellValue('A2', 'TBTK AL-HIKMAH MULYOHARJO');
            
            $sheet->mergeCells("A4:C4");
            $sheet->setCellValue('A4', 'Tanggal Cetak : 02/08/2022');
            $sheet->mergeCells("A5:C5");
            if ($status == 'harian') {
                $sheet->setCellValue('A5', 'Sisa Saldo         : Rp '.$data[0]->saldo.',-' );
            }

            $sheet->setCellValue('A6', 'No.');
            $sheet->setCellValue('B6', 'Tanggal');

            if ($status == 'harian') {
                $sheet->setCellValue('D6', 'Aktivitas');
                $sheet->setCellValue('F6', 'DEBET');
                $sheet->setCellValue('H6', 'KREDIT');
                $sheet->setCellValue('J6', 'SALDO');
                $sheet->mergeCells("H6:I6");
                $sheet->mergeCells("J6:K6");
            }else if($status == 'keluar'){
                $sheet->setCellValue('D6', 'Penggunaan Dana');
                $sheet->setCellValue('F6', 'Jumlah Uang Keluar');
            }else if($status == 'masuk'){
                $sheet->setCellValue('D6', 'Sumber Dana');
                $sheet->setCellValue('F6', 'Jumlah Uang Masuk');
            }
            
            $sheet->mergeCells("B6:C6");
            $sheet->mergeCells("D6:E6");
            $sheet->mergeCells("F6:G6");
            
            $sheet->getStyle('B6')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('D6')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('F6')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('H6')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('J6')->getAlignment()->setHorizontal('center');
            $sheet->getColumnDimension('D')->setWidth(30);

            $no = 1;
            $awal = 7;
            foreach ($data as $dt) {
                $sheet->setCellValue('A'.$awal, $no++);
                $sheet->setCellValue('B'.$awal, $dt->tanggal);

                if ($status == 'masuk') {
                    $sheet->setCellValue('D'.$awal, $dt->nama);
                    $sheet->setCellValue('F'.$awal, $dt->debet);
                }else if ($status == 'keluar') {
                    $sheet->setCellValue('D'.$awal, $dt->nama);
                    $sheet->setCellValue('F'.$awal, $dt->kredit);
                    
                }else if ($status == 'harian') {
                    $sheet->setCellValue('D'.$awal, $dt->nama);
                    $sheet->setCellValue('F'.$awal, $dt->debet);
                    $sheet->setCellValue('H'.$awal, $dt->kredit);
                    $sheet->setCellValue('J'.$awal, $dt->saldo);
                    
                    $sheet->mergeCells("H".$awal.":I".$awal);
                    $sheet->mergeCells("J".$awal.":K".$awal);
                }

                
                $sheet->getStyle('F')->getNumberFormat()->setFormatCode('"Rp "_-* #,##0.00\ [$-415]_-');
                $sheet->getStyle('H')->getNumberFormat()->setFormatCode('"Rp "_-* #,##0.00\ [$-415]_-');
                $sheet->getStyle('J')->getNumberFormat()->setFormatCode('"Rp "_-* #,##0.00\ [$-415]_-');
                
                // $data->nama != '  ' ? $sheet->setCellValue('D'.$awal, $dt->nama):  $sheet->setCellValue('C'.$awal, '<center>Saldo Saat Ini</center>');
                // $sheet->setCellValue('F'.$awal, $dt->debet);
                // $sheet->setCellValue('H'.$awal, $dt->kredit);
                // $sheet->setCellValue('J'.$awal, $dt->saldo);
                
                $sheet->mergeCells("B".$awal.":C".$awal);
                $sheet->mergeCells("D".$awal.":E".$awal);
                $sheet->mergeCells("F".$awal.":G".$awal);
                $awal++;
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $tanggal = date('sHdmY');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="laporan_keuangan_'.$status.'_'.$tanggal.'.xlsx"');
            ob_end_clean();
            $writer->save("php://output");
            die;
}

function editData($tabel, $id, $dataUpdate = [])
{
    global $wpdb;
    $namaBaru = $dataUpdate['nama'];
    $uangBaru = $dataUpdate['uang'];
    $jenis = $dataUpdate['jenis'];

    $nama_tabel = $wpdb->prefix.$tabel;
    if ($jenis == 'masuk') {
        $data = showAll($tabel, 'WHERE '.$nama_tabel.'.id = '.$id);
        foreach ($data as $dt) {
            $id_baru    =  $dt->id;
            $id_harian  = $dt->kas_harian_id;
            $debet      = $dt->debet;
        }
        $resetUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = saldo - ". $debet ." WHERE wp_kas_harian.id >= ".$id_harian);
        $updateNilai = $wpdb->query("UPDATE ".$nama_tabel." SET nama = '".$namaBaru."', debet = ". $uangBaru ." WHERE id = ".$id);
        $updateUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = saldo + ". $uangBaru ." WHERE wp_kas_harian.id >= ".$id_harian);
        $sql = "SELECT wp_kas_harian.id, wp_kas_harian.tanggal, CONCAT(IFNULL(wp_kas_pengeluaran.nama, ' '), IFNULL(wp_kas_penerimaan.nama, ' ')) AS nama, wp_kas_penerimaan.debet, wp_kas_pengeluaran.kredit, wp_kas_harian.saldo FROM wp_kas_harian LEFT JOIN wp_kas_penerimaan ON wp_kas_penerimaan.kas_harian_id = wp_kas_harian.id LEFT
                JOIN wp_kas_pengeluaran ON wp_kas_pengeluaran.kas_harian_id = wp_kas_harian.id WHERE wp_kas_harian.id >=". $id_harian." ORDER BY wp_kas_harian.id ASC ";
        $cariData = $wpdb->get_results($sql);
        foreach ($cariData as $dataCari) {
            $id_utama = $dataCari->id;
            $id_saldo = $id_utama-1;
            $saldoSebelumnya = $wpdb->get_results("SELECT saldo FROM wp_kas_harian WHERE id = ".$id_saldo);
            if ($dataCari->kredit == null) {
                $dataUang = $saldoSebelumnya[0]->saldo + $dataCari->debet;
                $updateUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = ". $dataUang ." WHERE wp_kas_harian.id >= ".$id_utama);
            }else if($dataCari->debet == null){
                $dataUang = $saldoSebelumnya[0]->saldo - $dataCari->kredit;
                $updateUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = ". $dataUang ." WHERE wp_kas_harian.id >= ".$id_utama);
            }
        }
    }else if($jenis == 'keluar'){
        $data = showAll($tabel, 'WHERE '.$nama_tabel.'.id = '.$id);
        foreach ($data as $dt) {
            $id_baru    =  $dt->id;
            $id_harian  = $dt->kas_harian_id;
            $kredit      = $dt->kredit;
        }
        $resetUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = saldo + ". $kredit ." WHERE wp_kas_harian.id >= ".$id_harian);
        $updateNilai = $wpdb->query("UPDATE ".$nama_tabel." SET nama = '".$namaBaru."', kredit = ". $uangBaru ." WHERE id = ".$id);
        $updateUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = saldo - ". $uangBaru ." WHERE wp_kas_harian.id >= ".$id_harian);
        $sql = "SELECT wp_kas_harian.id, wp_kas_harian.tanggal, CONCAT(IFNULL(wp_kas_pengeluaran.nama, ' '), IFNULL(wp_kas_penerimaan.nama, ' ')) AS nama, wp_kas_penerimaan.debet, wp_kas_pengeluaran.kredit, wp_kas_harian.saldo FROM wp_kas_harian LEFT JOIN wp_kas_penerimaan ON wp_kas_penerimaan.kas_harian_id = wp_kas_harian.id LEFT
                JOIN wp_kas_pengeluaran ON wp_kas_pengeluaran.kas_harian_id = wp_kas_harian.id WHERE wp_kas_harian.id >=". $id_harian." ORDER BY wp_kas_harian.id ASC ";
        $cariData = $wpdb->get_results($sql);
        foreach ($cariData as $dataCari) {
            $id_utama = $dataCari->id;
            $id_saldo = $id_utama-1;
            $saldoSebelumnya = $wpdb->get_results("SELECT saldo FROM wp_kas_harian WHERE id = ".$id_saldo);
            if ($dataCari->kredit == null) {
                $dataUang = $saldoSebelumnya[0]->saldo + $dataCari->debet;
                $updateUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = ". $dataUang ." WHERE wp_kas_harian.id >= ".$id_utama);
            }else if($dataCari->debet == null){
                $dataUang = $saldoSebelumnya[0]->saldo - $dataCari->kredit;
                $updateUang  = $wpdb->query("UPDATE wp_kas_harian SET saldo = ". $dataUang ." WHERE wp_kas_harian.id >= ".$id_utama);
            }
        }
    }
    return 'ok';
}
function hapusData($tabel, $id, $dataDelete = [] )
{
    global $wpdb;
    
    $jenis = $dataDelete['jenis'];
    
    $nama_tabel = $wpdb->prefix.$tabel;
    $cariDataTabel = showAll($tabel, 'WHERE '.$nama_tabel.'.id = '.$id);
    $dt = $cariDataTabel[0]->kas_harian_id - 1;
    $updateKas = $wpdb->query("UPDATE wp_kas_harian SET saldo = 0 WHERE id = ".$cariDataTabel[0]->kas_harian_id);
    
    //DATA YANG DIHAPUS MASIH DIHITUNG MESKI PUN SUDAH TAK UBAH NILAINYA DULU MENJADI NOLL
    if ($tabel =="kas_pengeluaran") {
        $updateMasukdanKeluar = $wpdb->query("UPDATE ".$nama_tabel." SET is_delete = 1,kredit = 0 WHERE id = ".$id);
    }else if ($tabel == "kas_penerimaan") {
        $updateMasukdanKeluar = $wpdb->query("UPDATE ".$nama_tabel." SET is_delete = 1,debet = 0 WHERE id = ".$id);
    }

    $cariSaldo = $wpdb->get_results("SELECT saldo from wp_kas_harian WHERE id = ".$dt);
    $saldo = $cariSaldo[0]->saldo;
    $sql = "SELECT wp_kas_harian.id, wp_kas_penerimaan.debet, wp_kas_pengeluaran.kredit, wp_kas_harian.saldo FROM wp_kas_harian LEFT JOIN wp_kas_penerimaan ON wp_kas_penerimaan.kas_harian_id = wp_kas_harian.id LEFT
            JOIN wp_kas_pengeluaran ON wp_kas_pengeluaran.kas_harian_id = wp_kas_harian.id WHERE wp_kas_harian.id > ".$cariDataTabel[0]->kas_harian_id." AND wp_kas_harian.saldo > 1 ORDER BY wp_kas_harian.id ASC ";
    $cariData = $wpdb->get_results($sql);
    foreach ($cariData as $data) {
        $id = $data->id;
        if($data->debet != null){
            $saldo = $saldo + $data->debet;
            $updateKas = $wpdb->query("UPDATE wp_kas_harian SET saldo = ".$saldo." WHERE id = ".$id);
        }else if($data->kredit != null){
            $saldo = $saldo - $data->kredit;
            $updateKas = $wpdb->query("UPDATE wp_kas_harian SET saldo = ".$saldo." WHERE id = ".$id);
        }
    }
    return 'ok';
}

?>