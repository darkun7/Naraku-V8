<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'id' => 0,
            'deskripsi' => 'Kelompok Tani Karya Tani 2 bertempat di Karang Melok, Kecamatan Tamanan Kabupaten Bondowoso. Salah satu fokus usaha dari organisasi ini adalah produksi pupuk kandang. Segmentasi penjualan dari Karya Tani 2 Bondowoso berfokus pada anggota dan mitra.',
            'deskripsi_naraku' => '<p>Naraku merupakan sistem Neraca Bahan Baku. Sistem ini berfungsi sebagai penghitung batasan maksimum dari produksi pupuk kandang. Hal tersebut bertujuan untuk memaksimalkan penggunaan bahan baku pembuatan pupuk yang tersedia sehingga jumlah pupuk kandang yang diproduksi menjadi optimal.</p><p>Naraku bermitra dengan Kelompok Tani Karya Tani 2 Bondowoso sebagai sistem pemesanan online, sehingga pelanggan yang berminat melakukan pembelian pupuk kandang dapat memesan melalui situs pupuknaraku.com.</p><p>Melalui sistem ini, kami sebagai pengembang berharap sapat membantu Kelompok Tani Karya Tani 2 memaksimalkan produksinya agar mendapatkan profit yang maksimal.</p>', 
            'jumbotron_title' => '<p>Pupuk Organik</p><p>Perkaya Karbon Organik</p>', 
            'jumbotron_text' => '<p>Kesuburan tanah dapat dikembalikan melalui pemberian pupuk organik sesuai kebutuhan.</p><p>Karya Tani 2  Bondowoso dengan tools Naraku akan memberikan rekomendasi kebutuhan pupuk sesuai dengan kondisi lahan anda.</p>', 
            'jumbotron_image' => '', 
            'maps' => 'https://maps.google.com/maps?hl=en&amp;q=-8.0457162,113.8261433', 
            'nomor_wa' => '6285812484192', 
            'instagram' => 'buharto', 
            'maintenance' => 0,
        ]);
        Pengguna::factory(3)->create();
    }
}
