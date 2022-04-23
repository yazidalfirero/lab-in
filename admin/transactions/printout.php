<?php 
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM `sperm_transaction` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
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
<div id="outprint">
            <style>
                #sys_logo{
                    object-fit:cover;
                    object-position:center center;
                    width: 6.5em;
                    height: 6.5em;
                }
            </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2"></div>
            </div>
            <div class="row row-cols-2">
                <div class="col-md-6">
                <h6 clas="text-left"><b><div>Nama : <?= isset($nama_pasien) ? $nama_pasien : 'N/A' ?></div></b></h6>
                <h6 clas="text-left"><b><div>Umur : <?= isset($umur_pasien) ? $umur_pasien : 'N/A' ?></div></b></h6>
                <h6 clas="text-left"><b><div>Alamat : <?= isset($alamat_pasien) ? $alamat_pasien : 'N/A' ?></div></b></h6>
                <h6 clas="text-left"><b><div>Tanggal Periksa : <?= date("d-m-Y",strtotime($date_created)) ?></div></b></h6>
                </div>    

                <div class="col-md-6">
                <h6 clas="text-left"><b><div>Pengirim : <?= isset($nama_pengirim) ? $nama_pengirim : 'N/A' ?></div></b></h6>
                <h6 clas="text-left"><b><div>Alamat : <?= isset($rujukan_pengirim) ? $rujukan_pengirim : 'N/A' ?></div></b></h6>
                <h6 clas="text-left"><b><div>No. Lab : <?= isset($id) ? $id : 'N/A' ?></div></b></h6>
                </div>
            </div>
            <table class="table table-bordered table-hover table-striped table-sm">
                <colgroup>
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-purple text-light">
                        <th>Sampel diterima</th>
                        <th>Sampel diperiksa</th>
                        <th>Wadah</th>
                        <th>Abstinensia</th>
                        <th>Cara Pengeluaran</th>
                        <th>Koagulum</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class=""><?php echo date("d-m-Y H:i",strtotime($sample_diterima)) ?></td>
                            <td class=""><?php echo date("d-m-Y H:i",strtotime($sample_diperiksa)) ?></td>
                            <td class=""><?= isset($wadah_sperm) ? $wadah_sperm : 'N/A' ?></p></td>
                            <td class=""><?= isset($abnesia_sperm) ? $abnesia_sperm : 'N/A' ?></td>
                            <td class=""><?= isset($cara_pengeluaran) ? $cara_pengeluaran : 'N/A' ?></td>
                            <td class=""><?= isset($kougulum_sperm) ? $kougulum_sperm : 'N/A' ?></td>
                        </tr>
                </tbody>
                
                <tfoot>
                    <tr class="bg-gradient-secondary">
                    <th class="py-1 text-center" colspan='6'><b>MAKROSKOPIK<b></th>
                    </tr>
                                    <!-- <tr class="bg-gradient-secondary">
                                        <th class="py-1 text-center" colspan='3'><b>Total<b></th>
                                        <th class="px-2 py-1 text-right total_amount"><?= isset($total_amount) ? number_format($total_amount,2) : 0 ?></th>
                                    </tr> -->
                    </tfoot>
            </table>

            <!-- TABEL KEDUA MIKROSKOPIK -->

            <table class="table table-bordered table-hover table-striped table-sm">
                <colgroup>
                    <col width="33%">
                    <col width="33%">
                    <col width="33%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-purple text-light">
                        <th>Parameter</th>
                        <th>Hasil</th>
                        <th>Nilai Normal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Volume</td>
                        <td><?= isset($volume_sperm) ? $volume_sperm : 'N/A' ?></td>
                        <td>>= 2 ml</td>
                    </tr>
                    <tr>
                        <td>Warna</td>
                        <td><?= isset($warna_sperm) ? $warna_sperm : 'N/A' ?></td>
                        <td>Putih Kelabu</td>
                    </tr>
                    <tr>
                        <td>PH</td>
                        <td><?= isset($ph_sperm) ? $ph_sperm : 'N/A' ?></td>
                        <td>>= 7,2</td>
                    </tr>
                    <tr>
                        <td>Bau</td>
                        <td><?= isset($bau_sperm) ? $bau_sperm : 'N/A' ?></td>
                        <td>Khas ( Menyerupai Bau Hipoklorit) </td>
                    </tr>
                    <tr>
                        <td>Liquifaksi</td>
                        <td><?= isset($lekuefaksi_sperm) ? $lekuefaksi_sperm : 'N/A' ?></td>
                        <td>Dalam 60 menit ( Suhu Ruang )</td>
                    </tr>
                </tbody>
                
                <tfoot>
                    <tr class="bg-gradient-secondary">
                    <th class="py-1 text-center" colspan='6'><b>MIKROSKOPIK<b></th>
                    </tr>
                                    <!-- <tr class="bg-gradient-secondary">
                                        <th class="py-1 text-center" colspan='3'><b>Total<b></th>
                                        <th class="px-2 py-1 text-right total_amount"><?= isset($total_amount) ? number_format($total_amount,2) : 0 ?></th>
                                    </tr> -->
                    </tfoot>
            </table>

            <!-- TABEL KETIGA -->

            <table class="table table-bordered table-hover table-striped table-sm">
                <colgroup>
                    <col width="33%">
                    <col width="33%">
                    <col width="33%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-purple text-light">
                        <th>Parameter</th>
                        <th>Hasil</th>
                        <th>Nilai Normal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Spermatozoa / LPB</td>
                        <td><?= isset($spermatozoa_sperm) ? $spermatozoa_sperm : 'N/A' ?> /LPB</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Motilitas</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&emsp;&emsp;a. Rapid Progressive</td>
                        <td><?= isset($rapid_sperm) ? $rapid_sperm : 'N/A' ?></td>
                        <td>%</td>
                    </tr>
                    <tr>
                        <td>&emsp;&emsp;b. Slow</td>
                        <td><?= isset($slow_sperm) ? $slow_sperm : 'N/A' ?></td>
                        <td>%</td>
                    </tr>
                    <tr>
                        <td>&emsp;&emsp;c. Non Progressive</td>
                        <td><?= isset($nonrapid_sperm) ? $nonrapid_sperm : 'N/A' ?></td>
                        <td>%</td>
                    </tr>
                    <tr>
                        <td>&emsp;&emsp;d. Immotile</td>
                        <td><?= isset($immotile_sperm) ? $immotile_sperm : 'N/A' ?></td>
                        <td>%</td>
                    </tr>
                    <tr>
                        <td>Aglutinasi</td>
                        <td><?= isset($aglutinasi_sperm) ? $aglutinasi_sperm : 'N/A' ?></td>
                        <td>Negatif</td>
                    </tr>
                    <tr>
                        <td>Lekosit</td>
                        <td><?= isset($lekosit_sperm) ? $lekosit_sperm : 'N/A' ?></td>
                        <td>< 1 Juta / ml </td>
                    </tr>
                </tbody>
            </table>
            <!-- TABEL KE EMPAT -->
            <table class="table table-bordered table-hover table-striped table-sm">
                <colgroup>
                    <!-- <col width="40%"> -->
                </colgroup>
                <thead>
                    <tr class="bg-gradient-purple text-light">
                        <th class="text-center" colspan="3">HASIL- HASIL YANG PENTING</th>
                        <th class="text-center" colspan="3">Morfologi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Parameter</th>
                        <th>Hasil</th>
                        <th>Nilai Normal</th>
                        <th class="text-center" colspan="2">Kepala</th>
                        <td rowspan="2" class="text-center">Abnormalisasi Leher : <?= isset($abnormalisasi_leher) ? $abnormalisasi_leher : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Total</td>
                        <td><?= isset($jumlah_spermatozoa_total) ? $jumlah_spermatozoa_total : 'N/A' ?></td>
                        <td>>=40 Juta / Ejakulat</td>
                        <td>Normo</td>
                        <td><?= isset($normo_sperm) ? $normo_sperm : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td>Konsentrasi</td>
                        <td><?= isset($konsentrasi_sperm) ? $konsentrasi_sperm : 'N/A' ?></td>
                        <td>>=20 Juta / ml</td>
                        <td>Makro</td>
                        <td><?= isset($makro_sperm) ? $makro_sperm : 'N/A' ?></td>
                        <td rowspan="2" class="text-center">Abnormalisasi Ekor : <?= isset($abnormalisasi_ekor) ? $abnormalisasi_ekor : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td>Motilitas</td>
                        <td><?= isset($motilitas_sperm) ? $motilitas_sperm : 'N/A' ?></td>
                        <td>( a+b ) >=50% atau a > 25%</td>
                        <td>Mikro</td>
                        <td><?= isset($mikro_sperm) ? $mikro_sperm : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td rowspan="2">Morfologi Normal</td>
                        <td rowspan="2"><?= isset($morfologi_sperm) ? $morfologi_sperm : 'N/A' ?></td>
                        <td rowspan="2">>=50%</td>
                        <td>Taper ( Lepto )</td>
                        <td><?= isset($lepto_sperm) ? $lepto_sperm : 'N/A' ?></td>
                        <td rowspan="5" class="text-center">Spermatozoa Imatur : <?= isset($spermatozoa_imatur) ? $spermatozoa_imatur : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td>Piri</td>
                        <td><?= isset($piri_sperm) ? $piri_sperm : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="3">Kesan : "<?= isset($kesan_sperm) ? $kesan_sperm : 'N/A' ?>"</td>
                        <td>Double</td>
                        <td><?= isset($doble_sperm) ? $doble_sperm : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td>Amorf ( Terato )</td>
                        <td><?= isset($terato_sperm) ? $terato_sperm : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td>Round</td>
                        <td><?= isset($round_sperm) ? $round_sperm : 'N/A' ?></td>
                    </tr>
                </tbody>
            </table>
		<br><br>
            <h6 style="padding-left: 80%"><p style="">Pemeriksa</p></h6>
            <br><br><br>
            <h6 style="padding-left: 76%"><p style="">(............................................)</p></h6>
            </div>
		
        </div>
</div> <!-- PENUTUP DIV UNTUK LEMBARAN PRINT-->
        <!-- TOMBOL PRINT -->
        <tr class="bg-gradient-secondary">
            <th><button class="btn btn-flat btn-primary" type="button" id="print"><i class="fa fa-print"></i> Cetak Hasil Lab</button></th>
        </tr>

<script>
    $(document).ready(function(){
        $('#filter').submit(function(e){
            e.preventDefault();
            location.href= './?page=reports/daily_transaction&'+$(this).serialize();
        })
       $('#print').click(function(){
           start_loader()
           var _p = $('#outprint').clone()
           var _h = $('head').clone()
           var _el = $('<div>')
        //    _h.find("title").text("Daily Transaction Report - Print View")
           _p.find('tr.text-light').removeClass('text-light bg-gradient-purple')
           _el.append(_h)
           _el.append(_p)
           var nw = window.open("","_blank","width=1000,height=900,left=300,top=50")
            nw.document.write(_el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    end_loader()
                }, 300);
            }, 750);
       })
    })
</script>