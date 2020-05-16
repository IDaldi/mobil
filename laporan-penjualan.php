<?php
session_start();
if(!isset($_SESSION['nama_pengguna'])){
	echo "<script>location.href='login.php'</script>";
}
 // Define relative path from this script to mPDF
 $nama_dokumen= $date = date('Y-m-d | H:i:s') ; //Beri nama file PDF hasil.
define('_MPDF_PATH','MPDF57/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak masalah.-->
<!--CONTOH Code START-->
<?php
 //KONEKSI
$host="localhost"; //isi dengan host anda. contoh "localhost"
$user="root"; //isi dengan username mysql anda. contoh "root"
$password="12345678"; //isi dengan password mysql anda. jika tidak ada, biarkan kosong.
$database="mobil";//isi nama database dengan tepat.
mysql_connect($host,$user,$password);
mysql_select_db($database);
?>

<style type="text/css">
p{
	
	font-style:bold;
	font-size:12px
}
h4, h1, h5, h2{
	text-align:center;
	padding-top:inherit;
	
}
table {
   border-collapse:collapse;
   width:100%;
}
 
table, td {
   border:1px solid black;
}

th{
	border:1px solid black;
	background-color:#BFBFBF;
}
 

</style>
<h2>BENGKEL MOBIL PEKANBARU</h2>
<h5>Jl, PEKANBARU No.123 RIAU, Kec. Senapelan (+628)2300013550</h5>
<hr>

</tr>
</table>
<h4>LAPORAN SERVICE</h4>
<?php 
if(isset($_GET['tgl_beli'])){
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tgl_beli']."</a></h4>";
}
?>
<p align="left">Nama Kasir: <?php echo $_SESSION['nama_pengguna'] ?></p>
<p align="left">Tanggal & Jam dicetak: <?php date_default_timezone_set("Asia/Jakarta"); echo $date = date('d-m-Y |  H:i:s'); ?> </p>

<table >
<thead>
<tr>
<th>Nama Mekanik</td>
<th>Sparepart</td>
<th>Qty</td>
<th>Harga Sparepart</td>
<th>Harga Jasa</td>
<th>No Polisi</td>
<th>Jumlah</td>
<th>Tanggal</td>


</tr>
</thead>
<?php 
$tgl_beli = isset($_GET['tgl_beli']) ? $_GET['tgl_beli'] : die('ERROR: missing ID.');
$sql=mysql_query("SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart where tgl_beli=$tgl_beli");
while($data=mysql_fetch_assoc($sql)){
?>
<tbody><tr>
<td><?php echo $data['nama_mekanik']?></td>
<td><?php echo $data['sparepart']?></td>
<td><?php echo $data['qty']?></td>
<td><?php echo $data['harga']?></td>
<td><?php echo $data['harga_jasa']?></td>
<td><?php echo $data['NoPolisi']?></td>
<td>
<?php 
	$hs= $data['harga'];
	$qt= $data['qty'];
	$hj= $data['harga_jasa'];
	$tot = ($hs * $qt) + $hj;
	echo"$tot";

			
			?>
</td>
<td><?php echo $data['tgl_beli']?></td>
</tr></tbody>';
<?php
}
?>
</table>

<!--CONTOH Code END-->
 
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>