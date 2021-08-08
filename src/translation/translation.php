<?php

namespace GELight\translation;

use Stenway\Sml\{SmlDocument, SmlElement};
use \ResourceBundle;
use \Exception;

class translation {

    private string $defaultLocale;
    private string $currentLocale;
    private array $translations = array();
    private string $originalKey;

    private array $locales;

    public function __construct() {
        $this->prepareAvailableLocales();
        $this->setDefaultLocale("de");
        $this->setCurrentLocale($this->getDefaultLocale());
    }

    private function prepareAvailableLocales(): void {
        $this->locales = ResourceBundle::getLocales('');
    }

    public function setDefaultLocale(string $locale): translation {
        if (in_array($locale, $this->locales)) {
            $this->defaultLocale = $locale;
        } else {
            $this->defaultLocale = "de";
            die("Unknown local '".$locale."' defined! The default locale has been set to '".$this->defaultLocale."'.");
        }

        return $this;
    }

    public function getDefaultLocale(): string {
        return $this->defaultLocale;
    }

    public function setCurrentLocale(string $locale): translation {
        if (in_array($locale, $this->locales)) {
            $this->currentLocale = $locale;
        } else {
            $this->currentLocale = $this->getDefaultLocale();
            die("Unknown local '".$locale."' defined! The current locale has been set to '".$this->currentLocale."'.");
        }

        return $this;
    }

    public function getCurrentLocale(): string {
        return $this->currentLocale;
    }

    public function loadTranslations(string $path): translation {
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

        return $this;
    }

    public function t(string $key): string {
        $this->originalKey = $key;
        $translations = $this->translations[$this->getLocale()];

        return $this->getTranslationValue($key, $translations);
    }

    private function getTranslationValue(string $key, SmlElement $translations): string {
        $value = "";

        if (!str_contains($key, ".")) {
            if ($translations->hasAttribute($key)) {
                $value = $translations->attribute($key)->getValues()[0];
            } else {
                $value = $this->originalKey;
            }
        } else {
            $currentKeys = explode(".", $key);
            $nextElement = array_shift($currentKeys);
            $nextKeyName = implode(".", $currentKeys);

            if ($translations->hasElement($nextElement)) {
                $value = $this->getTranslationValue($nextKeyName, $translations->element($nextElement));
            }
        }

        return $value;
    }

    private function getLocale(): string {
        $locale = $this->currentLocale;

        if (isset($this->translations[$locale])) {
            return $locale;
        } else {
            if (str_contains($locale, "_")) {
                $localeCallback = explode("_", $locale)[0];
                if (isset($this->translations[$localeCallback])) {
                    return $localeCallback;
                }
            }
        }

        if (!isset($this->translations[$this->defaultLocale])) {
            throw new Exception("No translations defined for '".$this->defaultLocale."'");
        }

        return $this->defaultLocale;
    }

}