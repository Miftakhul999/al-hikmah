<?php
/*
* Plugin Name: Manajemen Keuangan
* Plugin URI: https://manajemenkeuangan.com
* Description: Plugin ini digunakan untuk menangani berbagai macam input keuangan seperti pemasukan, pengeluaran, laba, dan neraca nya
* Author: TBTK AL-HIKMAH MULYOHARJO
// * Author URI:  isi medsos tk dari alhikmah
* Version: 1.0
*/


// add_shortcode('plugin_saya', 'text_satu');
// function text_satu(){
//     $text = '
//         <form action="" method="post">
//         <div class="input-group">
//         <label>Pemasukan</label>
//         <input class="input-form" type="number">
//         </div>
//         </form>';
//     return $text;
// }
define('TEMP_DIR', plugin_dir_path(__FILE__). '/templates/');

include 'menu/function-menu.php';
// include 'menu/function-menu.php';
include 'function-sql.php';
require_once('pemasukan.php');
require 'PHPExcel/vendor/autoload.php';
require_once('pengeluaran.php');
ob_start();
require_once('dompdf/autoload.inc.php');
ob_start();
?>