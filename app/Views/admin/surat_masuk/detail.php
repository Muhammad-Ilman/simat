<? $this->extend('layout/template');?>
<? $this->section('content');?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="grid">
        	<div class="grid-header">
        		<h1>Detail Surat <?= $surat_masuk->sm_nama ;?></h1>
        		<p style="font-size: 8px">Hash : <a href="<?= base_url('suratmasuk/'. $surat_masuk->sm_slug); ?>"><?=  $surat_masuk->sm_slug; ?> <span class='bx bxs-rocket bx-tada text-success'></span></a></p>
        	</div>
            <div class="grid-body text-gray" id="print-area">
			<div class="table-responsive">
			    
				<table class="table">
					<tr>
						<td>Id Surat</td>
						<td><?= $surat_masuk->sm_id; ?></td>
					</tr>
					<tr>
						<td>Nama Surat</td>
						<td><?= $surat_masuk->sm_nama; ?></td>
					</tr>
					<tr>
						<td>Tanggal Surat</td>
						<td><?= $surat_masuk->tanggal; ?></td>
					</tr>
					<tr>
						<td>Nomor Surat</td>
						<td><?= $surat_masuk->nomor; ?></td>
					</tr>
					<tr>
						<td>Lampiran Surat</td>
						<td><?= $surat_masuk->lampiran; ?> Lembar</td>
					</tr>
					<tr>
						<td>Perihal Surat</td>
						<td><?= $surat_masuk->perihal; ?></td>
					</tr>
					<tr>
						<td>Deskripsi Surat</td>
						<td><?= $surat_masuk->sm_deskripsi; ?></td>
					</tr>
					<tr>
						<td>Tertanda Surat</td>
						<td><?= $surat_masuk->tertanda; ?></td>
					</tr>
					<tr>
						<td>Tembusan Surat</td>
						<td><?= $surat_masuk->tembusan; ?></td>
					</tr>
					<tr>
						<td>Pengirim Surat</td>
						<td><?= $surat_masuk->in_nama; ?></td>
					</tr>
					<tr>
						<td>Penerima Surat</td>
						<td><?= $surat_masuk->penerima; ?></td>
					</tr>
					<tr>
						<td>Kategori Surat</td>
						<td><?= $surat_masuk->ka_nama; ?></td>
					</tr>
					<tr>
						<td>Status Surat</td>
						<td><?= $surat_masuk->status; ?></td>
					</tr>
					<tr>
						<td>Tag Surat</td>
						<td><?= $surat_masuk->tag; ?></td>
					</tr>
					<tr>
						<td>Diupload Pada</td>
						<td><?= $surat_masuk->sm_created; ?></td>
					</tr>
					<tr>
						<td>Dipulihkan Pada</td>
						<td><?= $surat_masuk->sm_restored; ?></td>
					</tr>
					<tr>
						<td>Terakhir diubah</td>
						<td><?= $surat_masuk->sm_updated; ?></td>
					</tr>
				</table>
			</div>
				<div class="text-right mt-3">
					<a href="<?= base_url('suratmasuk'); ?>" class="btn btn-inverse-primary mt-2"><i class='bx bx-undo bx-fade-left' ></i> Kembali</a>
					<a href="<?= base_url('suratmasuk/print/'. $surat_masuk->sm_slug ); ?>" class="btn btn-inverse-warning mt-2"><i class='bx bxs-printer bx-tada' > </i> Cetak</a>
					<a href="<?= base_url('suratmasuk/download/'. $surat_masuk->sm_slug); ?>" class="btn btn-inverse-success mt-2"><i class='bx bxs-download bx-fade-up' ></i> Download</a>
				</div>
            </div>
        </div>
    </div>
</div>

<? $this->endSection();?>