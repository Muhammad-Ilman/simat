<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIMAT APPLICATION</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/layout.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/template.css">
  </head>
  <body>
  	
  	<!-- SIMAT LOGIN - REGISTER - FORGOT-PASS -->
  	<?= $this->renderSection('auth-content');?>
  	
      
  </body>
</html>