<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Crafted - Export to PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center; /* Membuat kontainer menjadi pusat untuk teks */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-expenses {
            margin-top: 20px;
        }

        /* CSS untuk penempatan total penjualan dan total penjualan per bulan */
        .totals-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* Menempatkan elemen ke kanan */
            margin-top: 20px;
        }

        .total-expenses,
        .total-expenses-per-month {
            text-align: right; /* Menempatkan teks ke kanan */
        }

        .total-expenses-per-month {
            margin-top: 10px; /* Menambahkan margin di antara total penjualan dan total penjualan per bulan */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <i class="fas fa-chair"></i>
            <h2>Cozy Crafted</h2>
            <h3>Jl. MH. Thamrin, Citaringgul, Kec. Babakan Madang, Kabupaten Bogor, Jawa Barat 16810 Phone: +62 838 0561 4882.</h3>
            <h4>Pencipta Kenyamanan, Sentuhan Artistik di Setiap Ruang.</h4>
        </div>

        <h3>Data Detail Penjualan</h3>

        <table>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Penjualan</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Produk</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($detailPenjualan)) {
                        $no = 1;
                        $monthlySales = array(); // Initialize array to store monthly sales

                        foreach ($detailPenjualan as $ReadDS) {
                            // Extract year and month from the sale date
                            $saleYearMonth = date('Y-m', strtotime($ReadDS->PenjualanID));

                            // Check if the month is already in the array
                            if (!isset($monthlySales[$saleYearMonth])) {
                                $monthlySales[$saleYearMonth] = 0; // Initialize the monthly total
                            }

                            // Increment the monthly total with the current sale's subtotal
                            $monthlySales[$saleYearMonth] += $ReadDS->Subtotal;

                            // Display the row for the sale
                            ?>
                            <tr>
                                <th scope="row"><?php echo $no; ?></th>
                                <td><?php echo $ReadDS->PenjualanID; ?></td>
                                <td>
                                    <?php 
                                    $productName = '';
                                    foreach ($DataProduk as $produk) {
                                        if ($produk->ProdukID == $ReadDS->ProdukID) {
                                            $productName = $produk->NamaProduk;
                                            break;
                                        }
                                    }
                                    echo $productName;
                                    ?>
                                </td>
                                <td><?php echo $ReadDS->JumlahProduk; ?></td>
                                <td><?php echo "Rp. " . number_format($ReadDS->Subtotal, 2, ',', '.'); ?></td>
                            </tr>
                            <?php
                            $totalExpenses += $ReadDS->Subtotal; // Add each subtotal to total expenses
                            $no++;
                        }
                    }
                ?>
            </tbody>
        </table>

        <!-- Display total daily expenses -->
        <div class="totals-container">
            <div class="total-expenses">
                <strong>Total Penjualan :</strong> Rp. <?php echo number_format($totalExpenses, 2, ',', '.'); ?>
            </div>

            <!-- Display total sales per month -->
            <div class="total-expenses-per-month">
                <strong>Total Penjualan Per Bulan:</strong>
                <ul>
                    <?php
                    foreach ($monthlySales as $month => $monthlyTotal) {
                        echo '<li>' . date('F Y', strtotime($month)) . ': Rp. ' . number_format($monthlyTotal, 2, ',', '.') . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
