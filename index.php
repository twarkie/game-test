<?php

namespace GameTest;

require_once('Config/Autoload.php');

use GameTest\Scraper\RawgScraper;
use GameTest\Printer\HtmlPrinter;
use GameTest\Translator\RovarLanguageTranslator;

$games = (new RawgScraper)->setLimit(10)->get();

echo (new HtmlPrinter($games))->withTranslator(new RovarLanguageTranslator)->asString();
