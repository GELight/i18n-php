<?php

include_once "vendor/autoload.php";

use GELight\translation\{translation};

$translationInstance = new translation();
$translationInstance->setCurrentLocale("en_US");

$translationInstance->loadTranslations(__DIR__."/src/translations");

echo "<pre style='background: #ffc; padding: 1rem; border: 1px dashed #000;'>";
echo $translationInstance->t("hello");
echo "</pre>";
