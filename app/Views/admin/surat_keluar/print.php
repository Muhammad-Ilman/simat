<? $this->extend('layout/print');?>
<? $this->section('content');?>

<div class="container">
<center> 
	<h6 class="">Sistem Informasi dan Manajemen Surat</br><small>SIMAT APPLICATION</small><br><small class="text-primary mt-0" style="font-size:8px">Jalan Cipadang Lampegan Km.12 Desa Cibokor, Kec. Cibeber, kab. Cianjur 43262</small></h6>

</center>
<style>
	table tr {
		height: 35px;
	}
</style>
 <hr class="mt-4 mb-3" style="border-color:black;border-radius:6px">
 
  <div class="mt-5">
                   	<table width="100%">
					<tr>
						<td>Id Surat</td>
						<td>: <?= $surat_keluar->sm_id; ?></td>
					</tr>
					<tr>
						<td>Nama Surat</td>
						<td>: <?= $surat_keluar->sm_nama; ?></td>
					</tr>
					<tr>
						<td>Tanggal Surat</td>
						<td>: <?= $surat_keluar->tanggal; ?></td>
					</tr>
					<tr>
						<td>Nomor Surat</td>
						<td>: <?= $surat_keluar->nomor; ?></td>
					</tr>
					<tr>
						<td>Lampiran Surat</td>
						<td>: <?= $surat_keluar->lampiran; ?> Lembar</td>
					</tr>
					<tr>
						<td>Perihal Surat</td>
						<td>: <?= $surat_keluar->perihal; ?></td>
					</tr>
					<tr>
						<td>Deskripsi Surat</td>
						<td>: <?= $surat_keluar->sm_deskripsi; ?></td>
					</tr>
					<tr>
						<td>Tertanda Surat</td>
						<td>: <?= $surat_keluar->tertanda; ?></td>
					</tr>
					<tr>
						<td>Tembusan Surat</td>
						<td>: <?= $surat_keluar->tembusan; ?></td>
					</tr>
					<tr>
						<td>Penerima Surat</td>
						<td>: <?= $surat_keluar->in_nama; ?></td>
					</tr>
					<tr>
						<td>Pengirim Surat</td>
						<td>: <?= $surat_keluar->pengirim; ?></td>
					</tr>
					<tr>
						<td>Kategori Surat</td>
						<td>: <?= $surat_keluar->ka_nama; ?></td>
					</tr>
					<tr>
						<td>Status Surat</td>
						<td>: <?= $surat_keluar->status; ?></td>
					</tr>
					<tr>
						<td>Tag Surat</td>
						<td>: <?= $surat_keluar->tag; ?></td>
					</tr>
					<tr>
						<td>Diupload Pada</td>
						<td>: <?= $surat_keluar->sm_created; ?></td>
					</tr>
					<tr>
						<td>Terakhir diubah</td>
						<td>: <?= $surat_keluar->sm_updated; ?></td>
					</tr>
				</table>
                   </div>
                 
	<div class="text-right mt-4">
		<p style="font-size: 10px">Dicetak Oleh : <?= user()->username;?></p>
		<p style="font-size: 8px" class="text-primary mb-5"><?=  $surat_keluar->sm_slug; ?></p>
		<p class="mt-5 text-dark"><u>Fullname Admin</u></p>
		<p style="font-size: 9px">NIM. 00000000</p>
	</div>
</div>
 
 <?= $this->endSection();?>