<?php

class TranslationManager
{
    public static string $defaultLanguage = 'en';
    private static TranslationManager $_instance;
    private static string $TRANSLATION_DIRECTORY_PATH = "../../data/translations/";
    private array $_translations = [];

    private function __construct()
    {
        $list = scandir(self::$TRANSLATION_DIRECTORY_PATH);

        foreach ($list as $file) {
            if (!str_ends_with($file, ".json")) continue;

            $json = json_decode(file_get_contents(self::$TRANSLATION_DIRECTORY_PATH . $file), true);
            $transElem = new SingleTranslation($file, $json);
            $this->_translations[$transElem->getLanguage()] = $transElem->getValues();
        }
    }

    /**
     * Get flags' images path
     * @return array
     */
    public static function getFlagList(): array
    {
        $flagsPath = "../../data/pictures/flags/";
        $list = scandir($flagsPath);

        $output = [];
        foreach ($list as $file) {
            $name = explode('.', $file)[0];
            if (!empty($name))
                $output[$name] = $flagsPath . $name . ".png";
        }
        return $output;
    }

    public static function getInstance(): TranslationManager
    {
        return TranslationManager::$_instance ?? TranslationManager::$_instance = new TranslationManager();
    }

    /**
     * Get an array of available languages
     * @return array The languages keys
     */
    public function getLanguages(): array
    {
        return array_keys($this->_translations);
    }

    /**
     * Get a translation, or a keys array of translations
     * @param string $path The translation path, separated by dots
     * @param bool $getKeys Boolean expriming if you want to fetch the keys (false by default)
     * @return int[]|mixed|string|string[]
     */
    public function get(string $path, bool $getKeys = false): mixed
    {
        $pathArray = explode('.', $path);

        $count = 0;
        $translat = $this->_translations[$_SESSION['language'] ?? 'en'];
        while ($count < count($pathArray)) {
            if (isset($translat[$pathArray[$count]])) {
                $translat = $translat[$pathArray[$count]];
                $count++;
            } else return "{missing_translation_error: $path}";
        }
        if ($getKeys)
            return array_keys($translat);
        else
            return $translat;
    }
}

class SingleTranslation
{
    private array $_values;
    private string $_language;

    public function __construct(string $file, array $json)
    {
        $this->_language = explode('.', $file)[0];
        $this->_values = $json;
    }

    public function getLanguage(): string
    {
        return $this->_language;
    }

    public function getValues(): array
    {
        return $this->_values;
    }

}