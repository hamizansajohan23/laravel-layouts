<?php

namespace Database\Seeders;

use App\Models\Bahagian;
use Illuminate\Database\Seeder;

class BahagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bahagians = [
            ['nama_bahagian' => 'Pejabat YBM', 'nama_pendek' => 'PEJ YB Menteri'],
            ['nama_bahagian' => 'Pejabat YBTM I', 'nama_pendek' => 'PEJ YBTM I'],
            ['nama_bahagian' => 'Pejabat YBTM II', 'nama_pendek' => 'PEJ YBTM II'],
            ['nama_bahagian' => 'Pejabat KSU', 'nama_pendek' => 'PEJ KSU'],
            ['nama_bahagian' => 'Pejabat TKSU (D)', 'nama_pendek' => 'PEJ TKSU(D)'],
            ['nama_bahagian' => 'Pejabat TKSU (P)', 'nama_pendek' => 'PEJ TKSU(P)'],
            ['nama_bahagian' => 'Pejabat SUBK (KP)', 'nama_pendek' => 'PEJ SUBK(KP)'],
            ['nama_bahagian' => 'PKN Selangor', 'nama_pendek' => 'PKN SEL'],
            ['nama_bahagian' => 'PKN Pahang', 'nama_pendek' => 'PKN PHG'],
            ['nama_bahagian' => 'PKN Johor', 'nama_pendek' => 'PKN JHR'],
            ['nama_bahagian' => 'PKN Negeri Sembilan/Melaka', 'nama_pendek' => 'PKN N9'],
            ['nama_bahagian' => 'PKN Perak', 'nama_pendek' => 'PKN PRK'],
            ['nama_bahagian' => 'PKN Kelantan', 'nama_pendek' => 'PKN KLTN'],
            ['nama_bahagian' => 'PKN Terengganu', 'nama_pendek' => 'PKN TGGNU'],
            ['nama_bahagian' => 'PKN Kedah/Perlis/Pulau Pinang', 'nama_pendek' => 'PKN KPP'],
            ['nama_bahagian' => 'PKN Sarawak', 'nama_pendek' => 'PKN SRWK'],
            ['nama_bahagian' => 'PKN Sabah', 'nama_pendek' => 'PKN SBH'],
            ['nama_bahagian' => 'Bahagian Perancangan Strategik', 'nama_pendek' => 'BHG R'],
            ['nama_bahagian' => 'Bahagian Pembangunan Usahawan Desa', 'nama_pendek' => 'BHG UD'],
            ['nama_bahagian' => 'Bahagian Komuniti Desa', 'nama_pendek' => 'BHG KD'],
            ['nama_bahagian' => 'Bahagian Korporat dan Pembangunan Kemahiran', 'nama_pendek' => 'BHG K'],
            ['nama_bahagian' => 'Bahagian Penyelarasan dan Pemantauan', 'nama_pendek' => 'BHG PP'],
            ['nama_bahagian' => 'Bahagian Prasarana', 'nama_pendek' => 'BHG PRA'],
            ['nama_bahagian' => 'Bahagian Kemajuan Tanah dan Wilayah', 'nama_pendek' => 'BHG TW'],
            ['nama_bahagian' => 'Bahagian Kesejahteraan Rakyat', 'nama_pendek' => 'BHG KR'],
            ['nama_bahagian' => 'Bahagian Teknikal', 'nama_pendek' => 'BHG TEK'],
            ['nama_bahagian' => 'Bahagian Pentadbiran dan Pengurusan Aset', 'nama_pendek' => 'BHG P'],
            ['nama_bahagian' => 'Bahagian Perolehan', 'nama_pendek' => 'BHG PER'],
            ['nama_bahagian' => 'Bahagian Pengurusan Sumber Manusia', 'nama_pendek' => 'BHG PSM'],
            ['nama_bahagian' => 'Bahagian Akaun', 'nama_pendek' => 'BHG A'],
            ['nama_bahagian' => 'Bahagian Kewangan', 'nama_pendek' => 'BHG KEW'],
            ['nama_bahagian' => 'Bahagian Pengurusan Maklumat', 'nama_pendek' => 'BHG ICT'],
            ['nama_bahagian' => 'Unit Perundangan', 'nama_pendek' => 'PUU'],
            ['nama_bahagian' => 'Unit Audit Dalam', 'nama_pendek' => 'UAD'],
            ['nama_bahagian' => 'Unit Komunikasi Korporat', 'nama_pendek' => 'UKK'],
            ['nama_bahagian' => 'Unit Integriti', 'nama_pendek' => 'UI'],
            ['nama_bahagian' => 'Bahagian Antarabangsa', 'nama_pendek' => 'BHG AB'],
        ];

        foreach ($bahagians as $bahagian) {
            Bahagian::firstOrCreate(
                ['nama_bahagian' => $bahagian['nama_bahagian']],
                ['nama_pendek' => $bahagian['nama_pendek']]
            );
        }
    }
}
