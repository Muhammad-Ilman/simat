<div class="sidebar">
        <div class="user-profile">
          <div class="display-avatar animated-avatar">
            <img class="profile-img img-lg rounded-circle" src="<?= base_url('assets/images/'); ?>/<?= user()->user_image?>" alt="gambar">
          </div>
          <div class="info-wrapper">
            <p class="user-name"><span class="text-muted">@</span><?= user()->username;?></p>
            
            <p class="display-income">Administrator</p>
          </div>
        </div>
        <ul class="navigation-menu">
          <li class="nav-category-divider">MENU</li>
          <li>
            <a href="<?= base_url(); ?>" class="sidebar-link sidebar-link-active">
              <span class="">Dashboard</span>
              <i class="bx bxl-redux link-icon"></i>
            </a>
          </li>
          <li>
            <a href="#surat-masuk" class="sidebar-link" data-toggle="collapse" aria-expanded="false">
              <span class="link-title">Surat Masuk</span>
              <i class="bx bx-book-reader link-icon"></i>
            </a>
            <ul class="collapse navigation-submenu" id="surat-masuk">
              <li>
                <a href="<?= base_url('suratmasuk/create'); ?>"  >
              <i class="bx bx-bookmark-alt-plus"></i>
                    Masukan Data</a>
              </li>
              <li>
                <a href="<?= base_url('suratmasuk'); ?>" class="sidebar-link" >
              <i class="bx bx-receipt"></i>
                    Data Surat</a>
              </li>
              <li>
                <a href="<?= base_url('suratmasuk/history'); ?>" ><i class='bx bx-history'></i> History</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#surat-keluar" class="sidebar-link" data-toggle="collapse" aria-expanded="false">
              <span class="link-title">Surat Keluar</span>
              <i class="bx bx-navigation link-icon"></i>
            </a>
            <ul class="collapse navigation-submenu" id="surat-keluar">
              <li>
                <a href="<?= base_url('suratkeluar/create');?>"  >
              <i class="bx bx-bookmark-alt-plus"></i>
                    Masukan Data</a>
              </li>
              <li>
                <a href="<?= base_url('suratkeluar'); ?>"  >
              <i class="bx bx-receipt"></i>
                    Data Surat</a>
              </li>
              <li>
                <a href="<?= base_url('suratmasuk/history'); ?>" ><i class="bx bx-timer"></i> History </a>
              </li>
              
            </ul>
          </li>
          <li>
            <a href="/galeri-surat" class="sidebar-link">
              <span class="link-title">Instansi</span>
              <i class="bx bx-store-alt link-icon"></i>
            </a>
          </li>
          <li>
            <a href="/galeri-surat" class="sidebar-link">
              <span class="link-title">Kategori</span>
              <i class="bx bx-carousel link-icon"></i>
            </a>
          </li>

          <?php if (in_groups('superadmin')) : ?>
 
          <li class="nav-category-divider">SUPERADMIN</li>
          <li>
            <a href="<?= base_url('admin/user');?>" class="sidebar-link">
              <span class="link-title">Kelola User</span>
              <i class="bx bx-user link-icon"></i>
            </a>
          </li>
          
          <?php endif; ?>
          
       
        </ul>
      </div>