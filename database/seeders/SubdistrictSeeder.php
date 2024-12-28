<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $subdistricts = [
        [1,1, "Cipedes"], [2,1, "Mangkubumi"], [3,1, "Cibereum"], [4,1, "Purbaratu"], [5,1, "Awipari"],
        [6, 2, "Binong"], [7, 2, "Kacapiring"], [8, 2, "Kebonwaru"], [9, 2, "Samoja"], [10, 2, "Cibangkong"],
        [11, 3, "Batulawang"], [12, 3, "Karyamukti"], [13, 3, "Mulyasari"], [14, 3, "Sukamukti"], [15, 3, "Pataruman"],
        [16,4, "Batutulis"], [17,4, "Bojongkerta"], [18,4, "Cikaret"], [19,4, "Cipaku"], [20,4, "Empang"],
        [21, 5, "Jatiasih"], [22, 5, "Jatisampurna"], [23, 5, "Medansatria"], [24, 5, "Pondokgede"], [25, 5, "Pondokmelati"],
        [26, 6, "Asemrowo"], [27, 6, "Benowo"], [28, 6, "Bubutan"], [29, 6, "Bulak"], [30, 6, "Gayungan"],
        [31, 7, "Blimbing"], [32,7, "Klojen"], [33,7, "Lowokwaru"], [34,7, "Sukun"], [35,7, "Kedungkandang"],
        [36, 8, "Bukir"], [37, 8, "Gadingrejo"], [38, 8, "Karangketug"], [39, 8, "Krapyakrejo"], [40, 8, "Petahunan"],
        [41, 9, "Bendogerit"], [42, 9, "Gedog"], [43, 9, "Klampok"], [44, 9, "Plosokerep"], [45, 9, "Rembang"],
        [46, 10, "Manguharjo"], [47,10, "Ngegong"], [48,10, "Pangongangan"], [49,10, "Patihan"], [50,10, "Winongo"],
        [51, 11, "Cepoko"], [52, 11, "Kalisegoro"], [53, 11, "Kandiri"], [54, 11, "Mangunsari"], [55, 11, "Ngijo"],
        [56, 12, "Muarareja"], [57, 12, "Pekauman"], [58, 12, "Tegalsari"], [59, 12, "Kraton"], [60, 12, "Kemandungan"],
        [61, 13, "Bumi"], [62,13, "Jajar"], [63,13, "Kerten"], [64,13, "Pajang"], [65,13, "Penumping"],
        [66, 14, "Cacaban"], [67, 14, "Panjang"], [68, 14, "Gelangan"], [69, 14, "Kemirirejo"], [70, 14, "Potrobangsan"],
        [71, 15, "Bener"], [72, 15, "Boja"], [73, 15, "Cilopandang"], [74, 15, "Jenang"], [75, 15, "Mulyadadi"]
    ];

    public function run(): void
    {
        foreach ($this->subdistricts as $subdistrict) {
            \App\Models\Subdistrict::create([
                "id" => $subdistrict[0],
                "city" => $subdistrict[1],
                "subdistrict" => $subdistrict[2],
            ]);
        }
    }
}
