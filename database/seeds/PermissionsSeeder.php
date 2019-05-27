<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $name => $label) {
            Permission::firstOrCreate(['name' => $name, 'label' => $label]);
        }

        $this->command->info('Permissões iniciais criadas.');

    }
}
