<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=pembayaran_$kategori.xls");

?>

<html>
    <body>
        
        <table border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>No. KTP</th>
                        <th>Nama Jemaah</th>
                        <th>Nomor Rekening</th>
                        <th>Pemilik Rekening</th>
                        <th>Nama Bank</th>
                        <th>Jumlah Bayar</th>
                        <th>Bank Tujuan</th>
                        <th>Tanggal Transfer</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($pembayaran as $row) : ?>
                        <tr>
                            <td valign=top><?= $i++; ?></td>
                            <td valign=top><?= $row['namaPaket']; ?></td>
                            <td valign=top><?= $row['noKtp']; ?></td>
                            <td valign=top><?= $row['namaJemaah']; ?></td>
                            <td valign=top><?= $row['noRek']; ?></td>
                            <td valign=top><?= $row['pemilikRek']; ?></td>
                            <td valign=top><?= $row['namaBank']; ?></td>
                            <td valign=top><?= $row['jumlahBayar']; ?></td>
                            <td valign=top><?= $row['bankTujuan']; ?></td>
                            <td valign=top><?= $row['tglTransfer']; ?></td>
                            <td valign=top><?= $row['statusPembayaran']; ?></td>     
                        </tr>
                    <?php endforeach; ?>
                </tbody>

        </table>
    </body>
</html>