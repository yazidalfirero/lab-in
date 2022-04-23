<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `sperm_transaction` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
                $$k = $v;
        }
        
    }
    
       
}
$price_arr = [];
 // $qry = $conn->query("SELECT t.*,p.satuan ,p.normalvalue ,p.size, c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id inner join category_list c on p.category_id = c.id where p.category_id = c.id ");
 $harga = $conn->query("SELECT * from `price_list` where size like '%sperma%' ");
 $harga = $harga->fetch_array();

?>

<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>

<?php 
$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d",strtotime(date("Y-m-d"))); 
?>

<div class="content py-3">
    <div class="card card-outline card-purple shadow rounded-0">
        <div class="card-header">
            <h3 class="card-title"><b><?= isset($id) ? "Update Transaksi Sperma - " : "Tambah Transaksi Sperma"  ?></b></h3>
        </div>

        <!-- /# column identitas pasien -->
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="transaction_sperm_form">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : 'null' ?>">
                    <fieldset class="border-bottom">
                        <legend class="text-muted">Isi Identitas Pasien </legend>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="nama_pasien" class="control-label">Nama Pasien</label>
                                <input type="text" name="nama_pasien" id="nama_pasien" autofocus value="<?= isset($nama_pasien) ? $nama_pasien : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="umur_pasien" class="control-label">Umur</label>
                                <input type="text" name="umur_pasien" id="umur_pasien" autofocus value="<?= isset($umur_pasien) ? $umur_pasien : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alamat_pasien" class="control-label">Alamat</label>
                                <input type="text" name="alamat_pasien" id="alamat_pasien" autofocus value="<?= isset($alamat_pasien) ? $alamat_pasien : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rujukan_pengirim" class="control-label">Alamat Pengirim</label>
                                <input type="text" name="rujukan_pengirim" id="rujukan_pengirim" autofocus value="<?= isset($rujukan_pengirim) ? $rujukan_pengirim : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kontak_pasien" class="control-label">No.  HP</label>
                                <input type="text" name="kontak_pasien" id="kontak_pasien" value="<?= isset($kontak_pasien) ? $kontak_pasien : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nama_pengirim" class="control-label">Nama Pengirim</label>
                                <input type="text" name="nama_pengirim" id="nama_pengirim" autofocus value="<?= isset($nama_pengirim) ? $nama_pengirim : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                    </fieldset>
                    <!-- /# column spermatozoa -->
                    
                    <fieldset class="border-bottom">
                        <div class="row">

                            <legend class="text-muted">Spermatozoa</legend>
                            <div class="form-group col-md-3">
                                <label for="birthday">Sample Diterima</label>
                                <input type="text" id="sample_diterima" name="sample_diterima" autofocus value="<?= isset($sample_diterima) ? $sample_diterima : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>                
                            <div class="form-group col-md-3">
                                <label for="sample_diperiksa" class="control-label">Sample Diperiksa</label>
                                <input type="text" id="sample_diperiksa" name="sample_diperiksa" autofocus value="<?= isset($sample_diperiksa) ? $sample_diperiksa : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cara_pengeluaran" class="control-label">Cara Pengeluaran</label>
                                <input type="text" name="cara_pengeluaran" id="cara_pengeluaran" autofocus value="<?= isset($cara_pengeluaran) ? $cara_pengeluaran : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="wadah_sperm" class="control-label">Wadah</label>
                                <input type="text" name="wadah_sperm" id="wadah_sperm" autofocus value="<?= isset($wadah_sperm) ? $wadah_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="abnesia_sperm" class="control-label">Abnesia</label>
                                <input type="text" name="abnesia_sperm" id="abnesia_sperm" autofocus value="<?= isset($abnesia_sperm) ? $abnesia_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kougulum_sperm" class="control-label">Kougulum</label>
                                <input type="text" name="kougulum_sperm" id="kougulum_sperm" autofocus value="<?= isset($kougulum_sperm) ? $kougulum_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="border-bottom">
                        <legend class="text-muted">Jumlah Spermatozoa total/ejakulat</legend>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="volume_sperm" class="control-label">Volume</label>
                                <input type="text" name="volume_sperm" id="volume_sperm" autofocus value="<?= isset($volume_sperm) ? $volume_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>                
                            <div class="form-group col-md-3">
                                <label for="warna_sperm" class="control-label">Warna</label>
                                <input type="text" name="warna_sperm" id="warna_sperm" autofocus value="<?= isset($warna_sperm) ? $warna_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ph_sperm" class="control-label">Ph</label>
                                <input type="text" name="ph_sperm" id="ph_sperm" autofocus value="<?= isset($ph_sperm) ? $ph_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bau_sperm" class="control-label">Bau</label>
                                <input type="text" name="bau_sperm" id="bau_sperm" autofocus value="<?= isset($bau_sperm) ? $bau_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="col">
                                <div class="form-group ">
                                    <label for="lekuefaksi_sperm" class="control-label">Liquifaksi</label>
                                    <input type="text" name="lekuefaksi_sperm" id="lekuefaksi_sperm" autofocus value="<?= isset($lekuefaksi_sperm) ? $lekuefaksi_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group ">
                                    <label for="spermatozoa_sperm" class="control-label">Spermatozoa/LPB</label>
                                    <input type="text" name="spermatozoa_sperm" id="spermatozoa_sperm" autofocus value="<?= isset($spermatozoa_sperm) ? $spermatozoa_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group ">
                                    <label for="rapid_sperm" class="control-label">Rapid Progressive</label>
                                    <input type="text" name="rapid_sperm" id="rapid_sperm" autofocus value="<?= isset($rapid_sperm) ? $rapid_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                            <div class="col">
                            <div class="form-group col-md-12">
                                    <label for="slow_sperm" class="control-label">Slow</label>
                                    <input type="text" name="slow_sperm" id="slow_sperm" autofocus value="<?= isset($slow_sperm) ? $slow_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="nonrapid_sperm" class="control-label">Non Progressive</label>
                                    <input type="text" name="nonrapid_sperm" id="nonrapid_sperm" autofocus value="<?= isset($nonrapid_sperm) ? $nonrapid_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="immotile_sperm" class="control-label">Immotile</label>
                                    <input type="text" name="immotile_sperm" id="immotile_sperm" autofocus value="<?= isset($immotile_sperm) ? $immotile_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="border-bottom">
                            <legend class="text-muted"> Spermatozoa Total </legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="jumlah_spermatozoa_total" class="control-label">Jumlah Spermatozoa Total/Plp</label>
                                    <input type="text" name="jumlah_spermatozoa_total" id="jumlah_spermatozoa_total" autofocus value="<?= isset($jumlah_spermatozoa_total) ? $jumlah_spermatozoa_total : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="aglutinasi_sperm" class="control-label">Aglutinasi</label>
                                    <input type="text" name="aglutinasi_sperm" id="aglutinasi_sperm" autofocus value="<?= isset($aglutinasi_sperm) ? $aglutinasi_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lekosit_sperm" class="control-label">Lekosit</label>
                                    <input type="text" name="lekosit_sperm" id="lekosit_sperm" autofocus value="<?= isset($lekosit_sperm) ? $lekosit_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="konsentrasi_sperm" class="control-label">Konsentrasi</label>
                                    <input type="text" name="konsentrasi_sperm" id="konsentrasi_sperm" autofocus value="<?= isset($konsentrasi_sperm) ? $konsentrasi_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="motilitas_sperm" class="control-label">Motilitas</label>
                                    <input type="text" name="motilitas_sperm" id="motilitas_sperm" autofocus value="<?= isset($motilitas_sperm) ? $motilitas_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="morfologi_sperm" class="control-label">Morfologi Normal</label>
                                    <input type="text" name="morfologi_sperm" id="morfologi_sperm" autofocus value="<?= isset($morfologi_sperm) ? $morfologi_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="kesan_sperm" class="control-label">Kesan</label>
                                    <input type="text" name="kesan_sperm" id="kesan_sperm" autofocus value="<?= isset($kesan_sperm) ? $kesan_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="border-bottom">    
                            <div class="rows">
                                <legend class="text-muted">MORFOLOGI SPERMA</legend>
                                <div class=""><strong>Macam Kepala</strong></div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="normo_sperm" class=" form-control-label">Normo</label>
                                            <input type="text" name="normo_sperm" id="normo_sperm" autofocus value="<?= isset($normo_sperm) ? $normo_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="piri_sperm" class=" form-control-label">Piri</label>
                                            <input type="text" name="piri_sperm" id="piri_sperm" autofocus value="<?= isset($piri_sperm) ? $piri_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lepto_sperm" class=" form-control-label">Lepto</label>
                                            <input type="text" name="lepto_sperm" id="lepto_sperm" autofocus value="<?= isset($lepto_sperm) ? $lepto_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="terato_sperm" class=" form-control-label">Terato</label>
                                            <input type="text" name="terato_sperm" id="terato_sperm" autofocus value="<?= isset($terato_sperm) ? $terato_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mikro_sperm" class=" form-control-label">Mikro</label>
                                            <input type="text" name="mikro_sperm" id="mikro_sperm" autofocus value="<?= isset($mikro_sperm) ? $mikro_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="makro_sperm" class=" form-control-label">Makro</label>
                                            <input type="text" name="makro_sperm" id="makro_sperm" autofocus value="<?= isset($makro_sperm) ? $makro_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="doble_sperm" class=" form-control-label">Doble</label>
                                            <input type="text" name="doble_sperm" id="doble_sperm" autofocus value="<?= isset($doble_sperm) ? $doble_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>    
                                        <div class="form-group col-md-4">
                                            <label for="round_sperm" class=" form-control-label">Round</label>
                                            <input type="text" name="round_sperm" id="round_sperm" autofocus value="<?= isset($round_sperm) ? $round_sperm : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div> 
                                        <div class="form-group col-md-4">
                                            <label for="abnormalisasi_leher" class="control-label">Abnormalisasi Leher</label>
                                            <input type="text" name="abnormalisasi_leher" id="abnormalisasi_leher" autofocus value="<?= isset($abnormalisasi_leher) ? $abnormalisasi_leher : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="abnormalisasi_ekor" class="control-label">Abnormalisasi Ekor</label>
                                            <input type="text" name="abnormalisasi_ekor" id="abnormalisasi_ekor" autofocus value="<?= isset($abnormalisasi_ekor) ? $abnormalisasi_ekor : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="spermatozoa_imatur" class="control-label">Spermatozoa Imatur</label>
                                            <input type="text" name="spermatozoa_imatur" id="spermatozoa_imatur" autofocus value="<?= isset($spermatozoa_imatur) ? $spermatozoa_imatur : "" ?>" class="form-control form-control-sm rounded-0" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-group col-md-4">
                                                <label for="price_id" class="control-label">Pemeriksaan</label>
                                                <select id="price_id" name="price_id" class="custom-select form-control-sm rounded-0">
                                                    <option value="" disabled selected></option>
                                                    <option value="<?= $harga['id'] ?>"><?= $harga['size']." - ".$harga['price'] ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-flat btn-primary btn-sm" type="submit" form="transaction_sperm_form">Simpan</button>
                    <a href="./?page=transactions/index_sperma" class="btn btn-flat btn-default border btn-sm">Batal</a>
                </div>
            </div>
        </div>
        <script>
            $('#motilitasrb_sperm li.selected a').text();
            var price_arr = $.parseJSON('<?= json_encode($price_arr) ?>')
            window.calc_total = function(){
                var total_amount = 0;
                $('#item-list tbody tr').each(function(){
                    var price = $(this).find('input[name="price[]"]').val()
                    var qty = $(this).find('input[name="quantity[]"]').val()
                    qty = qty > 0 ? qty : 0;
                    var total = parseFloat(price) * parseFloat(qty);
                    $(this).find('.total').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
                    $(this).find('input[name="total[]"]').val(total)
                    total_amount += parseFloat(total)
                })
                $('input[name="total_amount"]').val(total_amount)
                $('.total_amount').text(parseFloat(total_amount).toLocaleString('en-US',{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
            }
            $(function(){
                $('#transaction_sperm_form').submit(function(e){
                    e.preventDefault();
                    var _this = $(this)
                    $('.pop-msg').remove()
                    var el = $('<div>')
                    el.addClass("pop-msg alert")
                    el.hide()
                    start_loader();
                    $.ajax({
                        url:_base_url_+"classes/Master.php?f=transaction_sperm_add",
                        data: $(this).serializeArray(),
                        ContentType: 'application/json',
                        method: 'POST',
                        type: 'POST',
                        error:err=>{
                            console.log(err)
                            alert_toast("An error occured",'error');
                            end_loader();
                        },
                        success:function(resp){
                            console.log(resp)
                            if(resp.status == 'success'){
                            }else if(!!resp.msg){
                                el.addClass("alert-danger")
                                el.text(resp.msg)
                                _this.prepend(el)
                            }
                            el.show('slow')
                            $('html,body,.modal').animate({scrollTop:0},'fast')
                            end_loader();
                            location.href="./?page=transactions/index_sperma&id="+resp.tid;
                        }
                    })
                })
            })
            function motilitas(value)
            {
                $('#motilitas_rb').val(value);
            }
        </script>