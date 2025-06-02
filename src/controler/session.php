<?php
require_once '../../src/modeles/translations.php';
session_start();

if (!isset($_SESSION['translations']))
    $_SESSION['translations'] = TranslationManager::getInstance();

//Prepare data to handle language in case of undefined language in domain name
$currentFullDomain = explode('.', $_SERVER['SERVER_NAME']);
if (count($currentFullDomain) > 1) {
    $currentDomain = array_slice($currentFullDomain, 1);
    $currentLanguage = $currentFullDomain[0];
} else {
    $currentDomain = $currentFullDomain;
    $currentLanguage = TranslationManager::$defaultLanguage;
    array_unshift($currentDomain, $currentLanguage);
}

//Handle the Session variable set and redirection to correct domain
if (
    !isset($_SESSION['language']) ||
    $currentLanguage != $_SESSION['language'] ||
    count($currentFullDomain) < 2
) {
    if (!in_array($currentLanguage, $_SESSION['translations']->getLanguages()))
        $currentLanguage = TranslationManager::$defaultLanguage;

    $currentDomain[0] = $currentLanguage;
    $_SESSION['language'] = $currentLanguage;
    $redirectionPath = 'http://' . implode('.', $currentDomain) . $_SERVER['PHP_SELF'];
    if (!empty($_SERVER["QUERY_STRING"]))
        $redirectionPath .= '?' . $_SERVER["QUERY_STRING"];
    header('Location: ' . $redirectionPath);
    exit();
}

$_SESSION['title'] = $_SESSION['translations']->get('global.title');

/**
 * @return string Title of the current page
 */
function getTitle(): string
{
    return htmlspecialchars($_SESSION['title']);
}