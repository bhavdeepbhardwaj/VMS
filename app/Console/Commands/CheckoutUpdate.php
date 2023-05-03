<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class CheckoutUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checkout Update';

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
     * @return int
     */
    public function handle()
    {
        $checkOutData = \App\Models\Visitor::whereNull('updated_at')->get();

        foreach ($checkOutData as $data)
        {
            \App\Models\Visitor::where('id',$data->id)->update([
                'updated_at' =>  Carbon::now()
            ]);
        }

        dd('Checkout Update has been send successfully');

    }
}
