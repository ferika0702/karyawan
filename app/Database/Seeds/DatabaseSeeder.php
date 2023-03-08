<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('DivisiSeeder');
        $this->call('PermissionSeeder');
        $this->call('GroupSeeder');
        $this->call('UserSeeder');
        $this->call('SupplierSeeder');
        // $this->call('ProdukSeeder');
    }
}
