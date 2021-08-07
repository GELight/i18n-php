<?php

namespace GELight\translation;

use \Exception;
use JetBrains\PhpStorm\Pure;

class UnknownLocaleException extends Exception {

    #[Pure] public function __construct() {
        parent::__construct("Unknown locale defined!");
    }

}
