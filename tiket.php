<?php
class Tiket {
    public $namaPembeli;
    public $kategori;
    public $jumlah;
    private $daftarHarga = [
        "Reguler" => 50000,
        "VIP" => 100000,
        "VVIP" => 200000
    ];

    public function __construct($nama, $kat, $qty) {
        $this->namaPembeli = htmlspecialchars($nama);
        $this->kategori = $kat;
        $this->jumlah = (int)$qty;
    }

    public function hitungTotal() {
        return $this->daftarHarga[$this->kategori] * $this->jumlah;
    }

    public function cetakStruk() {
        return "<h3>Konfirmasi Pesanan</h3>" .
               "Nama: " . $this->namaPembeli . "<br>" .
               "Kategori: " . $this->kategori . "<br>" .
               "Jumlah: " . $this->jumlah . " Tiket<br>" .
               "Total Bayar: <b>Rp " . number_format($this->hitungTotal(), 0, ',', '.') . "</b>";
    }
}
?>