<?php
// linker/src/CommandRegistry.php

namespace Linker\Commands\Config\Registries\V1;

class CommandRegistry
{
    /**
     * Returns an array of available commands.
     *
     * @return array
     */
    public static function getCommands()
    {
        return [
            'publish' => [
                'config' => [
                    'database' => [
                        'v1' => \Linker\Commands\v1\PublishConfigDatabaseCommand::class,
                    ],
                ],
            ],
        ];
    }
}
