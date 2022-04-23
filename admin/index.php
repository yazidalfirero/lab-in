<?php require_once('../config.php'); ?>
 <!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<style>


 <?php 
  $url_components = parse_url($_SERVER['REQUEST_URI']);
  
  parse_str($url_components['query'], $params);
  if($params['page'] == "transactions/view_transaction"):
 
 ?>

  @page{
    size: A4;margin: 9cm 2cm 1cm 17mm;
  }
  @page:first{
    margin: 5.5cm 2cm 17mm 17mm;
  }
  
  <?php else : ?>
    @page{
    size: A4;margin: 2cm 2cm 1cm 17mm;
  }
  @page:first{
    margin: 4cm 2cm 17mm 17mm;
  }
  <?php endif;?>
  @media print {
    .dataTables_length{
      display : none;
    }
    .dataTables_filter{
      display : none;
    }
    .dataTables_info{
      display : none;
    }
    .dataTables_paginate{
      display : none;
    }
  footer {
    position: fixed;
    bottom: 0;
  }

  html, body {
    display: block !important;
        width: auto !important;
        float: none !important;
        position: static !important;
        overflow: visible !important;
  }
  
}
</style>
<?php require_once('inc/header.php') ?>
  <body class="layout-fixed control-sidebar-slide-open layout-navbar-fixed" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
    <div class="wrapper">
     <?php require_once('inc/topBarNav.php') ?>
     <?php require_once('inc/navigation.php') ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
      <?php endif;?>    
     <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper pt-3" style="min-height: 567.854px;">
     
        <!-- Main content -->
        <section class="content ">
          <div class="container-fluid">
            <?php 
              if(!file_exists($page.".php") && !is_dir($page)){
                  include '404.html';
              }else{
                if(is_dir($page))
                  include $page.'/index.php';
                else
                  include $page.'.php';

              }
            ?>
          </div>
        </section>
        <!-- /.content -->
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-flat" id='confirm' onclick="">Lanjut</button>
        <button type="button" class="btn btn-default border btn-flat" data-dismiss="modal">Tutup</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
      <div class="modal-content rounded-0">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body rounded-0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-flat" id='submit' onclick="$('#uni_modal form').submit()">Simpan</button>
        <button type="button" class="btn btn-default border btn-flat" data-dismiss="modal">Batal</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md rounded-0" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md rounded-0" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
      </div>
      <!-- /.content-wrapper -->
      <?php require_once('inc/footer.php') ?>
  </body>
</html>
