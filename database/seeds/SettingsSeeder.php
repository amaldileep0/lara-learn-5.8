<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

		$fields = config('settings.fields');

		array_walk($fields, function(&$field, $key) {
			$field['key'] = $key;
			$field['value'] = (string) $field['default'];
			unset($field['default']);
		});

		DB::table('settings')->insert($fields);
    }
}
