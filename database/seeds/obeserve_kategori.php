<?php

use App\Models\ObserveCategory;
use Illuminate\Database\Seeder;

class obeserve_kategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cat = [
            [
                'title' => 'Terdampak',
                'deskripsi' => 'Merupakan satuan orang / korban / individu yang berkaitan dengan bantuan'
            ],
            [
                'title' => 'Barang',
                'deskripsi' => 'Satuan barang yang di butuhkan saat bencana'
            ],
            [
                'title' => 'Tenaga',
                'deskripsi' => 'Relawan / Jasa yang digunakan saat bencana'
            ]
        ];

        ObserveCategory::truncate();
        foreach ($cat as $key => $value)
        {
            $cat = ObserveCategory::create($value);
            $cat->save();
        }

    }
}
