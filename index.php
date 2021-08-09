<?php

include_once "vendor/autoload.php";

use GELight\translation\{translation};

$i18n = new translation();
$i18n->loadTranslations(__DIR__."/translations");
//$i18n->setCurrentLocale("en_US");
//$i18n->setForcedCallbackLocale("it_IT");

echo $i18n->t("this.is.a.test");
echo "<br/>";
echo $i18n->t("hello");
