
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="{{ asset('public/css/print.css') }}" media="print">
	<link rel="stylesheet" href="{{ asset('public/css/print.css') }}" media="screen">
</head>
<body>
	<div class="cetak">
		<h1 style="text-align: center;"><?php echo strtoupper($title) ?>
    <br>PT SPLN
    </h1>

    <table class="table">
      <tbody>
        <tr>
          <td>Tanggal</td>
          <td><?php echo $pengajuan->tgl_permohonan ?></td>
        </tr>
        <tr>
          <td>ID Transaksi</td>
          <td><?php echo $pengajuan->id_layanan ?> Pcs</td>
        </tr>
        <tr>
          <td>Kepada Yth. Bapak/Ibu/Sdr</td>
          <td><?php echo $pengajuan->nama_konsumen ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td><?php echo $pengajuan->alamat ?></td>
          <td><?php echo $pengajuan->kabupaten ?>, <?php echo $pengajuan->provinsi ?></td>
        </tr>
      </tbody>
    </table>
    <hr>
    <hr>
    <br>Dengan hormat,
    <br>Sehubungan dengan permohonan <?php echo strtoupper($title) ?> yang Bapak/Ibu/Sdr, atas pelanggan :
    <table class="table">
      <tbody>
        <tr>
          <td>Nama</td>
          <td><?php echo $pengajuan->nama_konsumen ?></td>
        </tr>
        <tr>
          <td>ID Transaksi</td>
          <td><?php echo $pengajuan->id_layanan ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td><?php echo $pengajuan->alamat ?></td>
          <td><?php echo $pengajuan->kabupaten ?>, <?php echo $pengajuan->provinsi ?></td>
        </tr>
        <tr>
          <td>Tarif Baru</td>
          <td><?php echo $pengajuan->sifat_instalasi ?></td>
        </tr>
        <tr>
          <td>Daya Baru</td>
          <td><?php echo $pengajuan->daya ?></td>
        </tr>
      </tbody>
    </table>

    <br>Dapat dipenuhi dengan rincian berikut,
    <table class="table">
      <tbody>
        <tr>
          <td>Biaya Penyambungan</td>
          <td>Rp <?php echo $pengajuan->biaya ?></td>
        </tr>
        <tr>
          <td>Biaya Token</td>
          <td>Rp <?php echo $pengajuan->token ?> Pcs</td>
        </tr>
        <tr>
          <td>Biaya PPN</td>
          <td>Rp <?php echo $pengajuan->ppn ?></td>
        </tr>
        <tr>
          <td>Biaya PPJ</td>
          <td>Rp <?php echo $pengajuan->ppj ?></td>
        </tr>
        <tr>
          <td>Bea Materai</td>
          <td>Rp <?php echo $pengajuan->materai ?></td>
        </tr>
        <tr>
          <td>Total Biaya</td>
          <td>Rp <?php echo $pengajuan->total ?></td>
        </tr>
      </tbody>
    </table>

    <br>Apabila pada saat penyambungan listrik, PT SPLN menemukan peruntukan penggunaan listrik tidak sesuai yang dimohon, maka PLN secara sepihak akan melakukan perubahan peruntukan ke tarif yang seharusnya atau PLN akan mengembalikan seluruh biaya permohonan kepada pelanggan (kecuali Bea Materai).
    <br>Selanjutnya silahkan Bapak/Ibu/Sdr melakukan konfirmasi dengan memasukkan kode transaksi <?php echo $pengajuan->id_layanan ?>  pada http://www.pln.co.id/pelanggan/layanan-online/entri-kode-konfirmasi dalam kurun waktu 1x24 jam untuk mendapatkan nomor registrasi pembayaran.
    <br>
    <br>Atas perhatian Bapak/Ibu/Sdr kami ucapkan terima kasih.
    <br>
    <br>Hormat kami
    <br>
    <br>PT SPLN
    <br>
    <small>* Email ini bersifat informasi dan tidak dapat di reply</small>
	</div>
</body>
</html>