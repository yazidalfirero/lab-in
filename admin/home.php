<h1>Selamat Datang di <?php echo $_settings->info('name') ?> - Admin Panel</h1>
<hr class="border-purple">
<style>
    #website-cover{
        width:100%;
        height:30em;
        object-fit:cover;
        object-position:center center;
    }
</style>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-folder"></i></span>

            <div class="info-box-content">
            <span class="info-box-text text-wrap">Total Transaksi Laboraturium</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `transaction_list` where `status` = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-folder"></i></span>

            <div class="info-box-content">
            <span class="info-box-text text-wrap">Total Transaksi Cek Sperma</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `sperm_transaction` ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-maroon elevation-1"><i class="fas fa-coins"></i></span>

            <div class="info-box-content">
            <span class="info-box-text text-wrap">Pendapatan Cek Laboraturium Hari Ini</span>
            <span class="info-box-number text-right">
                <?php 
                    $payments = $conn->query("SELECT SUM(total_amount) FROM `transaction_list` where date(date_created) = '".(date("Y-m-d"))."'")->fetch_array()[0];
                    $payments = $payments > 0 ? $payments : 0;
                    ?> Rp. <?php echo number_format($payments,2);
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <img src="<?= validate_image($_settings->info('cover')) ?>" alt="Website Cover" class="img-fluid border w-100" id="website-cover">
    </div>
</div>
