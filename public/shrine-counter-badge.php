<?php
define("LEFT_TEXT", "⛩️");
define("RIGHT_TEXT_EN", "Shrines");
define("RIGHT_TEXT_DE", "Schreine");
define("RIGHT_TEXT_JA", "神社");

$configuration = include "../configuration.php";

$countedShrines = countShrines(
    $configuration['database_host'],
    $configuration['database_port'],
    $configuration['database_db'],
    "articles",
    $configuration['database_charset'],
    $configuration['database_user'],
    $configuration['database_password']
);

renderBadge(
    "https://gist.githubusercontent.com/vivi90/a9749fe1f8381b6083cea68b2e97f975/raw/c4959d4ca44e5e2791cb92fcbeed6cde125fdcdc/php-badge-template",
    LEFT_TEXT,
    "#e34234",
    "#555",
    $countedShrines." ".constant("RIGHT_TEXT_".strtoupper(getLocale())),
    "#fff",
    "#e34234"
);

/**
 * Returns the number of shrines.
 * @param $host Database host.
 * @param $port Database port.
 * @param $database Database.
 * @param $table Database table.
 * @param $charset Charset.
 * @param $username Username.
 * @param $password Password.
 * @return int Counted shrines.
 * @version 1.0.0
 */
function countShrines(string $host, int $port, string $database, string $table, string $charset, string $username, string $password) {
    $databaseConnection = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$database.";charset=".$charset, $username, $password);
    return $databaseConnection->query("SELECT COUNT(*) FROM ".$table)->fetchColumn();
}

/**
 * Returns the selected locale.
 * @return string Locale.
 * @version 1.0.0
 */
function getLocale() {
    if (empty($_GET["locale"])) {
        return "en";
    } else {
        return $_GET["locale"];
    }
}

/**
 * Renders the badge.
 * @param $templateFile Template file path or URL.
 * @param $leftText Left text.
 * @param $leftTextColor Left text color.
 * @param $leftBackgroundColor Left background color.
 * @param $rightText Right text.
 * @param $rightTextColor Right text color.
 * @param $rightBackgroundColor Right background color.
 * @version 1.0.0
 */
function renderBadge(string $templateFile, string $leftText, string $leftTextColor, string $leftBackgroundColor, string $rightText, string $rightTextColor, string $rightBackgroundColor) {
    $fileHandle = tmpfile();
    fwrite($fileHandle, file_get_contents($templateFile));
    header('Content-Type: image/svg+xml');
    header('Content-Disposition: inline; filename="'.basename($_SERVER['PHP_SELF'], ".php").'.svg"');
    include stream_get_meta_data($fileHandle)['uri'];
    fclose($fileHandle);
}
?>
