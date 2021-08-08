<?php

include_once "vendor/autoload.php";

use GELight\translation\{translation};

$i18n = new translation();
$i18n->setCurrentLocale("en_US");
$i18n->loadTranslations(__DIR__."/translations");

echo $i18n->t("this.is.a.test");
echo $i18n->t("hello");
