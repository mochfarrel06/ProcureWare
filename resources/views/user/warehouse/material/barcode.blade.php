<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Barcode</title>
    <style>
        /* Set ukuran kertas 10x2 cm */
        @page {
            size: 10cm 2cm;
        }

        .barcode {
            width: 100%;
            height: auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="barcode">
        {{-- Menampilkan barcode dari kode unik --}}
        {!! DNS1D::getBarcodeHTML($unique_code, 'C128', 2, 60) !!}
        <p>{{ $unique_code }}</p>
    </div>
</body>

</html>
