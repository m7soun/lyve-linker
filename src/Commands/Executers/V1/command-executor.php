#!/usr/bin/env php
<?php

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'Config', 'Registries', 'V1', 'CommandRegistry.php']);


use Linker\Commands\Config\Registries\V1\CommandRegistry;

// Get the command and version from the command line
$commandWithVersion = isset($argv[1]) ? $argv[1] : null;

list($command, $version) = explode(' ', $commandWithVersion);
var_dump($command);
var_dump($version);
// Retrieve the available commands from the registry
$commands = CommandRegistry::getCommands();

// Traverse the commands hierarchy
$commandParts = explode(':', $command);
$currentCommands = $commands;
foreach ($commandParts as $commandPart) {
    if (isset($currentCommands[$commandPart])) {
        $currentCommands = $currentCommands[$commandPart];
    } else {
        echo "Unknown command or subcommand: '{$command}'\n";
        exit;
    }
}

// Execute the final command if it exists for the specified version
if (isset($currentCommands[$version])) {
    $commandClass = $currentCommands[$version];
    $commandInstance = new $commandClass();
    $commandInstance->execute();
} else {
    echo "Unknown version: '{$version}'\n";
}
