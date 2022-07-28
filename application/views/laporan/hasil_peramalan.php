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
                                    <tr>
                                        <th scope="row">Januari
                                        </th>
                                        <td>20</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
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