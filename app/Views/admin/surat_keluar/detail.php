<? $this->extend('layout/template');?>
<? $this->section('content');?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="grid">
        	<div class="grid-header">
        		<h1>Detail Surat <?= $surat_keluar->sm_nama ;?></h1>
        		<p style="font-size: 8px">Hash : <a href="<?= base_url('suratkeluar/'. $surat_keluar->sm_slug); ?>"><?=  $surat_keluar->sm_slug; ?> <span class='bx bxs-rocket bx-tada text-success'></span></a></p>
        	</div>
            <div class="grid-body text-gray" id="print-area">
			<div class="table-responsive">
			    
				<table class="table">
					<tr>
						<td>Id Surat</td>
						<td><?= $surat_keluar->sm_id; ?></td>
					</tr>
					<tr>
						<td>Nama Surat</td>
						<td><?= $surat_keluar->sm_nama; ?></td>
					</tr>
					<tr>
						<td>Tanggal Surat</td>
						<td><?= $surat_keluar->tanggal; ?></td>
					</tr>
					<tr>
						<td>Nomor Surat</td>
						<td><?= $surat_keluar->nomor; ?></td>
					</tr>
					<tr>
						<td>Lampiran Surat</td>
						<td><?= $surat_keluar->lampiran; ?> Lembar</td>
					</tr>
					<tr>
						<td>Perihal Surat</td>
						<td><?= $surat_keluar->perihal; ?></td>
					</tr>
					<tr>
						<td>Deskripsi Surat</td>
						<td><?= $surat_keluar->sm_deskripsi; ?></td>
					</tr>
					<tr>
						<td>Tertanda Surat</td>
						<td><?= $surat_keluar->tertanda; ?></td>
					</tr>
					<tr>
						<td>Tembusan Surat</td>
						<td><?= $surat_keluar->tembusan; ?></td>
					</tr>
					<tr>
						<td>Penerima Surat</td>
						<td><?= $surat_keluar->in_nama; ?></td>
					</tr>
					<tr>
						<td>Pengirim Surat</td>
						<td><?= $surat_keluar->pengirim; ?></td>
					</tr>
					<tr>
						<td>Kategori Surat</td>
						<td><?= $surat_keluar->ka_nama; ?></td>
					</tr>
					<tr>
						<td>Status Surat</td>
						<td><?= $surat_keluar->status; ?></td>
					</tr>
					<tr>
						<td>Tag Surat</td>
						<td><?= $surat_keluar->tag; ?></td>
					</tr>
					<tr>
						<td>Diupload Pada</td>
						<td><?= $surat_keluar->sm_created; ?></td>
					</tr>
					<tr>
						<td>Dipulihkan Pada</td>
						<td><?= $surat_keluar->sm_restored; ?></td>
					</tr>
					<tr>
						<td>Terakhir diubah</td>
						<td><?= $surat_keluar->sm_updated; ?></td>
					</tr>
				</table>
			</div>
				<div class="text-right mt-3">
					<a href="<?= base_url('suratkeluar'); ?>" class="btn btn-inverse-primary mt-2"><i class='bx bx-undo bx-fade-left' ></i> Kembali</a>
					<a href="<?= base_url('suratkeluar/print/'. $surat_keluar->sm_slug ); ?>" class="btn btn-inverse-warning mt-2"><i class='bx bxs-printer bx-tada' > </i> Cetak</a>
					<a href="<?= base_url('suratkeluar/download/'. $surat_keluar->sm_slug); ?>" class="btn btn-inverse-success mt-2"><i class='bx bxs-download bx-fade-up' ></i> Download</a>
				</div>
            </div>
        </div>
    </div>
</div>

<? $this->endSection();?>