<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-AYK/DfBCm5QUoJZPh7SJo0H5+qhwOL7cWvEVjCvALZ7gldx6ajIfeBOFqNTXj3Bsoj2w/BEKzvwELzkwxc3jPQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Struk Penjualan - Cozy Crafted</title>
    <style>
        @page {
        size: 10cm 15cm; 
        background: #E1F0DA;
    }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
    
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header i {
            font-size: 48px;
            color: #5E7053;
        }
        .header h2, .header h5, .header h6, .header h4 {
            margin: 5px 0;
            color: #5E7053;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
        }
        .card-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #5E7053;
        }
        .card-content {
            margin-bottom: 5px;
            font-size: 12px;
            color: #333;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            color: #5E7053;
        }
    </style>
</head>
<body>
        <div class="header">
            <i class="fas fa-chair" style="color: #5E7053;"></i>
            <h2>Cozy Crafted</h2>
            <h5>Jl. MH. Thamrin, Citaringgul, Kec. Babakan Madang, Kabupaten Bogor, Jawa Barat 16810 Phone: +62 838 0561 4882.</h5>
            <h6>Pencipta Kenyamanan, Sentuhan Artistik di Setiap Ruang.</h6>
            <h4>Tanggal: <?php echo date('Y-m-d'); ?></h4>
        </div>
        <?php if (!empty($DetailPenjualan)): ?>
            <?php foreach ($DetailPenjualan as $detail): ?>
                <div class="card">
                    <?php
                        $ProdukID = $detail->ProdukID;
                        $NamaProduk = '';
                        foreach ($DataProduk as $produk) {
                            if ($produk->ProdukID == $ProdukID) {
                                $NamaProduk = $produk->NamaProduk;
                                break;
                            
                            }
                        }
                    ?>
                    <div class="card-content">
                    <div class="card-title">Nama Produk: <?php echo $NamaProduk; ?></div>
                        <div>Jumlah Barang: <?php echo $detail->JumlahProduk; ?></div>
                        <div class="total">
                            <p>Total: <?php echo number_format($detail->Subtotal, 2, ',', '.'); ?></p>
                        </div>
                    </div>
                </div><br>
            <?php endforeach; ?>
            <div class="header">
            <h5>Terimakasih telah mengunjungi dan telah berbelanja di Cozy Crafted</h5>
            </div>
        <?php else: ?>
            <p>Tidak ada data detail penjualan.</p>
        <?php endif; ?>
</body>
</html>
