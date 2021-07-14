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
          <div class="grid pb-5">
            <div class="grid-body">
      		  <h1 class="text-center pb-5">SIMAT <?=lang('Auth.register')?></h1>
              <div class="row">
                <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                	
                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= route_to('register') ?>" method="post">
                        <?= csrf_field() ?>
                        
                    <div class="form-group">
                      <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                   name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>" />
                         <small style="font-size:9.6px" id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
                    </div>
                    
                    <div class="form-group">
                      <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>" />
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-sm-6">
                      	<input type="password" name="password" class="mb-4 form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off"/>
                      </div>
                      
                      <div class="col-sm-6">
                      	<input type="password" name="pass_confirm" class="mb-4 form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off"/>
                      </div>
                    </div>
                   
                    <button type="submit" class="btn btn-warning btn-block"> <?=lang('Auth.register')?> </button>
                    
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
      <div class="auth_footer">
        <p class="text-muted text-center">SIMAT APP 2021</p>
      </div>
    </div>
    
<?= $this->endSection();?>