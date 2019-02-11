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
        $this->info('This command will delete ALL conversations in the database.');
        
        if (!$this->confirm('Do you wish to continue?')) {
            return;
        }

        try {
            DB::table('conversation_user')->truncate();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $this->info('Conversations has been correctly purged!');
    }
}
