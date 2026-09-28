<?php

namespace loader;

class Psr4ClassLoader{
    

private string $prefix;
private string $root_dir;

public function __construct(string $prefix, string $root_dir){
    $this->prefix = $prefix;
    $this->root_dir = $root_dir;
}

public function loadClass(string $classname): void {
    if (!str_starts_with($classname, $this->prefix)) {
        return;
    }
    $relativeClass = substr($classname, strlen($this->prefix));

    $filePath = str_replace('\\', "/", $relativeClass);

    $filename = $this->root_dir . "/" . $filePath . ".php";

    if (is_file($filename)) {
        require_once $filename;
}
}

public function register(): void{
    spl_autoload_register([$this, 'loadClass']);
}
}