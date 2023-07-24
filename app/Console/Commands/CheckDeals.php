<?php

namespace App\Console\Commands;

use App\Models\FlashDeal;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckDeals extends Command
{
    protected $signature = 'check:deals';

    protected $description = 'This Command checks the active deals for expiratoin';

    // Code here will be performed when you write the command
    public function handle(): void
    {
        $activeDeals = FlashDeal::where('active', 1)->get();
        // $currentTime = now();          // helper method
        $currentTime = Carbon::now();  // carbon method
        foreach ($activeDeals as $deal) {
            if($deal->end_at->lessThan($currentTime))
            {
                $deal->update([
                    'active' => 0,
                ]);
                // then If user open homepage controller will not find this deal
                // but we want to automatice this operation, so we will make the kernal code do it automatically
                
                logger("A Deal has been ended");
                $this->info("A Deal has been ended ");
            }
        }

        // logger('Hii');
        // $this->info('The command was successful!');
        // $this->newLine(3);
        // $this->error('Something went wrong!');
        // $this->newLine(3);
        // $this->line('Display this on the screen');
    }
}
