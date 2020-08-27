<?php
require_once __DIR__.'/Library/MysqliDb.php';
require_once __DIR__.'/Library/dbObject.php';
// project-specific namespace prefix
$project_namespace_prefix = 'Worktest\\';
spl_autoload_register(function ($class) use ($project_namespace_prefix) {

// base directory for the namespace prefix
    $base_dir = __DIR__ . '/App/';

// does the class use the namespace prefix?
    $len = strlen($project_namespace_prefix);
    if (strncmp($project_namespace_prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

// get the relative class name
    $relative_class = substr($class, $len);

// replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

// if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
