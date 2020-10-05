<?php

spl_autoload_register(function ($className) {
    $className = str_replace('GameTest\\', '', $className);
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    include __DIR__ . '/../' . $className . '.php';
});
