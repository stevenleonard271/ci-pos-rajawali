<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h1 class="h5 mt-2 text-gray-100"><?= $subtitle; ?></h1>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="card-body table-responsive" id="riwayatPenjualan">
                            <h4><b> <?=$produk->nama;?> </b></h4>
                            <div id="hasilPeramalanTiga" style="display:none;">
                                <h5><b> MA = 3</b></h5>
                                <table class="table table-hover display" id="tableRiwayatPenjualan3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Jumlah Penjualan</th>
                                            <th scope="col">Peramalan</th>
                                            <th scope="col">Error</th>
                                            <th scope="col">Absolute Error</th>
                                            <!-- <th scope="col">Error<sup>2</sup></th> -->
                                            <th scope="col">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    $ma = 3;
                                    $count = 1;
                                    $jumJual = [];
                                    $ap = [];
                                    foreach($histo as $hs):
                                    $ramal = "";
                                    $error = "";
                                    $abserror = "";
                                    array_push($jumJual, $hs->jumlah_produk);
                                    if($count <= $ma) :
                                         $ramal="0" ;
                                         $error="0" ;
                                         $abserror="0";
                                        //  $errorkuadrat="0";
                                        $ape="0"; 
                                    else:
                                        $ttl=0;
                                         for ($i=($count - $ma) - 1; $i < count($jumJual) - 1; $i++) 
                                         { 
                                             $ttl +=$jumJual[$i];
                                         } 
                                     $ttl=$ttl / $ma;
                                     $ramal="" .$ttl; 
                                     $error="".($jumJual[count($jumJual) - 1] - $ttl);
                                     $abserror="".abs(($jumJual[count($jumJual) - 1] - $ttl));
                                    //  $errorkuadrat="".pow(abs(($jumJual[count($jumJual) - 1] - $ttl)), 2);
                                     $ape="".(abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1];
                                     array_push($ap, (abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1]);
                                     endif; ?>
                                        <tr>
                                            <th scope="row"><?= $hs->bulan?></th>
                                            <td><?= $hs->jumlah_produk?></td>
                                            <td><?= $ramal ?></td>
                                            <td><?= $error ?></td>
                                            <td><?= $abserror ?></td>
                                            <!-- <td><?php // $errorkuadrat ?></td> -->
                                            <td><?= $ape ?></td>
                                        </tr>
                                        <?php $count++; endforeach; ?>
                                        <tr>
                                            <th scope="row"><?= $forcast->forecast?></th>
                                            <td>?</td>
                                            <td><?php $ttl = 0;
                                            for ($i=($count - $ma) - 1; $i < count($jumJual); $i++) { 
                                                $ttl += $jumJual[$i] / $ma;
                                                $foreCastTiga = $ttl;
                                            } echo $foreCastTiga;?></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <!-- <td>0</td> -->
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <!-- <td></td> -->
                                            <td><b>MAPE<b></td>
                                            <td><?php 
                                            $mapeTiga = array_sum($ap)/count($ap)*100;
                                            if($mapeTiga==NAN){
                                                $mapeTiga = 100;
                                            }
                                            echo $mapeTiga;
                                            $firstValue = [
                                                'hasil'=> $foreCastTiga,
                                                'ma' => 3,
                                                'mape' => $mapeTiga
                                            ];
                                            ?>%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="hasilPeramalanEmpat" style="display:none;">
                                <h5><b> MA = 4 </b></h5>
                                <table class="table table-hover display" id="tableRiwayatPenjualan4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Jumlah Penjualan</th>
                                            <th scope="col">Peramalan</th>
                                            <th scope="col">Error</th>
                                            <th scope="col">Absolute Error</th>
                                            <!-- <th scope="col">Error<sup>2</sup></th> -->
                                            <th scope="col">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    $ma = 4;
                                    $count = 1;
                                    $jumJual = [];
                                    $ap = [];
                                    foreach($histo as $hs):
                                    $ramal = "";
                                    $error = "";
                                    $abserror = "";
                                    array_push($jumJual, $hs->jumlah_produk);
                                    if($count <= $ma) :
                                         $ramal="0" ;
                                         $error="0" ;
                                         $abserror="0";
                                        //  $errorkuadrat="0";
                                        $ape="0"; 
                                    else:
                                        $ttl=0;
                                         for ($i=($count - $ma) - 1; $i < count($jumJual) - 1; $i++) 
                                         { 
                                             $ttl +=$jumJual[$i];
                                         } 
                                     $ttl=$ttl / $ma;
                                     $ramal="" .$ttl; 
                                     $error="".($jumJual[count($jumJual) - 1] - $ttl);
                                     $abserror="".abs(($jumJual[count($jumJual) - 1] - $ttl));
                                    //  $errorkuadrat="".pow(abs(($jumJual[count($jumJual) - 1] - $ttl)), 2);
                                     $ape="".(abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1];
                                     array_push($ap, (abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1]);
                                     endif; ?>
                                        <tr>
                                            <th scope="row"><?= $hs->bulan?></th>
                                            <td><?= $hs->jumlah_produk?></td>
                                            <td><?= $ramal ?></td>
                                            <td><?= $error ?></td>
                                            <td><?= $abserror ?></td>
                                            <!-- <td><?php // $errorkuadrat ?></td> -->
                                            <td><?= $ape ?></td>
                                        </tr>
                                        <?php $count++; endforeach; ?>
                                        <tr>
                                            <th scope="row"><?= $forcast->forecast?></th>
                                            <td>?</td>
                                            <td><?php $ttl = 0;
                                            for ($i=($count - $ma) - 1; $i < count($jumJual); $i++) { 
                                                $ttl += $jumJual[$i] / $ma;
                                                $foreCastEmpat = $ttl;
                                            } echo $foreCastEmpat;?></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <!-- <td>0</td> -->
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <!-- <td></td> -->
                                            <td><b>MAPE<b></td>
                                            <td><?php 
                                            $mapeEmpat = array_sum($ap)/count($ap)*100;
                                            if(is_nan($mapeEmpat)){
                                                $mapeEmpat = 100;
                                            };
                                            echo $mapeEmpat;
                                            $secondValue = [
                                                'hasil'=> $foreCastEmpat,
                                                'ma' => 4,
                                                'mape' => $mapeEmpat
                                            ];
                                            ?>%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="hasilPeramalanLima" style="display: none;">
                                <h5><b> MA = 5 </b></h5>
                                <table class="table table-hover display" id="tableRiwayatPenjualan5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Jumlah Penjualan</th>
                                            <th scope="col">Peramalan</th>
                                            <th scope="col">Error</th>
                                            <th scope="col">Absolute Error</th>
                                            <!-- <th scope="col">Error<sup>2</sup></th> -->
                                            <th scope="col">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    $ma = 5;
                                    $count = 1;
                                    $jumJual = [];
                                    $ap = [];
                                    foreach($histo as $hs):
                                    $ramal = "";
                                    $error = "";
                                    $abserror = "";
                                    array_push($jumJual, $hs->jumlah_produk);
                                    if($count <= $ma) :
                                         $ramal="0" ;
                                         $error="0" ;
                                         $abserror="0";
                                        //  $errorkuadrat="0";
                                        $ape="0"; 
                                    else:
                                        $ttl=0;
                                         for ($i=($count - $ma) - 1; $i < count($jumJual) - 1; $i++) 
                                         { 
                                             $ttl +=$jumJual[$i];
                                         } 
                                     $ttl=$ttl / $ma;
                                     $ramal="" .$ttl; 
                                     $error="".($jumJual[count($jumJual) - 1] - $ttl);
                                     $abserror="".abs(($jumJual[count($jumJual) - 1] - $ttl));
                                    //  $errorkuadrat="".pow(abs(($jumJual[count($jumJual) - 1] - $ttl)), 2);
                                     $ape="".(abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1];
                                     array_push($ap, (abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1]);
                                     endif; ?>
                                        <tr>
                                            <th scope="row"><?= $hs->bulan?></th>
                                            <td><?= $hs->jumlah_produk?></td>
                                            <td><?= $ramal ?></td>
                                            <td><?= $error ?></td>
                                            <td><?= $abserror ?></td>
                                            <!-- <td><?php //echo $errorkuadrat ?></td> -->
                                            <td><?= $ape ?></td>
                                        </tr>
                                        <?php $count++; endforeach; ?>
                                        <tr>
                                            <th scope="row"><?= $forcast->forecast?></th>
                                            <td>?</td>
                                            <td><?php $ttl = 0;
                                            for ($i=($count - $ma) - 1; $i < count($jumJual); $i++) { 
                                                $ttl += $jumJual[$i] / $ma;
                                                $foreCastLima = $ttl;
                                            } echo $foreCastLima;?></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <!-- <td>0</td> -->
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <!-- <td></td> -->
                                            <td><b>MAPE<b></td>
                                            <td><?php 
                                            $mapeLima = array_sum($ap)/count($ap)*100;
                                            if(is_nan($mapeLima)){
                                                $mapeLima = 100;
                                            };
                                            $thirdValue = [
                                                'hasil'=> $foreCastLima,
                                                'ma' => 5,
                                                'mape' => $mapeLima
                                            ];
                                            echo $mapeLima;?>%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="text" id="mape3" value="<?=$firstValue['mape'];?>" hidden>
                            <input type="text" id="mape4" value="<?=$secondValue['mape'];?>" hidden>
                            <input type="text" id="mape5" value="<?=$thirdValue['mape'];?>" hidden>
                            <h5><b>Kesimpulan</b></h5>
                            <?php 
                              //ambil nilai terbaik berdasarkan MAPE
                              $bestMape=0;
                              $bestForecast=0;
                              $bestMoving=0;

                              if($firstValue['mape']<= $secondValue['mape']&&$firstValue['mape']<=$thirdValue['mape']){
                                  $bestForecast = $firstValue['hasil'];
                                  $bestMoving = $firstValue['ma'];
                                  $bestMape = $firstValue['mape'];
                          
                              }else if($secondValue['mape']<= $secondValue['mape']&&$secondValue['mape']<=$thirdValue['mape'])
                              {
                                  $bestForecast = $secondValue['hasil'];
                                  $bestMoving = $secondValue['ma'];
                                  $bestMape = $secondValue['mape'];
                              } else{
                                  $bestForecast = $thirdValue['hasil'];
                                  $bestMoving = $thirdValue['ma'];
                                  $bestMape = $thirdValue['mape'];
                              }
                            
                            ?>
                            <h6>Hasil peramalan pembelian terbaik bulan <b><?= $forcast->forecast?></b> sebanyak
                                <b><?=$bestForecast?></b> buah dengan MA = <b><?=$bestMoving?></b> dan
                                MAPE sebesar <b><?=$bestMape;?>%</b>.

                            </h6>
                            <h6></b>Hasil peramalan dapat
                                dikatakan <b>"
                                    <?php
                                $hasil = "SANGAT BAIK";
                                if($bestMape<10){
                                    $hasil = "SANGAT BAIK";
                                } elseif($bestMape>10 &&$bestMape<20 ){

                                    $hasil = "BAIK";
                                }
                                elseif($bestMape>20 &&$bestMape<50 ){
                                    $hasil = "LAYAK";
                                } else{
                                    $hasil = "BURUK";
                                }

                                echo $hasil;?>"
                                </b></h6>
                            <input type="text" name="hasil" id="hasil" value="<?=$bestForecast;?>" hidden>
                            <input type="text" name="produk" id="produk" value="<?=$produk->id;?>" hidden>
                            <input type="text" name="mape" id="mape" value="<?=$bestMape;?>" hidden>
                            <input type="text" name="tanggal" id="tanggal" value="<?=$forcast->tanggal_peramalan;?>"
                                hidden>
                            <div class="col-6 mt-3">
                                <table id="kriteriaMAPE" class="table table-hover display">
                                    <thead>
                                        <tr>
                                            <th scope="col">MAPE</th>
                                            <th scope="col">Kriteria</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>&#60;10%</td>
                                            <td>Sangat Baik</td>
                                        </tr>
                                        <tr>
                                            <td>10%-20%</td>
                                            <td>Baik</td>
                                        </tr>
                                        <tr>
                                            <td>20%-50%</td>
                                            <td>Layak</td>

                                        </tr>
                                        <tr>
                                            <td>&#62;50%</td>
                                            <td>Buruk</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <small class="text-primary">
                                **Hasil peramalan yang terbaik akan tersimpan pada sistem dan dapat digunakan untuk
                                rekomendasi pembelian di menu stok masuk
                            </small>

                        </div>
                        <div class="row float-right" id="buttonAksi">
                            <button type="submit" class="btn ml-2 mr-3 btn-primary">Simpan Hasil
                                Peramalan</button>
                            <a href="<?= base_url('laporan/peramalan') ?>" class="btn btn-danger mr-3">Batal </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
//Menyembunyikan error ketika tidak bisa berjalan mape
var mape3 = parseInt($('#mape3').val());
var mape4 = parseInt($('#mape4').val());
var mape5 = parseInt($('#mape5').val());
if (mape3 < 100) {
    // alert(mape3);
    $('#hasilPeramalanTiga').show();
}
if (mape4 < 100) {
    // alert(mape4);
    // $('hasilPeramalanTiga').hide();
    $('#hasilPeramalanEmpat').show();
    // $('hasilPeramalanLima').hide();
}

if (mape5 < 100) {
    // alert(mape5);
    // $('hasilPeramalanTiga').hide();
    // $('hasilPeramalanEmpat').hide();
    $('#hasilPeramalanLima').show();
};
</script>