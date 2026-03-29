<?php
class Tiket {
    public $namaPembeli;
    public $kategori;
    public $jumlah;
    private $daftarHarga = [
        "Reguler" => 50000,
        "VIP"     => 100000,
        "VVIP"    => 200000
    ];

    public function __construct($nama, $kat, $qty) {
        if (!array_key_exists($kat, $this->daftarHarga)) {
            throw new InvalidArgumentException("Kategori '$kat' tidak valid.");
        }
        $qty = (int)$qty;
        if ($qty < 1 || $qty > 10) {
            throw new InvalidArgumentException("Jumlah tiket harus antara 1–10.");
        }
        $this->namaPembeli = htmlspecialchars(trim($nama), ENT_QUOTES, 'UTF-8');
        $this->kategori    = htmlspecialchars($kat, ENT_QUOTES, 'UTF-8');
        $this->jumlah      = $qty;
    }

    public function getHargaSatuan(): int {
        return $this->daftarHarga[$this->kategori];
    }

    public function hitungTotal(): int {
        return $this->getHargaSatuan() * $this->jumlah;
    }

    public function cetakStruk(): string {
        $hargaSatuan = number_format($this->getHargaSatuan(), 0, ',', '.');
        $total       = number_format($this->hitungTotal(), 0, ',', '.'); // ✅ $this diperbaiki
        return "  
            <div class='struk'>
                <h3>🎟️ Konfirmasi Pesanan</h3>
                <table>
                    <tr><td>Nama</td><td>: {$this->namaPembeli}</td></tr>
                    <tr><td>Kategori</td><td>: {$this->kategori}</td></tr>
                    <tr><td>Harga Satuan</td><td>: Rp {$hargaSatuan}</td></tr>
                    <tr><td>Jumlah</td><td>: {$this->jumlah} Tiket</td></tr>
                    <tr><td><b>Total Bayar</b></td><td>: <b>Rp {$total}</b></td></tr>
                </table>
            </div>
        "; // ✅ return string lengkap
    }
}
?>