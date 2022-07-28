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
                    <div class="card-body" id="riwayatPenjualan">
                        <h5><b>Hasil Peramalan</b></h5>
                        <div class="table-responsive">
                            <table class="table table-hover display" id="tableRiwayatPenjualan">
                                <thead>
                                    <tr>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Jumlah Penjualan</th>
                                        <th scope="col">Peramalan</th>
                                        <th scope="col">Error</th>
                                        <th scope="col">Absolute Error</th>
                                        <th scope="col">Error<sup>2</sup></th>
                                        <th scope="col">APE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $ma = 2;
                                    $count = 1;
                                    $jumJual = [];
                                    $ap = [];
                                    foreach($histo as $hs): 
                                        $ramal = "";
                                        $error = "";
                                        $abserror = "";
                                        array_push($jumJual, $hs->jumlah_produk);
                                        if($count <= $ma) : 
                                            $ramal = "0"; 
                                            $error = "0";
                                            $abserror = "0";
                                            $errorkuadrat = "0";
                                            $ape = "0";
                                        else:
                                            $ttl = 0;
                                            for ($i=($count - $ma) - 1; $i < count($jumJual) - 1; $i++) { 
                                                $ttl += $jumJual[$i];
                                            }
                                            $ttl = $ttl / $ma;
                                            $ramal = "".$ttl;
                                            $error = "".($jumJual[count($jumJual) - 1] - $ttl);
                                            $abserror = "".abs(($jumJual[count($jumJual) - 1] - $ttl));
                                            $errorkuadrat = "".pow(abs(($jumJual[count($jumJual) - 1] - $ttl)), 2);
                                            $ape = "".(abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1];
                                            array_push($ap, (abs(($jumJual[count($jumJual) - 1] - $ttl)))/$jumJual[count($jumJual) - 1]);
                                        endif;
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $hs->bulan?></th>
                                        <td><?= $hs->jumlah_produk?></td>
                                        <td><?= $ramal ?></td>
                                        <td><?= $error ?></td>
                                        <td><?= $abserror ?></td>
                                        <td><?= $errorkuadrat ?></td>
                                        <td><?= $ape ?></td>
                                    </tr>
                                    <?php $count++; endforeach; ?>
                                    <tr>
                                        <th scope="row"><?= $forcast->forecast?></th>
                                        <td>?</td>
                                        <td><?php $ttl = 0;
                                            for ($i=($count - $ma) - 1; $i < count($jumJual); $i++) { 
                                                $ttl += $jumJual[$i] / $ma;
                                            } echo $ttl;?></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td></td>
                                        <td><?php echo (array_sum($ap)/count($ap))*100?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5>Jumlah Peramalan</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->