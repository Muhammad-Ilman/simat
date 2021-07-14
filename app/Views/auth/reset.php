 <?= $this->extend('auth/templates/index');?>
 <?= $this->section('auth-content');?>

    <div class="authentication-theme auth-style_1">
      <div class="row">
        <div class="col-12 logo-section">
          <a href="/" class="logo">
            <img src="/assets/images/logo.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
          <div class="grid pb-5 input-rounded">
            <div class="grid-body">
      		  <h1 class="text-center pb-5">SIMAT <?=lang('Auth.resetYourPassword')?></h1>
      		  
              <div class="row">
                <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <p class="container mb-4" style="font-size:9px"><?=lang('Auth.enterCodeEmailPassword')?></p>


                    <form action="<?= route_to('reset-password') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="token"><?=lang('Auth.token')?></label>
                            <input type="text" class="form-control <?php if(session('errors.token')) : ?>is-invalid<?php endif ?>"
                                   name="token" placeholder="<?=lang('Auth.token')?>" value="<?= old('token', $token ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.token') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                   name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.email') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                        	<div class="col-sm-6 mb-4">
                        		
                            <input type="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                                   name="password" placeholder="<?=lang('Auth.newPassword')?>">
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        	</div>
                        	<div class="col-sm-6 mb-2">
                        		
                            <input type="password" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                   name="pass_confirm" placeholder="<?=lang('Auth.newPasswordRepeat')?>">
                            <div class="invalid-feedback">
                                <?= session('errors.pass_confirm') ?>
                            </div>
                        	</div>
                        </div>

                        

                        <button type="submit" class="btn btn-warning btn-block"><?=lang('Auth.resetPassword')?></button>
                    </form>
                    
                  <div class="form-link">
                  	
               		 <p><?=lang('Auth.alreadyRegistered')?> <a href="<?= route_to('login') ?>"><?=lang('Auth.signIn')?></a></p>
               
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