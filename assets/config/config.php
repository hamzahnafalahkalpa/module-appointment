<?php

use Hanafalah\ModuleAppointment\{
    Models,
    Schemas,
    Contracts,
    Commands
};

return [
    'namespace' => 'Hanafalah\\ModuleAppointment',
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ]
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
        ]
    ],
    'commands'  => [
        // Commands\InstallMakeCommand::class
    ],
    'reference_types' => [
    ],
];
