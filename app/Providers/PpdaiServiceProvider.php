<?php

namespace App\Providers;

use App\Services\PpdaiService;
use Illuminate\Support\ServiceProvider;

class PpdaiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //使用bind绑定实例到接口以便依赖注入
        $this->app->bind('PpdaiService',function(){
            return PpdaiService::getInstance();
        });
    }
}
