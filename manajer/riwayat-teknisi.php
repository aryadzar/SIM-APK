<?php 

include "../layout/header-manajer.php";
include "../config/controller.php";

$data_riwayat = select("SELECT dokumentasi_pesawat.id_dokumentasi, pesawat.no_registrasi, pesawat.gambar_pesawat, pesawat.nama_pesawat, pesawat.boieng_pesawat, pesawat.jenis_pesawat, pesawat.kapasitas_penumpang ,jadwal_pesawat.jadwal_pemeliharaan, dokumentasi_pesawat.jadwal_perbaikan ,teknisi.nama_teknisi,jadwal_pesawat.status, dokumentasi_pesawat.gambar_dokumentasi, dokumentasi_pesawat.laporan fROM pesawat, jadwal_pesawat, dokumentasi_pesawat, teknisi WHERE dokumentasi_pesawat.id_jadwal_pemeliharaan = jadwal_pesawat.id_jadwal_pemeliharaan AND dokumentasi_pesawat.id_teknisi = teknisi.id_teknisi AND jadwal_pesawat.id_pesawat = pesawat.id_pesawat ORDER BY dokumentasi_pesawat.id_dokumentasi DESC;");


?>

<div class="container mt-5 md-2">

    <h2>Laporan Pemeriksaan Teknisi</h2>
    <hr>

    <table class="table table-hover table-info mt-2" id="table_main">
        <thead>
            <tr>
                <th>No</th>
                <th>No Registrasi</th>
                <th>Gambar Maskapai</th>
                <th>Nama Maskapai</th>
                <th>Jenis Pesawat</th>
                <th>Tipe Pesawat</th>
                <th>Kapasitas Penumpang</th>
                <th>Jadwal Pemeliharaan</th>
                <th>Tanggal Perbaikan</th>
                <th>Kepala Teknisi</th>
                <th>Laporan Teknisi</th>
                <th>Status</th>
                <th>Gambar Dokumentasi</th>
            </tr>
        </thead>


        <tbody>
            <?php $no = 1?>
            <?php foreach($data_riwayat as $riwayat) : ?>
            <tr>
                <td><?= $no++?></td>
                <td><?=$riwayat["no_registrasi"]?></td>
                <td><img src="../gambar_pesawat/<?=$riwayat["gambar_pesawat"]?>" alt="" width="50%" height="50%"></td>
                <td><?=$riwayat["nama_pesawat"]?></td>
                <td><?=$riwayat["jenis_pesawat"]?></td>
                <td><?=$riwayat["boieng_pesawat"]?></td>
                <td><?=$riwayat["kapasitas_penumpang"]?></td>
                <td><?=date('d/m/Y H:i:s', strtotime($riwayat['jadwal_pemeliharaan']))?></td>
                <td><?=date('d/m/Y H:i:s', strtotime($riwayat['jadwal_perbaikan']))?></td>
                <td><?=$riwayat["nama_teknisi"]?></td>
                <td>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#laporan<?=$riwayat["id_dokumentasi"]?>">
                        <i class="fa-solid fa-file-circle-check"></i>       
                    </button>      
                    <div class="modal fade" id="laporan<?=$riwayat["id_dokumentasi"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Foto Dokumentasi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                                <div class="container" id="">
                                    <p><?= nl2br(htmlspecialchars($riwayat["laporan"]))?></p>                                        
                                </div>
                            </div>
                    
                        </div>
                      </div>
                    </div>
                </td>
                </td>
                <td>
                <?php if ($riwayat["status"] === "Belum Diperbaiki"){?>
                <span class="badge text-bg-danger"> <?=$riwayat["status"]?> </span> 
            
                <?php }else if ($riwayat["status"] === "Sedang Diperbaiki") {?>
                    <span class="badge text-bg-warning"> <?=$riwayat["status"]?> </span> 
                <?php }else { ?>
                    <span class="badge text-bg-info"> <?=$riwayat["status"]?> </span> 
                <?php } ?>  

                </td>
                <td>
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#foto_dokumentasi<?=$riwayat["id_dokumentasi"]?>">
                    <i class="fa-regular fa-file-image"></i>         
                </button>
                    <div class="modal fade" id="foto_dokumentasi<?=$riwayat["id_dokumentasi"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Foto Dokumentasi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                                <div class="container" id="">
                                    <div class="col">
                                    <?php foreach(json_decode($riwayat["gambar_dokumentasi"]) as $foto) : ?>
                                        <div class="row mt-2">
                                            <img src="../gambar_dokumentasi/<?= $foto?>" alt="foto dokumentasi"  height="50%">
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                      </div>
                    </div>
                </td>


            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

</div>


<?php 

include "../layout/footer-manajer.php";


?>