<? $this->extend('layout/template');?>
<? $this->section('content');?>
<div class="col-lg-12">
                <div class="grid">
                <div class="grid-header">
                	<h1 class="">DATA SURAT MASUK</h1>
            <?php if(session()->getFlashData('suratmasuk')) : ?>
                <div class="alert alert-info mt-2 mb-1" role="alert">
					<div class="d-flex">
                    	<p><?= session()->getFlashData('suratmasuk');?></p>
						<i class='bx bxs-badge-check bx-tada' ></i>
					</div>
                </div>
            <?php endif ?>
                <p style="font-size: 9px">Manage data disini !</p>
                </div>
                  <div class="mt-4 mb-4 ml-4 mr-4">
                      <a href="<?= base_url('suratmasuk/create'); ?>" class="btn btn-info mt-3 mb-3"><i class='bx bx-plus'></i> Surat Baru</a>
                      <a href="<?= base_url('suratmasuk/history'); ?>" class="btn btn-secondary mt-3 mb-3"><i class='bx bx-history'></i> History</a>
                    <div class="table-responsive">
                      <table class="table table-hover mt-4 mb-4" id="table-surat">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Surat</th>
                            <th>Lampiran</th>
                            <th>Perihal</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        <?php $i = 1; foreach ( $suratmasuk as $sm ) : ?>
               
                          <tr>
                            <td>    
                      <?php  if ($sm["status"] == "Diupload"): ?>
                       <sup class="spinner-grow spinner-grow-sm text-success" role="status" aria-hidden="true"></sup>
                      <?php endif; ?>
                      <?php  if ($sm["status"] == "Restored"): ?>
                       <sup class="spinner-grow spinner-grow-sm text-info" role="status" aria-hidden="true"></sup>
                      <?php endif; ?>
                            <?= $i++; ?></td>
                            <td class="d-flex align-items-center border-top-0">
                            	
                              <a href="<?= base_url('/suratmasuk/'.$sm['sm_slug']);?>" class="text-dark"><?= $sm['sm_nama'];?></a>
                             
                           
                              
                            </td>
                            <td>
                            	<span class="text-primary"><i class="bx bx-layer"> </i><?= $sm['lampiran'] ;?></span>
                            </td>
                            <td><?= $sm['perihal'] ;?></td>
                            <td><?= $sm['in_nama']?></td>
                            <td><i class="text-dark">@</i><?= $sm['penerima'] ;?></td>                        
                            <td class="actions">
                              <div class="btn-group">
                            	<div class="actions-print-download">
									<a href="<?= base_url('suratmasuk/print/'. $sm['sm_slug']); ?>" class="btn btn-rounded social-icon-btn btn-inverse-info"><i class='bx bxs-printer bx-tada' > </i></a>
									<a href="<?= base_url('suratmasuk/download/'. $sm['sm_slug']); ?>" class="btn btn-rounded social-icon-btn btn-inverse-success"><i class='bx bxs-download bx-fade-up' ></i></a>
									<a id="trash" class="btn btn-rounded social-icon-btn btn-inverse-warning" 
									data-toggle="modal" 
									data-target="#trash-modal" 
									data-namasurat="<?= $sm['sm_nama'];?>"
									data-link="<?= $sm['sm_slug'];?>"
									><i class='bx bxs-trash bx-fade-down text-warning' ></i></a>
									

								</div>
		                        <button type="button" class="btn btn-trasnparent action-btn btn-xs component-flat pr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                          <i class="bx bx-dots-vertical-rounded"></i>
		                        </button>
		                        <div class="dropdown-menu dropdown-menu-right">
		                          <a class="dropdown-item" href="<?= base_url('/suratmasuk/'.$sm['sm_slug']);?>">Detail</a>
		                          <a class="dropdown-item" href="<?= base_url('/suratmasuk/update/'.$sm['sm_slug']);?>">Edit</a>
		                        </div>
		                      </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="text-center">
                       <?= $jumlah;?> Surat Masuk
                    </div>
                  </div>
                </div>
              </div>

    <div class="modal fade" id="trash-modal" tabindex="-1" aria-labelledby="peringatan" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-warning" id="peringatan"><span class="bx bx-alert"></span>Peringatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Hati - hati anda akan menghapus <span id="nama_surat"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            <a id="slug_url" class="btn btn-warning" href="">Hapus</a>
          </div>
        </div>
      </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#table-surat').DataTable({
                "processing" : true,
                "lengthMenu": [10, 15, 20, 25, 40, 50, "All"],
                "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_",
                    "sSearch": "Cari Surat : ",
                    "sZeroRecords": "Yah, data yang diminta tidak ditemukan",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
                    "sInfoFiltered": "(pencaria dari _MAX_ total data)",
                    "oPaginate": {
                        "sFirst": "<<",
                        "sLast": ">>",
                        "sPrevious": "<i class='bx bx-caret-left text-info bx-tada' ></i>",
                        "sNext": "<i class='bx bx-caret-right text-info bx-tada' ></i>"
                   }
                },
                columnDefs: [{
                targets: [0],
                orderable: false
            }],
                "ordering": true,
                "info": true,
            });
            
            $(document).on('click', '#trash', function() {
                var namaSurat = $(this).data('namasurat')
                var link = $(this).data('link')
               $('#nama_surat').text(namaSurat);
               $('#slug_url').attr('href', '<?= base_url('suratmasuk/trash');?>/'+link);
            })
        } );
    </script>
<? $this->endSection();?>