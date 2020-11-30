<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NewsletterEmail;

class NewsletterSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter';

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
        
        foreach(NewsletterEmail::where("sended", 0)->get() as $newsletter){

            $data = ["text" => $newsletter->text, "title" => $newsletter->title];
          
            $to_name = $newsletter->name;
            $to_email = $newsletter->email;
            

            \Mail::send("emails.newsletter", $data, function($message) use ($to_name, $to_email, $newsletter) {

                $message->to($to_email, $to_name)->subject($newsletter->title);
                $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));

            });

                
            

        }

    }
}
