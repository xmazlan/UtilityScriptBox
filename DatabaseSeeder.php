<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserPermissionSeeder::class,
        ]);

        $path = [
            'database/sqlFiles/default_version.sql' => 'default version',
            'database/sqlFiles/tb_employees.sql' => 'tb employees',
            'database/sqlFiles/tb_materials.sql' => 'tb materials',
            'database/sqlFiles/tb_machines.sql' => 'tb machines',
            'database/sqlFiles/tb_suppliers.sql' => 'tb suppliers',
            'database/sqlFiles/tb_buyers.sql' => 'tb buyers',
            'database/sqlFiles/tb_purchases.sql' => 'tb purchases',
            'database/sqlFiles/tb_order_details.sql' => 'tb order details',
            'database/sqlFiles/tb_payments.sql' => 'tb payments',
            'database/sqlFiles/tb_invoices.sql' => 'tb invoices',
            'database/sqlFiles/tb_cylinders.sql' => 'tb cylinders',
            'database/sqlFiles/tb_invoice_details.sql' => 'tb invoice details',
            'database/sqlFiles/visit_access.sql' => 'visit access',
        ];

        $longestTableName = null;
        $lengestTableNameChar = 0;
        foreach ($path as $key => $value) {
            if (strlen($value) > $lengestTableNameChar) {
                $longestTableName = $value;
                $lengestTableNameChar = strlen($value);
            }
        }

        // $this->command->info('the longest table name is: ' . $longestTableName . ' with ' . $lengestTableNameChar . ' characters' . \PHP_EOL);

        foreach ($path as $key => $value) {
            $addingSpace = str_repeat(' ', strlen($longestTableName) - strlen($value));
            $this->seedTable($key, str()->upper($value), $addingSpace);
        }
    }

    private function seedTable($path, $tableName, $addingSpace)
    {
        $seed = DB::unprepared(file_get_contents($path));
        if ($seed) {
            $this->command->info('seeded: ' . $tableName . $addingSpace . ' from ' . $path);
        } else {
            $this->command->error('failed to seed: ' . $tableName . $addingSpace . ' from ' . $path);
        }
    }
}
