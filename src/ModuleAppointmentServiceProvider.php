<?php

namespace Hanafalah\ModuleAppointment;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class ModuleAppointmentServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMainClass(ModuleAppointment::class)
            // ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers([
                '*'
            ]);
    }


    protected function dir(): string
    {
        return __DIR__ . '/';
    }
}
