<html>
<head>
    <link href="example/css/styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div>
        <a href="http://localhost:7000/?l=de">DE</a>
        <a href="http://localhost:7000/?l=en">EN</a>
        <a href="http://localhost:7000/?l=it_IT">it_IT</a>
    </div>
    <?php

    include_once "vendor/autoload.php";

    use GELight\translation\{translation};

    $i18n = new translation(__DIR__."/example/translations", htmlspecialchars($_GET["l"]));

    echo "<div>".$i18n->t("HeaderData.clerk")."</div>";
    echo "<div>".$i18n->t("HeaderData.branch")."</div>";
    echo "<div>".$i18n->t("HeaderData.depot")."</div>";
    echo "<div>".$i18n->t("HeaderData.customer")."</div>";
    echo "<div>".$i18n->t("HeaderData.costBearer")."</div>";
    echo "<div>".$i18n->t("HeaderData.notice")."</div>";

    ?>
</body>
</html>
