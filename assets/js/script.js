document.addEventListener('DOMContentLoaded', function() {
    // Script untuk menghitung total harga dan kembalian
    const jumlahInput = document.getElementById('jumlah');
    const uangDibayarInput = document.getElementById('uang_dibayar');
    
    if (jumlahInput && uangDibayarInput) {
        jumlahInput.addEventListener('input', calculateTotal);
        uangDibayarInput.addEventListener('input', calculateChange);
    }
    
    function calculateTotal() {
        const harga = <?= isset($produk) ? $produk->harga : 0 ?>;
        const jumlah = parseInt(jumlahInput.value) || 0;
        const totalHarga = harga * jumlah;
        
        // Update minimal uang dibayar
        uangDibayarInput.min = totalHarga;
    }
    
    function calculateChange() {
        const harga = <?= isset($produk) ? $produk->harga : 0 ?>;
        const jumlah = parseInt(jumlahInput.value) || 0;
        const uangDibayar = parseInt(uangDibayarInput.value) || 0;
        const totalHarga = harga * jumlah;
        const kembalian = uangDibayar - totalHarga;
        
        // Tampilkan alert jika uang kurang
        if (uangDibayar < totalHarga) {
            alert('Uang yang dibayar kurang!');
        }
    }
});