<?php
require_once '../../src/modeles/translations.php';
session_start();

if (!isset($_SESSION['translations']))
    $_SESSION['translations'] = TranslationManager::getInstance();

$currentDomain = explode('.', $_SERVER['SERVER_NAME']);
$currentLanguage = $currentDomain[0];

if (!isset($_SESSION['language']) || $currentLanguage != $_SESSION['language']) {
    in_array($currentLanguage, $_SESSION['translations']->getLanguages()) ?
        $_SESSION['language'] = $currentLanguage :
        $_SESSION['language'] = 'en';

    $currentDomain[0] = $currentLanguage;

    header('Location: ' . implode('.', $currentDomain) . $_SERVER["QUERY_STRING"]);
    exit();
}


$_SESSION['title'] = $_SESSION['translations']->get('global.title');

function getTitle(): string
{
    return htmlspecialchars($_SESSION['title']);
}