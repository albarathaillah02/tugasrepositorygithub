<?php include 'Tiket.php'; ?>
<form method="POST">
    <input type="text" name="nama" placeholder="Nama Pembeli" required><br>
    <select name="kategori">
        <option value="Reguler">Reguler - Rp 50.000</option>
        <option value="VIP">VIP - Rp 100.000</option>
        <option value="VVIP">VVIP - Rp 200.000</option>
    </select><br>
    <input type="number" name="jumlah" placeholder="Jumlah Tiket" min="1" required><br>
    <button type="submit" name="pesan">Pesan Sekarang</button>
</form>

<?php
if(isset($_POST['pesan'])){
    $order = new Tiket($_POST['nama'], $_POST['kategori'], $_POST['jumlah']);
    echo $order->cetakStruk();
}
?>