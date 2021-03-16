<!DOCTYPE html>
<html>

<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
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
	<table>
		<tr align='left'>
			<th align='left'> <?php echo $data->tgl_permohonan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='50%'> No. Pendaftaran </th>
			<th align='left'> : </th>
			<th align='left'> <?php echo $data->id_layanan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='50%'> Tanggal </th>
			<th align='left'> : </th>
			<th align='left'> <?php echo $data->tgl_permohonan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='50%'> Tanggal </th>
			<th align='left'> : </th>
			<th align='left'> <?php echo $data->tgl_permohonan ?> </th>
		</tr>
	</table>
	Dengan Hormat,
	Sehubungan dengan permohonan <?php echo $data->layanan ?> yang Bapak/Ibu/Sdr, dengan permohonan sebagai berikut :
	<table>
		<tr align='left'>
			<th align='left'> <?php echo $data->tgl_permohonan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='50%'> No. Pendaftaran </th>
			<th align='left'> : </th>
			<th align='left'> <?php echo $data->id_layanan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='50%'> Tanggal </th>
			<th align='left'> : </th>
			<th align='left'> <?php echo $data->tgl_permohonan ?> </th>
		</tr>
		<tr align='left'>
			<th align='left' width='50%'> Tanggal </th>
			<th align='left'> : </th>
			<th align='left'> <?php echo $data->tgl_permohonan ?> </th>
		</tr>
	</table>


</body>

</html>