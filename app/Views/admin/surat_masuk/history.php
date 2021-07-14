<? $this->extend('layout/template');?>
<? $this->section('content');?>
<div class="col-lg-12">
                <div class="grid">
                <div class="grid-header">
                	<h1>SAMPAH SURAT MASUK</h1>
                	            
            <?php if(session()->getFlashData('suratmasuk')) : ?>
                <div class="alert alert-info mt-2 mb-1" role="alert">
					<div class="d-flex">
                    	<p><?= session()->getFlashData('suratmasuk');?></p>
						<i class='bx bxs-badge-check bx-tada' ></i>
					</div>
                </div>
            <?php endif ?>
            
                	<p style="font-size: 8px">Manage data disini !</p>
                </div>
                  <div class="mt-4 mb-4 ml-4 mr-4">
                      
                      
                      
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
                            	<span class="text-warning"><i class="bx bx-layer"> </i><?= $sm['lampiran'] ;?></span>
                            </td>
                            <td><?= $sm['perihal'] ;?></td>
                            <td><?= $sm['in_nama']?></td>
                            <td><i class="text-dark">@</i><?= $sm['penerima'] ;?></td>                        
                            <td class="actions">
                              <div class="btn-group">
                            	<div class="actions-print-download">
									<a href="<?= base_url('suratmasuk/restore/'. $sm['sm_slug']); ?>" class="btn btn-rounded social-icon-btn btn-inverse-info"><i class='bx bxs-archive-out bx-tada' ></i></a>
								 <form action="<?= base_url('/suratmasuk/del/'.$sm['sm_slug']); ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                
                                <button type="submit" class="btn  btn-rounded social-icon-btn btn-danger" onclick="return confirm('apakah kamu yakin akan menghapus data ini ?')"><i class='bx bxs-trash bx-fade-down' ></i></button>
                            </form>
								</div>
		                        <button type="button" class="btn btn-trasnparent action-btn btn-xs component-flat pr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                          <i class="bx bx-dots-vertical-rounded"></i>
		                        </button>
		                        <div class="dropdown-menu dropdown-menu-right">
		                          <a class="dropdown-item" href="<?= base_url('/suratmasuk/'.$sm['sm_slug']);?>">Detail</a>
		                          <a class="dropdown-item" href="#">Edit</a>
		                        </div>
		                      </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="text-center">
                       <?= $History;?> Sampah
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
                "sZeroRecords": "Yah, data yang diminta tidak tersedia",
                "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
                "sInfoFiltered": "(di filter dari _MAX_ total data)",
                "oPaginate": {
                    "sFirst": "<<",
                    "sLast": ">>",
                    "sPrevious": "<i class='bx bx-caret-left-circle text-info bx-tada' ></i>",
                    "sNext": "<i class='bx bx-caret-right-circle text-info bx-tada' ></i>"
               }
            },
             columnDefs: [{
        targets: [0],
        orderable: false
     }],
    "ordering": true,
    "info": true,

  
            });
        } );
    </script>
<? $this->endSection();?>