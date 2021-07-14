<? $this->extend('layout/template');?>
<? $this->section('content');?>
<div class="row">
    <div class="col-md-3 col-sm-6 col-6 equel-grid">
        <div class="grid">
            <div class="grid-body">
                <p class="text-dark text-center">Surat Masuk</p>
                <div class="d-flex justify-content-around align-items-center mt-3 mb-2">
                    <button class="btn btn-rounded social-icon-btn btn-warning"><span class="bx bx-receipt"></span></button>
                    <p class="bx-2"><?= 5?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-6 equel-grid">
        <div class="grid">
            <div class="grid-body">
                <p class="text-dark text-center">Surat Keluar</p>
                <div class="d-flex justify-content-around align-items-center mt-3 mb-2">
                    <button class="btn btn-rounded social-icon-btn btn-info"><span class="bx bx-receipt"></span></button>
                    <p class="bx-2"><?= 0?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-6 equel-grid">
        <div class="grid">
            <div class="grid-body">
                <p class="text-dark text-center">Instansi</p>
                <div class="d-flex justify-content-around align-items-center mt-3 mb-2">
                    <button class="btn btn-rounded social-icon-btn btn-success"><span class="bx bx-receipt"></span></button>
                    <p class="bx-2"><?= 0?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-6 equel-grid">
        <div class="grid">
            <div class="grid-body">
                <p class="text-dark text-center">Kategori</p>
                <div class="d-flex justify-content-around align-items-center mt-3 mb-2">
                    <button class="btn btn-rounded social-icon-btn btn-dark"><span class="bx bx-receipt"></span></button>
                    <p class="bx-2"><?= 0?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<? $this->endSection();?>