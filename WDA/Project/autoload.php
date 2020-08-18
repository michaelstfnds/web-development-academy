<?php

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    var_dump(sprintf('app/%s.php', $class));
    require_once sprintf('app/%s.php', $class);
});