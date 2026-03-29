<?php include 'Tiket.php';
$pesan_sukses = '';
$error = '';
$nama = '';  // ✅ Inisialisasi default

if (isset($_POST['pesan'])) {
    $nama    = htmlspecialchars(trim($_POST['nama']), ENT_QUOTES, 'UTF-8');
    $jumlah  = filter_input(INPUT_POST, 'jumlah', FILTER_VALIDATE_INT);
    $kategori = $_POST['kategori'] ?? '';

    try {
        // ✅ Validasi & pembuatan objek dalam try-catch
        $order = new Tiket($nama, $kategori, $jumlah);
        $pesan_sukses = $order->cetakStruk();
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
?>

<?php if ($error): ?>
    <p style="color:red;">⚠️ <?= $error ?></p>
<?php endif; ?>

<?php if ($pesan_sukses): ?>
    <div class="struk"><?= $pesan_sukses ?></div>
<?php else: ?>
<form method="POST">
    <input type="text" name="nama" placeholder="Nama Pembeli"
           value="<?= $nama ?>" required>

    <select name="kategori" id="kategori" onchange="updateTotal()">
        <option value="Reguler">Reguler - Rp 50.000</option>
        <option value="VIP">VIP - Rp 100.000</option>
        <option value="VVIP">VVIP - Rp 200.000</option>
    </select>

    <input type="number" name="jumlah" id="jumlah"
           placeholder="Jumlah Tiket (maks. 10)"
           min="1" max="10" oninput="updateTotal()" required>

    <p id="total"><strong>Total: Rp 0</strong></p>
    <button type="submit" name="pesan">Pesan Sekarang</button>
</form>

<!-- ✅ Tambahkan script updateTotal() -->
<script>
const harga = { Reguler: 50000, VIP: 100000, VVIP: 200000 };

function updateTotal() {
    const kategori = document.getElementById('kategori').value;
    const jumlah   = parseInt(document.getElementById('jumlah').value) || 0;
    const total    = (harga[kategori] * jumlah).toLocaleString('id-ID');
    document.getElementById('total').innerHTML = '<strong>Total: Rp ' + total + '</strong>';
}
</script>
<?php endif; ?>