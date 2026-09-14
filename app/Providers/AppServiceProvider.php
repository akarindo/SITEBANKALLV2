<?php

namespace App\Providers;

use App\Models\JaringanKantorModel;
use App\Models\SeoSettingModel;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8');

        View::composer('*', function ($view) {

            // kantor global
            $kantors = JaringanKantorModel::all();
            $view->with('kantorglobal', $kantors);

            // SEO GLOBAL (tanpa page)
            $og = SeoSettingModel::select('title', 'description', 'image')
                ->latest()
                ->first();

            if (!$og) {
                $og = (object)[
                    'title' =>  config('subdomain.APP_NAME'),
                    'description' => 'Website resmi ' . config('subdomain.APP_NAME'),
                    'image' => ''
                ];
            }
            $view->with('og', $og);


            // visitor global footer
            $adminIp = null;
            // $adminIp = (auth()->check() && auth()->user()->role == 0)
            //     ? $request->ip()
            //     : null;

            $total_visitor = Visitor::when($adminIp, function ($query) use ($adminIp) {
                $query->where('ip_address', '!=', $adminIp);
            })
                ->distinct('ip_address')
                ->count('ip_address');

            $today_visitor = Visitor::whereDate('visited_at', date('Y-m-d'))
                ->when($adminIp, function ($query) use ($adminIp) {
                    $query->where('ip_address', '!=', $adminIp);
                })
                ->distinct('ip_address')
                ->count('ip_address');

            $view->with('total_visitor', $total_visitor);
            $view->with('today_visitor', $today_visitor);
        });
    }
}
