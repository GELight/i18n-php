# sml-i18n-for-php

Internationalization for PHP based on SML ([Simple Markup Language](https://dev.stenway.com/SML/PHP.html))

## What is SML?

> [Video - Using SML in PHP](https://dev.stenway.com/SML/PHP.html)

> [Guide - SML Specification](https://dev.stenway.com/SML/Specification.html)

> [Wikipedia (DE)](https://de.wikipedia.org/wiki/Simple_Markup_Language)

> [Video - SML in 60sec](https://www.youtube.com/watch?v=qOooyygwX0w)

> [Video - SML Explained](https://www.youtube.com/watch?v=fBzMdzMtH-s&t=221s)

## Using

> [Example - How can I use this lib?](Example.md)

## Example

```shell
    Translations
        de
            sml
                welcome "Willkommen in der Welt von SML mit sml-i18n-for-php"
                description "Die Simple Markup Language ist eine einfach und schnell zu schreibende Auszeichnungssprache. Es verwendet nur einen minimalen Satz von Sonderzeichen und fühlt sich daher sehr natürlich an. Es ist zeilenbasiert, und wenn Sie eine Touch-Schreibkraft sind, werden Sie es lieben."
            End
        End
        en_GB
            sml
                welcome "Welcome to SML using sml-i18n-for-php"
                description "The Simple Markup Language is an easy and fast to type markup language. It only uses a minimal set of special characters and therefor feels very natural. It is line-based, and if you are a touch typist you will love it."
            End
        End
        ja_JP
            sml
                welcome "sml-i18n-for-phpを使用したSMLへようこそ"
                description "Simple Markup Languageは、簡単かつ迅速に入力できるマークアップ言語です。最小限の特殊文字セットのみを使用しているため、非常に自然な感じがします。それはラインベースであり、あなたがタッチタイピストならあなたはそれを気に入るはずです。"
            End
        End
    End
```

```php
<?php

include_once "vendor/autoload.php";

use GELight\translation\{translation};

$i18n = new translation();
$i18n->loadTranslations(__DIR__."/translations");
$i18n->setCurrentLocale("en");

# You can use also the short notation of the most important properties in the same example
$i18n = new translation(__DIR__."/translations", "en");

# The method t() returns the corresponding translation
echo $i18n->t("sml.title");
echo $i18n->t("sml.description");
```

Result:

```shell
Welcome to SML using sml-i18n-for-php

The Simple Markup Language is an easy and fast to type markup language. It only uses a minimal set of special characters and therefor feels very natural. It is line-based, and if you are a touch typist you will love it.
```

## Documentation

### loadTranslations()
Loads all SML files with the correspondingly defined translations.
The translations can then be fetched using the **$i18n->t()** method.

> loadTranslations(string $path): translation

```php
$i18n = new translation();
$i18n->loadTranslations("path/to/your/translations/folder");

# Short notation by using the first constructor parameter
$i18n = new translation("path/to/your/translations/folder");
```

### getDefaultLocale()
Returns the default locale.

> getDefaultLocale(): string

```php
echo $i18n->getDefaultLocale(); // result for example > "en"
```

### setDefaultLocale()
Set the default locale.
The default locale is used as the last possible callback when translations of a language are not available.

> setDefaultLocale(string $locale): translation

```php
$i18n->setDefaultLocale("en");  // Standard default locale is "de"
```

### isValidLocale()
Checks that the specified locale is valid.

> isValidLocale(string $locale): bool

```php
echo $i18n->isValidLocale("en_US"); // true
echo $i18n->isValidLocale("ab_CD"); // false
```

### getCurrentLocale()
Returns the defined current locale.

> getCurrentLocale(): string

```php
echo $i18n->getCurrentLocale(); // result for example > "en"
```

### setCurrentLocale()
Set the current locale.

> setCurrentLocale(string $locale): translation

```php
$i18n->setCurrentLocale("en_US");
```

### setForcedCallbackLocale()
Defines a forced callback locale when translations of a language are not available.

> Standard behavior for locale callbacks when:
> * default language is - **de**
> * current locale is - **en_US**
> 1. en_US
> 2. en
> 3. de

> setForcedCallbackLocale(string $locale): translation

```php
$i18n->setForcedCallbackLocale("de");
```

### getForcedCallbackLocale()
Returns the defined forced callback locale.
If not defined a forced callback locale the method will return "false".

> getForcedCallbackLocale(): string|bool

```php
echo $i18n->getForcedCallbackLocale();  // result for example > "en"
```

### t()
Returns the related translation value according to the specified key.

> t(string $key, array $replaceWith = []): string

```php
echo $i18n->t("sml.welcome");
echo $i18n->t("sml.description");
```

Using translation placeholders:


```shell
    Translations
        de
            today
              is Heute ist {weekday}
            End
        End
        en
            today
              is Today is {weekday}
            End
        End
    End
```

```php
$i18n->setCurrentLocale("en");
echo $i18n->t("today.is", [ "weekday" => date("l") ]);
// Result example > "Today is monday"
```
