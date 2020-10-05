<?php

namespace GameTest\Translator;

class RovarLanguageTranslator
{
    private $vowels = ['a', 'e', 'i', 'o', 'u', 'y', 'å', 'ä', 'ö'];
    private $whitelistRegex = '/[^a-zåäö]/';

    public function translate($string)
    {
        $translated = '';
        for ($i = 0, $count = mb_strlen($string); $i < $count; $i++) {
            $translated .= $this->replaceLetter($string[$i]);
        }

        return $translated;
    }

    private function replaceLetter($letter)
    {
        $lowerCaseLetter = mb_convert_case($letter, MB_CASE_LOWER);

        if (in_array($lowerCaseLetter, $this->vowels) || preg_match($this->whitelistRegex, $lowerCaseLetter)) {
            return $letter;
        }

        return $letter . 'o' . $lowerCaseLetter;
    }
}
