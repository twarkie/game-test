<?php

namespace GameTest\Printer;

class HtmlPrinter
{
    private $games;
    private $translator;
    private $template =  <<<HTML
<html>
    <head>
        <title>Top 10 Games in Rövarspråk</title>
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-900 text-gray-100">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-16 py-8">
                {{content}}
            </div>
        </div>
    </body>
</html>
HTML;

    private $gameTemplate =  <<<HTML
<div class="w-1/2 p-8">
    <div class="border border-gray-600">
        <div class="overflow-hidden w-full h-32">
            <img class="w-full" src="{{backgroundImage}}" />
        </div>

        <div class="p-4">
            <h1 class="text-3xl">{{name}}</h1>

            <p>Available in Playstation Store: {{psStoreAvailability}}</p>

            <p>Rating: {{rating}}/{{ratingTop}} ({{ratingsCount}} votes)</p>
        </div>
    </div>
</div>
HTML;

    public function __construct($games)
    {
        $this->games = $games;
    }

    public function withTranslator($translator)
    {
        $this->translator = $translator;

        return $this;
    }

    public function asString() : string
    {
        $content = '';

        foreach($this->games as $game) {
            $content .= str_replace(
                ['{{name}}', '{{backgroundImage}}', '{{rating}}', '{{ratingTop}}', '{{ratingsCount}}', '{{psStoreAvailability}}'],
                [$this->translate($game->name),  $game->backgroundImage, $game->rating, $game->ratingTop, $game->ratingsCount, $game->psStoreAvailability ? 'yes' : 'no'],
                $this->gameTemplate
            );
        }

        return str_replace(
            ['{{content}}'],
            [$content],
            $this->template
        );
    }

    private function translate($string)
    {
        if (!$this->translator) {
            return $string;
        }

        return $this->translator->translate($string);
    }
}
