<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Contact;
use App\Models\Partner;
use Auth;
class GlobalServiceProvider extends ServiceProvider
{
    public function __construct()
    {
    }
    /**
     * Register services.
     *
     * @return void
     */
    
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function user_details()
    {
        $contact = Contact::where('id',Auth::user()->id)->first();
        return $contact;
        
    }

    public function user_credits()
    {
        $credit = Partner::where('user_id',Auth::user()->id)->first();
        return $credit;
    }
}
