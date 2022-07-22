<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 col-sm-4 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Ongkos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= rupiah($totalOngkos); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 col-sm-4 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Service</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalService; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 col-sm-4 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase ">
                                Mekanik paling produktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $mekanikProduktif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-lg col-sm">

            <div class="table-responsive">

                <table class="table table-hover display" id="table-sub-menu">
                    <thead>
                        <tr>
                            <th scope="col">Nama Mekanik</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Total Ongkos</th>
                            <th scope="col">Total Service</th>
                            <th scope="col">Persentase Ongkos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mekanik as $m) : ?>
                            <tr>
                                <th scope="row"><?= $m['nama']; ?></th>
                                <td><?= $m['nomor'] ?></td>
                                <td><?= rupiah($m['total_ongkos']); ?></td>
                                <td><?= $m['total_service'] ?></td>
                                <td><?= $m['persentase_ongkos']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php /*  <?=$this->pagination->create_links();?> */ ?>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}


?>