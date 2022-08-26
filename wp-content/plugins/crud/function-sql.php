<?php
// Tampil DATA
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function tampilSemuaData($andWhere=''){
    global $wpdb;

    // $sql = "SELECT * FROM ". $table_name ." WHERE 1".$andwhere;
    $sql = "SELECT wphb_kas_harian.id, wphb_kas_harian.tanggal, CONCAT(IFNULL(wphb_kas_pengeluaran.nama, ' '), IFNULL(wphb_kas_penerimaan.nama, ' ')) AS nama, wphb_kas_penerimaan.debet, wphb_kas_pengeluaran.kredit, wphb_kas_harian.saldo FROM wphb_kas_harian LEFT JOIN wphb_kas_penerimaan ON wphb_kas_penerimaan.kas_harian_id = wphb_kas_harian.id LEFT
    JOIN wphb_kas_pengeluaran ON wphb_kas_pengeluaran.kas_harian_id = wphb_kas_harian.id ".$andWhere." AND CONCAT(IFNULL(wphb_kas_penerimaan.is_delete, ' '), IFNULL(wphb_kas_pengeluaran.is_delete,' ')) = 0 ORDER BY wphb_kas_harian.id ASC ";
    $query = $wpdb->get_results($sql);
    
    return $query;
}
function pemasukan($data = [])
{
    global $wpdb;
    
    $table_name = $wpdb->prefix.'kas_harian';
    $table_nameDua = $wpdb->prefix.'kas_penerimaan';
    // var_dump($table_nameDua);
    // die;
    $sql = "SELECT id, saldo FROM ".$table_name." WHERE wphb_kas_harian.saldo >1 ORDER BY id DESC limit 1";
    $query = $wpdb->get_results($sql);
    foreach ($query as $saldo) {
        $saldo_id = $saldo->id;
        $saldo_jumlah = $saldo->saldo;
    }
        $kas_harian_id      = $saldo_id;
        $saldo_terbaru      = $saldo_jumlah + $data['debet'];
        $tanggal            = date('d/m/Y');
        $nama               = $data['nama'];
        $debet              = $data['debet'];
        
        $insertHarian = $wpdb->insert($table_name, [
            'tanggal' => $tanggal,
            'saldo'   => $saldo_terbaru
        ]);
        if ($insertHarian != false) {
            $sql = "SELECT id, saldo FROM ".$table_name." WHERE wphb_kas_harian.saldo >1 ORDER BY id DESC limit 1";
            $query = $wpdb->get_results($sql);
            foreach ($query as $saldo) {
                $saldo_id = $saldo->id;
                $saldo_jumlah = $saldo->saldo;
            }
            $wpdb->insert($table_nameDua,[
                'kas_harian_id' => $saldo_id,
                'nama'  => $nama,
                'debet' => $debet
            ]);
        }

    return 'ok';
}

function pengeluaran($data = [])
{
    global $wpdb;
    
    $table_name = $wpdb->prefix.'kas_harian';
    $table_nameDua = $wpdb->prefix.'kas_pengeluaran';
    // var_dump($table_nameDua);
    // die;
    $sql = "SELECT id, saldo FROM ".$table_name." ORDER BY id DESC limit 1";
    $query = $wpdb->get_results($sql);
    foreach ($query as $saldo) {
        $saldo_id = $saldo->id;
        $saldo_jumlah = $saldo->saldo;
    }
        $kas_harian_id      = $saldo_id;
        $saldo_terbaru      = $saldo_jumlah - $data['kredit'];
        $tanggal            = date('d/m/Y');
        $nama               = $data['nama'];
        $kredit              = $data['kredit'];
        
        $insertHarian = $wpdb->insert($table_name, [
            'tanggal' => $tanggal,
            'saldo'   => $saldo_terbaru
        ]);
        if ($insertHarian != false) {
            $sql = "SELECT id, saldo FROM ".$table_name." ORDER BY id DESC limit 1";
            $query = $wpdb->get_results($sql);
            foreach ($query as $saldo) {
                $saldo_id = $saldo->id;
                $saldo_jumlah = $saldo->saldo;
            }
            $wpdb->insert($table_nameDua,[
                'kas_harian_id' => $saldo_id,
                'nama'  => $nama,
                'kredit' => $kredit
            ]);
        }
    return 'ok';
}

function insertData($nama_tabel, $data=[])
{
    global $wpdb;

    $table_name = $wpdb->prefix.$nama_tabel;
    $wpdb->insert($table_name, $data);
    $id_insert = $wpdb->insert_id;
    return $id_insert;
}
function cetakPDF($data)
{
    $dompdf = new Dompdf();
        $html = '<center><h3>LAPORAN KEUANGAN <br> TBTK AL-HIKMAH MULYOHARJO</h3></center><hr/><br/>';
        $html .= '<table style="margin-left:20px; margin-top:10px">
        <tr>
            <td>Tanggal cetak</td>
            <td>:</td>
            <td>'.date("d/m/Y").'</td>
        </tr>
        <tr>
            <td>Sisa Saldo</td>
            <td>:</td>
            <td> Rp '.number_format($data[0]->saldo,2,',','.').'</td>
        </tr>
    </table>
    <br>
    <br>
    ';
    $html .= '<table border="1" width="100%">
        <tr>
            <th><center>No</center></th>
            <th><center>Tanggal</center></th>
            <th><center>Aktivitas</center></th>
            <th><center>Debet</center></th>
            <th><center>Kredit</center></th>
            <th><center>Total Saldo</center></th>
        </tr>';

        $no = 1; 
        $tampil_data = $data;
        foreach ($tampil_data as $data) { 
        $html .= "<tr>";
        $html .= "<td>".$no++."</td>";
        $html .= "<td>".$data->tanggal."</td>";
        $data->nama != ' '? $html .= "<td>". $data->nama."</td>": $html .= "<td>Saldo Saat Ini</td>";
        $data->debet != null? $html .= "<td><center>Rp ". number_format($data->debet,2,',','.')."</center></td>": $html .= "<td><center>-</center></td>";
        $data->kredit != null? $html .= "<td><center>Rp ". number_format($data->kredit,2,',','.')."</center></td>": $html .= "<td><center>-</center></td>";
        $html .= "<td><center>Rp ". number_format($data->saldo,2,',','.')."</center></td>";
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
        $dompdf->stream('laporan_keuangan_'.$tanggal.'.pdf');
}
function cetakExcel($data)
{
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->mergeCells("A1:K1");
            $sheet->setCellValue('A1', 'LAPORAN KEUANGAN');
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
            
            $sheet->mergeCells("A2:K2");
            $sheet->setCellValue('A2', 'TBTK AL-HIKMAH MULYOHARJO');
            
            $sheet->mergeCells("A4:C4");
            $sheet->setCellValue('A4', 'Tanggal Cetak : 02/08/2022');
            $sheet->mergeCells("A5:C5");
            $sheet->setCellValue('A5', 'Sisa Saldo         : Rp '.$data[0]->saldo.',-' );
            

            $sheet->setCellValue('A6', 'No.');
            $sheet->setCellValue('B6', 'Tanggal');
            $sheet->setCellValue('D6', 'Nama');
            $sheet->setCellValue('F6', 'DEBET');
            $sheet->setCellValue('H6', 'KREDIT');
            $sheet->setCellValue('J6', 'SALDO');
            
            
            $sheet->mergeCells("B6:C6");
            $sheet->mergeCells("D6:E6");
            $sheet->mergeCells("F6:G6");
            $sheet->mergeCells("H6:I6");
            $sheet->mergeCells("J6:K6");
            
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
                $data->nama != '  ' ? $sheet->setCellValue('D'.$awal, $dt->nama):  $sheet->setCellValue('C'.$awal, '<center>Saldo Saat Ini</center>');

                $sheet->getStyle('F')->getNumberFormat()->setFormatCode('"Rp "_-* #,##0.00\ [$-415]_-');
                $sheet->getStyle('H')->getNumberFormat()->setFormatCode('"Rp "_-* #,##0.00\ [$-415]_-');
                $sheet->getStyle('J')->getNumberFormat()->setFormatCode('"Rp "_-* #,##0.00\ [$-415]_-');
                $sheet->setCellValue('F'.$awal, $dt->debet);
                $sheet->setCellValue('H'.$awal, $dt->kredit);
                $sheet->setCellValue('J'.$awal, $dt->saldo);
                $sheet->mergeCells("B".$awal.":C".$awal);
                $sheet->mergeCells("D".$awal.":E".$awal);
                $sheet->mergeCells("F".$awal.":G".$awal);
                $sheet->mergeCells("H".$awal.":I".$awal);
                $sheet->mergeCells("J".$awal.":K".$awal);
                $awal++;
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $tanggal = date('sHdmY');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="laporan_keuangan_'.$tanggal.'.xlsx"');
            ob_end_clean();
            $writer->save("php://output");
            die;
}
?>