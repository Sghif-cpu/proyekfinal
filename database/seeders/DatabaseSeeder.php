<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Poli;
use App\Models\Penjamin;
use App\Models\Dokter;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =========================================
        // ROLES
        // =========================================
        $adminRole = Role::updateOrCreate(
            ['name' => 'Admin'],
            ['name' => 'Admin']
        );

        $dokterRole = Role::updateOrCreate(
            ['name' => 'Dokter'],
            ['name' => 'Dokter']
        );

        $kasirRole = Role::updateOrCreate(
            ['name' => 'Kasir'],
            ['name' => 'Kasir']
        );


        // =========================================
        // USER ADMIN
        // =========================================
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('admin123'),
                'role_id'  => $adminRole->id,
                'status'   => 'active'
            ]
        );


        // =========================================
        // POLI
        // =========================================
        $poliUmum = Poli::updateOrCreate(
            ['nama_poli' => 'Poli Umum'],
            ['deskripsi' => 'Pelayanan umum']
        );

        $poliGigi = Poli::updateOrCreate(
            ['nama_poli' => 'Poli Gigi'],
            ['deskripsi' => 'Pelayanan kesehatan gigi']
        );


        // =========================================
        // PENJAMIN
        // =========================================
        $umum = Penjamin::updateOrCreate(
            ['nama_penjamin' => 'Umum'],
            ['tipe' => 'Pribadi']
        );

        $bpjs = Penjamin::updateOrCreate(
            ['nama_penjamin' => 'BPJS'],
            ['tipe' => 'Asuransi']
        );


        // =========================================
        // DOKTER
        // =========================================
        Dokter::updateOrCreate(
            ['sip' => 'SIP001'],
            [
                'nama'    => 'dr. Budi',
                'poli_id' => $poliUmum->id,
                'no_hp'   => '08123456789'
            ]
        );

        Dokter::updateOrCreate(
            ['sip' => 'SIP002'],
            [
                'nama'    => 'drg. Sinta',
                'poli_id' => $poliGigi->id,
                'no_hp'   => '08987654321'
            ]
        );
    }
}
