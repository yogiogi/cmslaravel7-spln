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
			<th align='left' width='20%'> Nomer Telepon </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->telp ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Nomer Whatsapp </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->whatsapp ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Email </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->email ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Jumlah Titik Lampu </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->titik_lampu ?> buah, biaya Rp <?php echo $data->biaya_titik_lampu ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Jumlah Titik Saklar </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->titik_saklar ?> buah, biaya Rp <?php echo $data->biaya_titik_saklar ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Jumlah Titik Stop Kontak </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->titik_stop_kontak ?> buah, biaya Rp <?php echo $data->biaya_titik_stop_kontak ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='20%'> Panjang Kabel Penghantar </th>
			<th align='left' width='2%'> : </th>
			<th align='left' width='40%'> <?php echo $data->meter_kabel ?> meter, jenis kabel <?php echo $data->jenis_kabel ?> </th>
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
  text-justify: inter-word;">Selanjutnya dipersilahkan Bapak/Ibu/Sdr melakukan pembayaran melalui salah satu rekening dibawah ini
		selambat lambatnya 14 hari sejak diterimanya email konfirmasi ini atau paling lambat tanggal
		<?php

		function getToday($angka)
		{
			$mytime = Carbon::now();
			$mytime = $mytime->addDays($angka);
			// $mytime = Carbon::createFromFormat('d-m-Y', $mytime);
			echo $mytime->toDateString();
		}

		echo getToday(14)
		?>. </p>
	<table>
		<?php $i = 1;
		foreach ($rekening as $rekening) { ?>
			<tr align='left'>
				<th align='left' width='10%'><?php echo $rekening->nama_bank ?> </th>
				<th align='left' width='2%'> <?php echo $rekening->nomor_rekening ?> </th>
				<th align='left' width='40%'> a.n <?php echo $rekening->atas_nama ?> </th>
			</tr>
		<?php $i++;
		} ?>
	</table>
	<br>
	<p style="  text-align: justify; text-justify: inter-word;">Lalu laporkan bukti pembayaran Anda dengan menggunakan kode bayar berikut <b><?php echo $data->id_transaksi ?></b> pada halaman pembayaran di website SPLN. Untuk informasi status permohonan
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