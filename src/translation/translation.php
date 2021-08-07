<?php

namespace GELight\translation;

use GELight\translation\{UnknownLocaleException};
use Stenway\Sml\{SmlDocument};
use \ResourceBundle;

class translation {

    private string $defaultLocale;
    private string $currentLocale;
    private array $translations = array();

    private array $locales;

    public function __construct() {
        $this->prepareAvailableLocales();
        $this->setDefaultLocale("en");
    }

    private function prepareAvailableLocales(): void {
        $this->locales = ResourceBundle::getLocales('');
    }

    public function setDefaultLocale(string $locale): void {
        if (in_array($locale, $this->locales)) {
            $this->defaultLocale = $locale;
            if (!isset($this->currentLocale)) {
                $this->currentLocale = $locale;
            }
        } else {
            throw new UnknownLocaleException();
        }
    }

    public function setCurrentLocale(string $locale): void {
        if (in_array($locale, $this->locales)) {
            $this->currentLocale = $locale;
        } else {
            throw new UnknownLocaleException();
        }
    }

    public function loadTranslations(string $path):void {
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                $ext = pathinfo($entry, PATHINFO_EXTENSION);
                if ($entry != "." && $entry != ".." && $ext === "sml") {
                    $smlDocument = SmlDocument::load($path."/".$entry);
                    foreach ($smlDocument->getRoot()->elements() as $element) {
                        $this->translations[$element->getName()] = $element;
                    }
                }
            }
            closedir($handle);
        }
    }

    public function t(string $key): string {

        $lang = $this->calculateLocation();

        //        $root = $this->translations;

//        if ($root->hasElement($this->defaultLocale)) {
//            $t = $root->element($this->defaultLocale);
//
//            // ...recursion...
//
//            return $t->attribute($key)->getString();
//        }

        return "";
    }

    private function calculateLocation() {
        
    }

}