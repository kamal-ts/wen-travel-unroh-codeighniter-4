<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Jemaah$kategori.xls");

?>

<html>
    <body>
        
        <table border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <?php if($kategori == 'umroh') : ?>
                            <th>Jam Berangkat</th>
                        <?php endif; ?>
                        
                        <th>Status Jemaah</th>
                        <th>No. KTP</th>
                        <th>No. Paspor</th>
                        <th>Nama Jemaah</th>
                        <th>Nama Ayah Kandung</th>
                        <th>Nama Ibu Kandung</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Alamat Rumah</th>
                        <th>Kelurahan</th>
                        <th>Kota</th>
                        <th>Kode POS</th>
                        <th>Telpon Rumah</th>
                        <th>Telpon Mobile</th>
                        <th>Pekerjaan</th>
                        <th>Ukuran Pakaian</th>
                        <th>Nama Mahram</th>
                        <th>Emai</th>
                        <th>Status Perkawinan</th>
                        <th>Tanggal Berangkat</th>
                        <th>Tanggal Kemabali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($jemaah as $row) : ?>
                        <tr>
                            <td valign=top><?= $i++; ?></td>
                            <td valign=top><?= $row['namaPaket']; ?></td>

                            <?php if($kategori == 'umroh') : ?>
                            <td valign=top><?= $row['jamBerangkat']; ?></td>
                            <?php endif; ?>

                            <td valign=top><?= $row['statusJemaah']; ?></td>
                            <td valign=top><?= $row['noKtp']; ?></td>
                            <td valign=top><?= $row['noPaspor']; ?></td>
                            <td valign=top><?= $row['namaJemaah']; ?></td>
                            <td valign=top><?= $row['namaAyahKandung']; ?></td>
                            <td valign=top><?= $row['namaIbuKandung']; ?></td>
                            <td valign=top><?= $row['tempatLahir']; ?>, <?= $row['tempatLahir']; ?></td>
                            <td valign=top><?= $row['alamatRumah']; ?></td>
                            <td valign=top><?= $row['kelurahan']; ?></td>
                            <td valign=top><?= $row['kota']; ?></td>
                            <td valign=top><?= $row['kodePos']; ?></td>
                            <td valign=top><?= $row['telponRumah']; ?></td>
                            <td valign=top><?= $row['telponMobile']; ?></td>
                            <td valign=top><?= $row['pekerjaan']; ?></td>
                            <td valign=top><?= $row['ukuranPakaian']; ?></td>
                            <td valign=top><?= $row['namaMahram']; ?></td>
                            <td valign=top><?= $row['email']; ?></td>
                            <td valign=top><?= $row['statusPerkawinan']; ?></td>
                            <td valign=top><?= $row['tglKembali']== '0000-00-00' ? '-' : $row['tglKembali']; ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>

        </table>
    </body>
</html>