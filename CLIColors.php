<?php

class CLIColors
{
    private static array $colors = [
        'black'   => '30',
        'red'     => '31',
        'green'   => '32',
        'yellow'  => '33',
        'blue'    => '34',
        'magenta' => '35',
        'cyan'    => '36',
        'white'   => '37'
    ];

    private static array $bgColors = [
        'black'   => '40',
        'red'     => '41',
        'green'   => '42',
        'yellow'  => '43',
        'blue'    => '44',
        'magenta' => '45',
        'cyan'    => '46',
        'white'   => '47'
    ];

    private static array $styles = [
        'bold'       => '1',
        'dim'        => '2',
        'underline'  => '4',
        'blink'      => '5',
        'reverse'    => '7',
        'hidden'     => '8'
    ];

    public static function color(string $text, ?string $color = null, ?string $bgColor = null, array $styles = []): string
    {
        $colorCode = $color ? (self::$colors[$color] ?? '') : '';
        $bgColorCode = $bgColor ? (self::$bgColors[$bgColor] ?? '') : '';
        $styleCodes = array_map(fn($style) => self::$styles[$style] ?? '', $styles);

        $codes = array_filter([$colorCode, $bgColorCode, ...$styleCodes]);
        /*print_r($codes);*/
        return "\e[" . implode(';', $codes) . "m" . $text . "\e[0m";
    }
}

echo CLIColors::color("Bu qırmızı rəngdir", "red") . PHP_EOL;
echo CLIColors::color("Bu yaşıl və qalın mətn", "green", null, ["bold"]) . PHP_EOL;
echo CLIColors::color("Bu mavi fon və sarı mətn", "yellow", "blue") . PHP_EOL;
echo CLIColors::color("Bu vurğulanmış (underline) magenta mətn", "magenta", null, ["underline"]) . PHP_EOL;
echo CLIColors::color("Bu gizli (hidden) mətn", "white", null, ["hidden"]) . PHP_EOL;
