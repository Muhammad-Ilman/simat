<? $this->extend('layout/template');?>
<? $this->section('content');?>
            <div class="row">
              <div class="col-sm-7">
                <div class="grid">
                  <div class="grid-header">
                	<h1 class="">TAMBAH DATA SURAT KELUAR</h1>
                	<p style="font-size: 9px">Masukan data disini !</p>
                </div>
                  <div class="grid-body">
                    <a href="<?= base_url('suratkeluar'); ?>" class="btn btn-dark mt-3 mb-3"><i class='bx bx-receipt'></i> Lihat data</a>
                    <div class="item-wrapper">
                      <form action="<?= base_url('suratkeluar/save'); ?>" method="post" enctype="multipart/form-data">
                      	<?= csrf_field();?>
                        <div class="form-group">
                          <label for="nama">Nama / judul Surat</label>
                          <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ; ?>" id="nama" name="nama" placeholder="Masukan nama surat" value="<?= old('nama');?>">
                           <div class="invalid-feedback">
                        		<?= $validation->getError('nama'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : '' ; ?>" id="tanggal" name="tanggal" value="<?= old('judul');?>">
                           <div class="invalid-feedback">
                        		<?= $validation->getError('tanggal'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                          <label for="nomor">Nomor</label>
                          <input type="text" class="form-control <?= ($validation->hasError('nomor')) ? 'is-invalid' : '' ; ?>" id="nomor" name="nomor" placeholder="Masukan nomor surat" value="<?= old('nomor');?>">
                           <div class="invalid-feedback">
                        		<?= $validation->getError('nomor'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                          <label for="lampiran">Jumlah Lampiran</label>
                          <input type="number" class="form-control <?= ($validation->hasError('lampiran')) ? 'is-invalid' : '' ; ?>" id="lampiran" name="lampiran" placeholder="Masukan jumlah lampiran" value="<?= old('lampiran');?>">
                           <div class="invalid-feedback">
                        		<?= $validation->getError('lampiran'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                          <label for="perihal">Perihal</label>
                          <input type="text" class="form-control <?= ($validation->hasError('perihal')) ? 'is-invalid' : '' ; ?>" id="perihal" name="perihal" placeholder="Masukan perihal surat" value="<?= old('perihal');?>">
                           <div class="invalid-feedback">
                        		<?= $validation->getError('perihal'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                          <label for="deskripsi">Deskripsi</label>
                          <textarea type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ; ?>" id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi surat" cols="12" rows="5" value="<?= old('deskripsi');?>"></textarea>
                           <div class="invalid-feedback">
                        		<?= $validation->getError('deskripsi'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                          <label for="tertanda">Tertanda</label>
                          <input type="text" class="form-control  <?= ($validation->hasError('tertanda')) ? 'is-invalid' : '' ; ?>" id="tertanda" name="tertanda" placeholder="Masukan tertanda surat" value="<?= old('tertanda');?>">
                           <div class="invalid-feedback">
                        		<?= $validation->getError('tertanda'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                          <label for="tembusan">Tembusan</label>
                          <input type="text" class="form-control  <?= ($validation->hasError('tembusan')) ? 'is-invalid' : '' ; ?>" id="tembusan" name="tembusan" placeholder="Masukan tembusan surat" value="<?= old('tembusan');?>">
                           <div class="invalid-feedback">
                        		<?= $validation->getError('tembusan'); ?>
                   			</div>
                        </div>
                        <div class="form-group">
                        	<label for="file_surat">File Surat</label>
                        	<div class="custom-file">
                                <input type="file" name="file_surat" class="custom-file-input form-control <?= ($validation->hasError('file_surat')) ? 'is-invalid' : '' ; ?>" id="file_surat" value="<?= old('file_surat');?>" onchange="previewImg()">
                                <small class="text-danger" style="font-size:7px;"><a>Upload file gambar atau pdf !</a></small>
                                 <div class="invalid-feedback">
                        		<?= $validation->getError('file_surat'); ?>
                   			</div>
                   		
                                <label class="custom-file-label" for="file_surat">Pilih file</label>
                        	</div>
                        </div>
                        <div class="form-group">
                        	<label for="instansi">Instansi Penerima</label>
  	                    <?php foreach ($instansi as $in): ?>

                        	<select class="custom-select form-control <?= ($validation->hasError('instansi')) ? 'is-invalid' : '' ; ?>" id="instansi" name="instansi" required>
                                <option selected>Pilih instansi</option>
                                <option value="<?= $in->id;?>"><?= $in->nama;?></option>
                            </select>
                            <small style="font-size:7px;"><a href="<?= base_url('instansi/create'); ?>">Tambah instansi baru</a></small>
                             <div class="invalid-feedback">
                        		<?= $validation->getError('instansi'); ?>
                   			</div>
                        <?php endforeach; ?>
                        </div>
                        <div class="form-group"> 
                        	<label for="kategori">Kategori surat</label>
  	                    <?php foreach ($kategori as $kt): ?>

                        	<select class="custom-select form-control  <?= ($validation->hasError('kategori')) ? 'is-invalid' : '' ; ?>" id="kategori" name="kategori" required>
                                <option selected>Pilih Kategori</option>
                                <option value="<?= $kt->id;?>"><?= $kt->nama;?></option>
                            </select>
                            <small style="font-size:7px;"><a href="<?= base_url('kategori/create'); ?>">Tambah kategori baru</a></small>
                             <div class="invalid-feedback">
                        		<?= $validation->getError('kategori'); ?>
                   			</div>
                            
                        <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                          <label for="tag">Tag</label>
                          <input type="text" class="form-control" id="tag" name="tag" placeholder="Masukan tag surat">
                        </div>
                        
                        
                        <button type="submit" class="btn btn-sm btn-primary">Tambah Surat</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
        	    <img src="<?=base_url('assets/images/default-surat.png');?>" alt="gambar default" width="350px" class="img-preview">
            </div>
            </div>
<? $this->endSection();?>