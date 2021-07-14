 <?= $this->extend('auth/templates/index');?>
 <?= $this->section('auth-content');?>

    <div class="authentication-theme auth-style_1">
      <div class="row">
        <div class="col-12 logo-section">
          <a href="/" class="logo">
            <img src="<?= base_url(); ?>/assets/images/logo.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
          <div class="grid pb-5 ">
            <div class="grid-body">
      		  <h1 class="text-center pb-5">SIMAT <?=lang('Auth.loginTitle')?></h1>
              <div class="row">
                <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                  <?= view('Myth\Auth\Views\_message_block') ?>

					<form action="<?= route_to('login') ?>" method="post">
						<?= csrf_field() ?>
						
						
				<?php if ($config->validFields === ['email']): ?>
				
                    <div class="form-group ">
                       <input type="text" class="form-control  <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.email')?>" />
                        <div class="invalid-feedback">
							<?= session('errors.login') ?>
						</div>
                    </div>
                    
                <?php else: ?>
                    
                    <div class="form-group ">
                        <input type="text" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.emailOrUsername')?>" />
                        <div class="invalid-feedback">
							<?= session('errors.login') ?>
						</div>
                    </div>
                    
                <?php endif; ?>
                
                    <div class="form-group ">
                      <input type="password" name="password" class="form-control  <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>"/>
                        <div class="invalid-feedback">
							<?= session('errors.password') ?>
						</div>
                    </div>
                    
                <?php if ($config->allowRemembering): ?>
                
                    <div class="form-inline">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="remember" class="form-check-input" <?php if(old('remember')) : ?> checked <?php endif ?>/> <?=lang('Auth.rememberMe')?> <i class="input-frame"></i>
                        </label>
                      </div>
                    </div>
                    
                <?php endif; ?>
                
                    <button type="submit" class="btn btn-warning btn-block"> <?=lang('Auth.loginAction')?> </button>
                  </form>
                  <div class="form-link">
                  	
                <?php if ($config->allowRegistration) : ?>
                
					<p><a href="<?= route_to('register') ?>"><?=lang('Auth.needAnAccount')?></a></p>
					
				<?php endif; ?>
				<?php if ($config->activeResetter): ?>
				
					<p><a href="<?= route_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a></p>
					
				<?php endif; ?>
				
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="auth_footer ">
        <p class="text-muted text-center">SIMAT APP 2021</p>
      </div>
    </div>
    
<?= $this->endSection();?>