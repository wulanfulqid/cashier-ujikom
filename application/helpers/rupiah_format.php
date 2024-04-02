<?php
function format_rupiah($amount, $decimal = 0) {
    return "Rp. " . number_format($amount, $decimal, ',', '.');
}

// Usage
$totalBelanja = 1234567.89;
echo format_rupiah($totalBelanja, 2);
?>
