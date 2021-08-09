# sml-i18n-for-php

Internationalization for PHP based on SML ([Simple Markup Language](https://dev.stenway.com/SML/PHP.html))

## Using

[SML](https://dev.stenway.com/SML/Specification.html) file with all english translations:

```shell
Translations
    en_GB
        books
            title Books
            ISBN ISBN - {isbn}
        End
    End
    js_JP
        books
            title 本
            ISBN ISBN - {isbn}
        End
    End
End
```

Using example in your php file:

```php
include_once "vendor/autoload.php";

use GELight\translation\{translation};

$i18n = new translation(__DIR__."/example/translations", "en");

echo $i18n->t("books.title");
echo $i18n->t("books.ISBN", [ "ISBN" => "978-3-86680-192-9" ]);
```


Result:

```html
Books
ISBN - 978-3-86680-192-9
```

## What is SML?

> [Video - Using SML in PHP](https://dev.stenway.com/SML/PHP.html)

> [Guide - SML Specification](https://dev.stenway.com/SML/Specification.html)

> [Wikipedia (DE)](https://de.wikipedia.org/wiki/Simple_Markup_Language)

> [Video - SML in 60sec](https://www.youtube.com/watch?v=qOooyygwX0w)

> [Video - SML Explained](https://www.youtube.com/watch?v=fBzMdzMtH-s&t=221s)

