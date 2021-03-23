<?php

use Carbon\Carbon;

?>

<!DOCTYPE html>
<html>

<head>
	<title>Bukti Registrasi <?php echo $data->layanan ?> </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<style type="text/css">
		table tr td,
		table tr th {
			font-size: 9pt;
		}
	</style>
	<h1>PT. S-PLN</h1>
	<br>
	<table>
		<tr align='left'>
			<th align='left' width='10%'> No. Pendaftaran </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->id_layanan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Tanggal Pendaftaran</th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->tgl_permohonan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Kepada Yth. Bapak/Ibu/Sdr </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->nama_konsumen ?> </th>
		</tr>
	</table>
	<br>
	<p>Dengan Hormat,</p>
	<p style="  text-align: justify;
  text-justify: inter-word;">Sehubungan dengan permohonan <?php echo $data->layanan ?> yang Bapak/Ibu/Sdr, dengan permohonan sebagai berikut :</p>
	<table>
		<tr align='left'>
			<th align='left' width='20%'> Nama Pemohon </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->nama_konsumen ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Alamat </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='30%'> <?php echo $data->alamat ?>, Desa <?php echo $data->desa ?>, Kec. <?php echo $data->kec ?>, <?php echo $data->kab ?>, Prov. <?php echo $data->prov ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Nomer KTP </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->ktp ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Telepon </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->telp ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Whatsapp </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->whatsapp ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Email </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->email ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Jenis Box </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->jenisbox ?>
				@if($data->mdp == 1)
				, MDP
				@endif

				@if($data->sdp == 1)
				, SDP
				@endif
			</th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> MCB </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->grup_mcb ?> grup </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> LNB </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->grup_lnb ?> grup</th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> MCCB </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->grup_mccb ?> grup </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Trafo </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->grup_trafo ?> kV</th>
		</tr>
	</table>
	<br>
	Dapat disetujui dengan biaya total sebesar :
	<b><?php

		function rupiah($angka)
		{
			$format_rupiah = "Rp " . number_format($angka, 2, ',', '.');
			return $format_rupiah;
		}
		echo rupiah($data->total)
		?>
	</b>

	<p style="  text-align: justify;
  text-justify: inter-word;">Selanjutnya dipersilahkan Bapak/Ibu/Sdr melakukan pembayaran melalui kode bayar <?php echo $data->id_transaksi ?> selambat lambatnya 14 hari sejak diterimanya email konfirmasi ini atau paling lambat tanggal
		<?php

		function getToday($angka)
		{
			$mytime = Carbon::now();
			$mytime = $mytime->addDays($angka);
			// $mytime = Carbon::createFromFormat('d-m-Y', $mytime);
			echo $mytime->toDateString();
		}

		echo getToday(14)
		?>. Untuk informasi status permohonan
		Anda, bisa dipantau melalui alamat : http://www.spln.co.id/cekstatus</p>
	<p>Atas perhatian Bapak/Ibu/Sdr kami ucapkan terima kasih.
	<p>Hormat kami</p>
	<br>
	<br>
	<p>PT S-PLN</p>
	<br>
	* Email ini bersifat informasi dan tidak dapat di reply</p>
</body>

</html>