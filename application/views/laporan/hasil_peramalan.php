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
                    <form action="<?= base_url('laporan/simpanPeramalan') ?>" method="post">
                        <div class="card-body table-responsive" id="riwayatPenjualan">
                            <h4><b> <?= $produk->nama; ?> </b></h4>
                            <div id="hasilPeramalanTiga">
                                <?php if ($perhitunganSma != null) : ?>
                                <h5><b> MA = 3</b></h5>
                                <table class="table table-hover display" id="tableRiwayatPenjualan3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Jumlah Penjualan</th>
                                            <th scope="col">Peramalan</th>
                                            <th scope="col">Error</th>
                                            <th scope="col">Absolute Error</th>
                                            <th scope="col">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            if ($perhitunganSma == null) {
                                                echo " Data kosong! Tidak dapat melakukan peramalan";
                                            } else {
                                                foreach ($perhitunganSma as $row) {
                                                    echo "   
                                            <tr>
                                            <th scope='row'>$row[Tahun]</th>
                                            <th scope='row'> $row[Bulan] </th>
                                            <td> $row[Jumlah] </td>
                                            <td> $row[Peramalan] </td>
                                            <td> $row[Error] </td>
                                            <td> $row[AbsError] </td>
                                            <td> $row[APE] </td>
                                            </tr>                                        
                                            ";
                                                }
                                            }

                                            ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>MAPE</td>
                                            <td><?= $mapeTiga; ?>%</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php else : ?>
                                <h6 style="color: red;">Tidak dapat melakukan peramalan dengan MA = 3, data tidak cukup
                                </h6>
                                <?php endif; ?>
                            </div>

                            <div id="hasilPeramalanEmpat">
                                <?php if ($perhitunganSmaEmpat != null) : ?>
                                <h5><b> MA = 4</b></h5>
                                <table class="table table-hover display" id="tableRiwayatPenjualan4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Jumlah Penjualan</th>
                                            <th scope="col">Peramalan</th>
                                            <th scope="col">Error</th>
                                            <th scope="col">Absolute Error</th>
                                            <th scope="col">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            if ($perhitunganSmaEmpat == null) {
                                                echo " Data kosong! Tidak dapat melakukan peramalan";
                                            } else {
                                                foreach ($perhitunganSmaEmpat as $row) {
                                                    echo "   
                                            <tr>
                                            <th scope='row'>$row[Tahun]</th>
                                            <th scope='row'> $row[Bulan] </th>
                                            <td> $row[Jumlah] </td>
                                            <td> $row[Peramalan] </td>
                                            <td> $row[Error] </td>
                                            <td> $row[AbsError] </td>
                                            <td> $row[APE] </td>
                                            </tr>                                        
                                            ";
                                                }
                                            }

                                            ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>MAPE</td>
                                            <td><?= $mapeEmpat; ?>%</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php else : ?>
                                <h6 style="color: red;">Tidak dapat melakukan peramalan dengan MA = 4, data tidak cukup
                                </h6>
                                <?php endif; ?>
                            </div>

                            <div id="hasilPeramalanLima">
                                <?php if ($perhitunganSmaLima != null) : ?>
                                <h5><b> MA = 5</b></h5>
                                <table class="table table-hover display" id="tableRiwayatPenjualan5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Jumlah Penjualan</th>
                                            <th scope="col">Peramalan</th>
                                            <th scope="col">Error</th>
                                            <th scope="col">Absolute Error</th>
                                            <th scope="col">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            if ($perhitunganSmaLima == null) {
                                                echo " Data kosong! Tidak dapat melakukan peramalan";
                                            } else {
                                                foreach ($perhitunganSmaLima as $row) {
                                                    echo "   
                                            <tr>
                                            <th scope='row'>$row[Tahun]</th>
                                            <th scope='row'> $row[Bulan] </th>
                                            <td> $row[Jumlah] </td>
                                            <td> $row[Peramalan] </td>
                                            <td> $row[Error] </td>
                                            <td> $row[AbsError] </td>
                                            <td> $row[APE] </td>
                                            </tr>                                        
                                            ";
                                                }
                                            }

                                            ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>MAPE</td>
                                            <td><?= $mapeLima; ?>%</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php else : ?>
                                <h6 style="color: red;">Tidak dapat melakukan peramalan dengan MA = 5, data tidak cukup
                                </h6>
                                <?php endif; ?>
                            </div>

                            <h5><b>Kesimpulan</b></h5>


                            <?php if ($bestForecast != null) :
                            ?>
                            <h6>Hasil peramalan pembelian terbaik bulan <b><?= $forcast->forecast ?></b> sebanyak
                                <b><?= $bestForecast ?></b> buah dengan MA = <b><?= $bestMoving ?></b> dan
                                MAPE sebesar <b><?= $bestMape; ?>%</b>.

                                <h6></b>Hasil peramalan dapat
                                    dikatakan <b>"
                                        <?php
                                            $hasil = "SANGAT BAIK";
                                            if ($bestMape < 10) {
                                                $hasil = "SANGAT BAIK";
                                            } elseif ($bestMape > 10 && $bestMape < 20) {

                                                $hasil = "BAIK";
                                            } elseif ($bestMape > 20 && $bestMape < 50) {
                                                $hasil = "LAYAK";
                                            } else {
                                                $hasil = "BURUK";
                                            }

                                            echo $hasil; ?>"
                                    </b></h6>
                                <input type="text" name="hasil" id="hasil" value="<?= $bestForecast; ?>" hidden>
                                <input type="text" name="produk" id="produk" value="<?= $produk->id; ?>" hidden>
                                <input type="text" name="mape" id="mape" value="<?= $bestMape; ?>" hidden>
                                <input type="text" name="tanggal" id="tanggal"
                                    value="<?= $forcast->tanggal_peramalan; ?>" hidden>
                                <input type="number" id="nullForecast" value=1 hidden>
                                <?php else :
                                ?>
                                <h6 style="color: red;">Tidak ada kesimpulan, karena data tidak tersedia</h6>
                                <input type="number" id="nullForecast" value=0 hidden>
                                <?php endif;
                                ?>
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
                            <button type=" submit" class="btn ml-2 mr-3 btn-primary" id="simpanPeramalan">Simpan Hasil
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
if ($('#nullForecast').val() == 0) {
    $('#buttonAksi').hide();
} else {
    $('#buttonAksi').show();
}
</script>