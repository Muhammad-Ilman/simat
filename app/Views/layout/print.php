<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#141e30" />
    
    <title><?= $title;?></title>
    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/layout.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/template.css">
    
  </head>
  <body class="header-fixed">
  
    <div class="page-body">
      <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
          <div class="content-viewport">
          	
            <?= $this->renderSection('content')?>
            
          </div>
        </div>
      </div>
    </div>
 
    <script src="<?= base_url(); ?>/assets/js/jquery.js"></script>
    <script src="<?= base_url(); ?>/assets/js/template.js"></script>
    <script src="<?= base_url(); ?>/assets/js/script.js"></script>
   	<script>
   		window.print();
   	</script>
  </body>
</html>