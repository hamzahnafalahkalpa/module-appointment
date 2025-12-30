<?php

namespace Hanafalah\ModuleAppointment\Supports;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Supports\PackageManagement;

class BaseModuleAppointment extends PackageManagement implements DataManagement
{
    protected $__config_name = 'module-appointment';
    protected $__module_appointment_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig('module-appointment', $this->__module_appointment_config);
    }
}
