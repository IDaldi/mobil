<?php
  
include "header.php";
?>
<?php
session_start();
if(!isset($_SESSION['nama_pengguna'])){
	echo "<script>location.href='login.php'</script>";
}

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
   border:2px solid black;
}

th{
	border:2px solid black;
	background-color:#BFBFBF;
}
 

</style>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tgl_beli" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<?php 
			$pil=mysql_query("select distinct tgl_beli from 213_pembelian order by tgl_beli desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['tgl_beli'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>

</form>
<br/>
<?php 
if(isset($_GET['tgl_beli'])){
	$tgl_beli=mysql_real_escape_string($_GET['tgl_beli']);
	$tg="laporan-penjualan.php?tgl_beli='$tgl_beli'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>Cetak</a><?php
}else{
	$tg="laporan-penjualan.php";
}
?>
<?php 
if(isset($_GET['tgl_beli'])){
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tgl_beli']."</a></h4>";
}
?>

<br/>
</br>
</br>
<h2>BENGKEL MOBIL PEKANBARU</h2>
<h5>Jl, PEKANBARU No.123 RIAU, Kec. Senapelan (+628)2300013550</h5>
<hr>

</tr>
</table>
<h4>LAPORAN SERVICE</h4>
<p align="left">Nama Kasir: <?php echo $_SESSION['nama_pengguna'] ?></p>
<p align="left">Tanggal : <?php date_default_timezone_set("Asia/Jakarta"); echo $date = date('d-m-Y |  H:i:s'); ?> </p>

<table width="100%" class="table table-striped table-bordered" >
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
if(isset($_GET['tgl_beli'])){
	$tgl_beli=mysql_real_escape_string($_GET['tgl_beli']);
	$sql=mysql_query("SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart where tgl_beli like '$tgl_beli' order by tgl_beli desc");

	}else{
	$sql=mysql_query("SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart ORDER BY id_pembelian DESC");
	}while($data=mysql_fetch_array($sql)){
?>
		<tbody>
			<tr>
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
				<td>
					<?php echo $data['tgl_beli']?>
				</td>
			</tr>
		</tbody>
<?php
}
?>
</table>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
<?php include "footer.php"; ?>

<!--CONTOH Code END-->