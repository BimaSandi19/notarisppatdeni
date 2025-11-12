<x-mail::message>
# Pengingat Tagihan

<h3>Nama Nasabah : {{ $nama_nasabah }}</h3>
<h3>Nomor Kwitansi : {{ $nomor_kwitansi }}</h3>
<h3>Nominal Tagihan : Rp {{ number_format($nominal_tagihan, 0, ',', '.') }}</h3>
<h3>Tanggal Jatuh Tempo : {{ $tanggal_tagihan }}</h3>
<h3>Status Pembayaran : {{ $status_pembayaran }}</h3>
@if($keterangan)
    <h3>Keterangan : {{ $keterangan }}</h3>
@endif

Terima kasih.
</x-mail::message>
