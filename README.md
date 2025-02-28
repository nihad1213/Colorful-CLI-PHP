# ANSI Color Formatting in PHP CLI

## Overview
This project demonstrates how to add color and styles to text output in the command line using ANSI escape codes in PHP.

## How It Works
The function `color()` applies different styles, text colors, and background colors to a given string for terminal output.

### Function Definition
```php
public static function color(string $text, ?string $color = null, ?string $bgColor = null, array $styles = []): string
{
    $colorCode = $color ? (self::$colors[$color] ?? '') : '';
    $bgColorCode = $bgColor ? (self::$bgColors[$bgColor] ?? '') : '';
    $styleCodes = array_map(fn($style) => self::$styles[$style] ?? '', $styles);

    // Combine all codes into a single ANSI escape sequence
    $codes = array_filter([$colorCode, $bgColorCode, ...$styleCodes]);

    return "\e[" . implode(';', $codes) . "m" . $text . "\e[0m";
}
```

### Explanation of ANSI Escape Codes
- **`\e[`** – The escape character (`\e` or `\033`) signals the start of an ANSI escape sequence.
- **Text and background color codes** are numeric values defining the color of the text and background.
- **Style codes** include effects like bold, underlined text, etc.
- **`m`** – Indicates that the codes should be applied as text formatting.
- **`\e[0m`** – Resets formatting to default.

### Available ANSI Codes

#### Text Color (Foreground)
| Code | Color |
|------|--------|
| 30   | Black  |
| 31   | Red    |
| 32   | Green  |
| 33   | Yellow |
| 34   | Blue   |
| 35   | Magenta |
| 36   | Cyan   |
| 37   | White  |

#### Background Color
| Code | Color |
|------|--------|
| 40   | Black  |
| 41   | Red    |
| 42   | Green  |
| 43   | Yellow |
| 44   | Blue   |
| 45   | Magenta |
| 46   | Cyan   |
| 47   | White  |

#### Text Styles
| Code | Effect |
|------|-----------------|
| 0    | Reset |
| 1    | Bold |
| 4    | Underline |
| 7    | Inverted Colors |

### Example Usage
#### Simple Colored Text
```php
echo "\e[31mThis is red text\e[0m\n";
```
#### Bold and Underlined Text
```php
echo "\e[1;4mBold and Underlined\e[0m\n";
```
#### Custom Function Call
```php
echo MyClass::color("Hello, World!", "red", "yellow", ["bold"]);
```

## Where to Use
- CLI-based PHP applications
- Logging systems with color-coded messages
- Terminal-based tools to enhance user readability

## Resources
- [ANSI Escape Codes on Wikipedia](https://en.wikipedia.org/wiki/ANSI_escape_code)
- [PHP CLI ANSI Colors](https://tldp.org/HOWTO/Bash-Prompt-HOWTO/x329.html)

