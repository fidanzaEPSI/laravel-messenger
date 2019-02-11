<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Logging\Log;

class PurgeConversations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conversations:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purges the database from all conversations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            DB::table('conversations')->delete();
            DB::table('conversation_user')->delete();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $this->info('Conversations has been correctly purged!');
    }
}
