<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentRequestServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('getStatusClass', function ($status) {
                switch ($status) {
                    case 'Pending':
                        return 'status-pending';
                    case 'Approved':
                        return 'status-approved';
                    case 'Declined':
                        return 'status-declined';
                    case 'Completed':
                        return 'status-completed';
                    default:
                        return '';
                }
            });
        });
    }

    public function register()
    {
        //
    }
}
