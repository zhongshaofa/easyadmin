<?php


namespace EasyAdmin\console;


class CliEcho
{

    private $foreground_colors = [];

    private $background_colors = [];

    private static $foregroundColors = [
        'black'        => '0;30',
        'dark_gray'    => '1;30',
        'blue'         => '0;34',
        'light_blue'   => '1;34',
        'green'        => '0;32',
        'light_green'  => '1;32',
        'cyan'         => '0;36',
        'light_cyan'   => '1;36',
        'red'          => '0;31',
        'light_red'    => '1;31',
        'purple'       => '0;35',
        'light_purple' => '1;35',
        'brown'        => '0;33',
        'yellow'       => '1;33',
        'light_gray'   => '0;37',
        'white'        => '1;37',
    ];

    private static $backgroundColors = [
        'black'      => '40',
        'red'        => '41',
        'green'      => '42',
        'yellow'     => '43',
        'blue'       => '44',
        'magenta'    => '45',
        'cyan'       => '46',
        'light_gray' => '47',
    ];

    public function __construct()
    {
        // Set up shell colors
        $this->foreground_colors['black'] = '0;30';
        $this->foreground_colors['dark_gray'] = '1;30';
        $this->foreground_colors['blue'] = '0;34';
        $this->foreground_colors['light_blue'] = '1;34';
        $this->foreground_colors['green'] = '0;32';
        $this->foreground_colors['light_green'] = '1;32';
        $this->foreground_colors['cyan'] = '0;36';
        $this->foreground_colors['light_cyan'] = '1;36';
        $this->foreground_colors['red'] = '0;31';
        $this->foreground_colors['light_red'] = '1;31';
        $this->foreground_colors['purple'] = '0;35';
        $this->foreground_colors['light_purple'] = '1;35';
        $this->foreground_colors['brown'] = '0;33';
        $this->foreground_colors['yellow'] = '1;33';
        $this->foreground_colors['light_gray'] = '0;37';
        $this->foreground_colors['white'] = '1;37';
        $this->background_colors['black'] = '40';
        $this->background_colors['red'] = '41';
        $this->background_colors['green'] = '42';
        $this->background_colors['yellow'] = '43';
        $this->background_colors['blue'] = '44';
        $this->background_colors['magenta'] = '45';
        $this->background_colors['cyan'] = '46';
        $this->background_colors['light_gray'] = '47';
    }

    // Returns colored string
    public function getColoredString($string, $foreground_color = null, $background_color = null, $new_line = false)
    {
        $colored_string = '';
        // Check if given foreground color found
        if (isset($this->foreground_colors[$foreground_color])) {
            $colored_string .= "\033[".$this->foreground_colors[$foreground_color].'m';
        }
        // Check if given background color found
        if (isset($this->background_colors[$background_color])) {
            $colored_string .= "\033[".$this->background_colors[$background_color].'m';
        }
        // Add string and end coloring
        $colored_string .= $string."\033[0m";
        return $new_line ? $colored_string.PHP_EOL : $colored_string;
    }

    // Returns all foreground color names
    public function getForegroundColors()
    {
        return array_keys($this->foreground_colors);
    }

    // Returns all background color names
    public function getBackgroundColors()
    {
        return array_keys($this->background_colors);
    }

    /**
     * 获取带颜色的文字.
     *
     * @param string      $string          black|dark_gray|blue|light_blue|green|light_green|cyan|light_cyan|red|light_red|purple|brown|yellow|light_gray|white
     * @param string|null $foregroundColor 前景颜色 black|red|green|yellow|blue|magenta|cyan|light_gray
     * @param string|null $backgroundColor 背景颜色 同$foregroundColor
     *
     * @return string
     */
    public static function initColoredString(
        $string,
        $foregroundColor = null,
        $backgroundColor = null
    ) {
        $coloredString = '';
        if (isset(static::$foregroundColors[$foregroundColor])) {
            $coloredString .= "\033[".static::$foregroundColors[$foregroundColor].'m';
        }
        if (isset(static::$backgroundColors[$backgroundColor])) {
            $coloredString .= "\033[".static::$backgroundColors[$backgroundColor].'m';
        }
        $coloredString .= $string."\033[0m";
        return $coloredString;
    }

    /**
     * 输出提示信息.
     *
     * @param $msg
     */
    public static function notice($msg)
    {
        fwrite(STDOUT, self::initColoredString($msg, 'light_gray').PHP_EOL);
    }

    /**
     * 输出错误信息.
     *
     * @param $msg
     */
    public static function error($msg)
    {
        fwrite(STDERR, self::initColoredString($msg, 'white','red').PHP_EOL);
    }

    /**
     * 输出警告信息.
     *
     * @param $msg
     */
    public static function warn($msg)
    {
        fwrite(STDOUT, self::initColoredString($msg, 'red','yellow').PHP_EOL);
    }

    /**
     * 输出成功信息.
     *
     * @param $msg
     */
    public static function success($msg)
    {
        fwrite(STDOUT, self::initColoredString($msg, 'light_cyan').PHP_EOL);
    }

}