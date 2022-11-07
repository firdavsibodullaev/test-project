<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->callAfterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $this->registerDirectives($bladeCompiler);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }

    protected function registerDirectives(BladeCompiler $bladeCompiler)
    {
        $bladeCompiler->directive('quotes', function ($item) {
            return "<?php echo is_numeric($item) ? e($item) : '\"'. e($item) .'\"' ?>";
        });
    }
}
