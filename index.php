<html>
<head>
    <title>Internationalization with SML</title>
    <link href="example/css/styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <nav>
        <a href="http://localhost:7000/?l=de">DE</a>
        <a href="http://localhost:7000/?l=en_GB">EN</a>
        <a href="http://localhost:7000/?l=ja_JP">JP</a>
    </nav>
    <?php

    include_once "vendor/autoload.php";

    use GELight\translation\{translation};

    $i18n = new translation(__DIR__."/example/translations", htmlspecialchars($_GET["l"]));

    echo "<div class='book book-{$i18n->t("books.book.color")}'>";
        echo "<div class='info'>{$i18n->t("books.book.info")}</div>";
        echo "<div class='title'>{$i18n->t("books.book.title")}</div>";
        echo "<div class='name'>{$i18n->t("books.book.name")}</div>";
        echo "<div class='isbn'>{$i18n->t("books.book.ISBN", [ "isbn" => "978-3-86680-192-9" ])}</div>";
    echo "</div>";

    ?>
</body>
</html>
