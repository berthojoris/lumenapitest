<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Resource::withoutWrapping();
        $request = app('request');
        if ($request->isMethod('OPTIONS'))
        {
            app()->options($request->path(), function() { return response('', 200); });
        }
    }
}
