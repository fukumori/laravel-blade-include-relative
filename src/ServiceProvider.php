<?php

namespace LFukumori\BladeIncludeRelative;

class ContactFormServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->afterResolving('blade.compiler', function (\Illuminate\View\Compilers\BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive('each', function ($expression) use ($bladeCompiler) {
                $path = dirname($bladeCompiler->getPath());

                return "<?php \$__env->addLocation('{$path}'); echo \$__env->renderEach({$expression}); ?>";
            });
            $bladeCompiler->directive('include', function ($expression) use ($bladeCompiler) {
                if (\Illuminate\Support\Str::startsWith($expression, '(')) {
                    $expression = substr($expression, 1, -1);
                }
                $path = dirname($bladeCompiler->getPath());

                return "<?php \$__env->addLocation('{$path}'); echo \$__env->make({$expression}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
            });
            $bladeCompiler->directive('includeIf', function ($expression) use ($bladeCompiler) {
                if (\Illuminate\Support\Str::startsWith($expression, '(')) {
                    $expression = substr($expression, 1, -1);
                }
                $path = dirname($bladeCompiler->getPath());

                return "<?php if (\$__env->exists({$expression})) { \$__env->addLocation('{$path}'); echo \$__env->make({$expression}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); } ?>";
            });
            $bladeCompiler->directive('includeWhen', function ($expression) use ($bladeCompiler) {
                if (\Illuminate\Support\Str::startsWith($expression, '(')) {
                    $expression = substr($expression, 1, -1);
                }
                $path = dirname($bladeCompiler->getPath());

                return "<?php \$__env->addLocation('{$path}'); echo \$__env->renderWhen($expression, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>";
            });
            $bladeCompiler->directive('includeFirst', function ($expression) use ($bladeCompiler) {
                if (\Illuminate\Support\Str::startsWith($expression, '(')) {
                    $expression = substr($expression, 1, -1);
                }
                $path = dirname($bladeCompiler->getPath());

                return "<?php \$__env->addLocation('{$path}'); echo \$__env->first({$expression}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
            });
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }
}
