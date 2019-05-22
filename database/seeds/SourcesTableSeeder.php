<?php

use App\Source;
use Illuminate\Database\Seeder;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Source::create(['name' => 'Outbound Calls']);
        Source::create(['name' => 'Inbound Calls']);
        Source::create(['name' => 'Chats and Emails']);
        Source::create(['name' => 'Emails']);
        Source::create(['name' => 'Data Entry']);
        Source::create(['name' => 'Resubmissions']);
        Source::create(['name' => 'QA Review']);
        Source::create(['name' => 'Escalations']);
    }
}
