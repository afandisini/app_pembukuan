<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>
</head>
<body>
    <script>window.print();</script>
    <table style="width:100%" border="1">
       <?php for($i = 1; $i<= 8; $i++){?>
        <tr>
            <th>
                <br>
                <?php
                    // This will output the barcode as HTML output to display in the browser
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($a->barang_id, $generator::TYPE_CODE_128)) . '">';
                    echo '<br>'.$a->barang_id;
                    echo '<br>'.$a->barang_nama.'<br>';
                ?>
                <br>
            </th>
            <th>
                <br>
                <?php
                    // This will output the barcode as HTML output to display in the browser
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($a->barang_id, $generator::TYPE_CODE_128)) . '">';
                    echo '<br>'.$a->barang_id;
                    echo '<br>'.$a->barang_nama.'<br>';
                ?>
                <br>
            </th>
        </tr>
        <?php }?>
    </table>
</body>
</html>