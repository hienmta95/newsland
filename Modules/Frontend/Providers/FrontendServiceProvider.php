<?php

namespace Modules\Frontend\Providers;

use App\Minislide;
use App\Tintuc;
use App\Video;
use App\Menu;
use App\Noithat;
use App\Thanhpho;
use App\Theloai;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class FrontendServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');


        $minislide = Minislide::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->toArray();
        $menu = Menu::orderBy('order', 'asc')
            ->get()
            ->toArray();
        $noithat = Noithat::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get()
            ->toArray();
        $info = User::where('id', '1')
            ->first();

        $thanhpho = Thanhpho::with(['quan'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->toArray();

        $theloaiSidebar = Theloai::with(['bietthu' => function($q) {
            $q->with(['image'])
                ->limit(8)
                ->orderBy('updated_at', 'desc');
        }])
            ->orderBy('order', 'asc')
            ->get()
            ->toArray();

        $tintucSidebar = Tintuc::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get()
            ->toArray();

        $videoSidebar = Video::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->first()
            ->toArray();

        $menuList = Menu::orderBy('order', 'asc')
            ->get()
            ->toArray();

        $minOrderTheloai = Theloai::min('order');
        $noibatMobile = Theloai::with(['bietthu' => function($q) {
            $q->with(['image'])
                ->orderBy('updated_at', 'desc')
                ->limit(10);
        }])
            ->where('order', $minOrderTheloai)
            ->first()
            ->toArray();

        view()->share('minislide', $minislide);
        view()->share('menu', $menu);
        view()->share('noithat', $noithat);
        view()->share('info', $info);
        view()->share('thanhpho', $thanhpho);
        view()->share('theloaiSidebar', $theloaiSidebar);
        view()->share('noibatMobile', $noibatMobile);
        view()->share('tintucSidebar', $tintucSidebar);
        view()->share('videoSidebar', $videoSidebar);
        view()->share('menuList', $menuList);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('frontend.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'frontend'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/frontend');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/frontend';
        }, \Config::get('view.paths')), [$sourcePath]), 'frontend');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/frontend');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'frontend');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'frontend');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
