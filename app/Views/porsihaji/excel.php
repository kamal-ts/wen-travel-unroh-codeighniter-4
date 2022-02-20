<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_porsi.xls");

?>

<html>
    <body>
        
        <table border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Jemaah</th>
                        <th>Nomor Porsi</th>
                        <th>Harga Pelunasan</th>
                        <th>Tahun Perkiraan Berangkat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($porsi as $row) : ?>
                        <tr>
                            <td valign=top><?= $i++; ?></td>
                            <td valign=top><?= $row['namaJemaah']; ?></td>
                            <td valign=top><?= $row['nomorPorsi']; ?></td>
                            <td valign=top><?= $row['hargaPelunasan']; ?></td>
                            <td valign=top><?= $row['tglBerangkat']; ?></td>  
                        </tr>
                    <?php endforeach; ?>
                </tbody>

        </table>
    </body>
</html>