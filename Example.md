## Using Example

* Create a folder **translations/**.
* Create a new file **[translations.sml](https://dev.stenway.com/SML/Specification.html)** file inside the **translations/** directory with all your translations:

*Example: **translations/translations.sml***
```shell
Translations
    de
        books
            book
                name "William Smith"
                title "Mein Buchcover"
                info "Geheimnisse in meinem ersten Startup"
                ISBN "ISBN {isbn}"
                color "red"
            End
        End
    End
    en_GB
        books
            book
                name "William Smith"
                title "My Book Cover"
                info "Secrets in my first Startup"
                ISBN "ISBN {isbn}"
                color "blue"
            End
        End
    End
    ja_JP
        books
            book
                name "William Smith"
                title "私の本の表紙"
                info "私の最初のスタートアップの秘密"
                ISBN "ISBN {isbn}"
                color "orange"
            End
        End
    End
End
```

* Add this code in your index.php:

```php
<html>
<head>
    <title>Internationalization with SML</title>
    <link href="css/styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div>
        <a href="http://localhost:7000/?l=de">DE</a>
        <a href="http://localhost:7000/?l=en_GB">EN</a>
        <a href="http://localhost:7000/?l=ja_JP">JP</a>
    </div>
    
    <?php
    
    include_once "vendor/autoload.php";

    use GELight\translation\{translation};

    $i18n = new translation(__DIR__."/translations", htmlspecialchars($_GET["l"]));

    echo "<div class='book book-{$i18n->t("books.book.color")}'>";
        echo "<div class='info'>{$i18n->t("books.book.info")}</div>";
        echo "<div class='title'>{$i18n->t("books.book.title")}</div>";
        echo "<div class='name'>{$i18n->t("books.book.name")}</div>";
        echo "<div class='isbn'>{$i18n->t("books.book.ISBN", [ "isbn" => "978-3-86680-192-9" ])}</div>";
    echo "</div>";

    ?>
    
</body>
</html>
```

* Add this CSS into new file in **css/styles.css**:

```css
@import url('https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@700&display=swap');

* {
    position: relative;
    box-sizing: border-box;
}

body {
    background: #333;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

nav {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 2rem;
}

.book {
    background: #fff;
    color: #000;
    border: 1px solid #333;
    padding: 1rem;
    width: 20rem;
    height: 30rem;
    box-shadow: 1rem 1rem 1.4rem 0 #000;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-family: Anton;
    border-radius: .5rem;
}

.book .info {
    font-size: 15px;
    color: #fff;
    text-align: center;
}
.book .title {
    text-align: center;
    font-size: 60px;
    font-weight: 700;
    margin-bottom: 6rem;
    text-shadow: 0.1rem 0.1rem 0.2rem #fff;
}
.book .isbn {
    font-size: 10px;
    font-weight: 400;
}
.book .name {
    font-size: 30px;
    color: #fff;
}

.book-red { background: #ce3737; }
.book-blue { background: #6363ff; }
.book-orange { background: #f7823e; }

a {
    color: #fff;
    border: 1px dashed #333;
    padding: .4rem 1rem;
    margin: .4rem;
}

a:hover {
    background: #111;
}
```

* Start terminal and open your project folder
* Start your PHP server 
```shell
php -S localhost:7000
```
* Open your project URL

```shell
http://localhost:7000/?l=ja_JP
```
