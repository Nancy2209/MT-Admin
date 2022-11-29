<?php

use App\Models\PressRelease;
use App\Models\ReleaseCategory;
use App\Models\ReportCategory;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertDataIntoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $admins = [
            [
                'name' => 'Vishnu Sharma',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('111111'),
            ]
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }


        $releases = [
            [
                'name' => 'Press Release'
            ],
            ['name' => 'Postal Ballot'],
            ['name' => 'statutory-communication'],
            ['name' => 'shareholding-pattern']

        ];

        foreach ($releases as $category) {
            ReleaseCategory::create($category);
        }


        $releases = [
            [
                'name' => 'Financial Report'
            ],
            ['name' => 'Reserch Report']

        ];

        foreach ($releases as $category) {
            ReportCategory::create($category);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
