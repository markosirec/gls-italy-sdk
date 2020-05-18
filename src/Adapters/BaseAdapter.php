<?php

namespace MarkoSirec\GlsItaly\SDK\Adapters;

use MarkoSirec\GlsItaly\SDK\Base as Base;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: Base adapter with shared functionalities
 */

/**
 * Class BaseAdapter
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
abstract class BaseAdapter extends Base
{
    abstract public function get();

    /**
     * Escapes xml specific characters and shortens string if needed
     * @param  string   $string
     * @param  int|null $maxLength
     * @return string   The formatted string
     */
    protected function formatStringForXml(string $string, int $maxLength = null): string
    {
        $string = str_replace(
            ['&', '"', "'", '<', '>'],
            ['&amp;', '&quot;', '&#39;', '&lt;', '&gt;'],
            $string
        );

        // replace special characters (this was instruced by GLS)
        $string = $this->convertAccentsAndSpecialToNormal($string);
        
        if (!empty($maxLength) && strlen($string) > $maxLength) {
            return substr($string, 0, $maxLength);
        }
        
        return $string;
    }

    /**
     * Replaces special characters in a string with their "non-special" counterpart.
     *
     * @param string
     * @return string
     */
    private function convertAccentsAndSpecialToNormal($string): string
    {
        $table = array(
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Ă'=>'A', 'Ā'=>'A', 'Ą'=>'A', 'Æ'=>'A', 'Ǽ'=>'A',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'ă'=>'a', 'ā'=>'a', 'ą'=>'a', 'æ'=>'a', 'ǽ'=>'a',

            'Þ'=>'B', 'þ'=>'b', 'ß'=>'Ss',

            'Ç'=>'C', 'Č'=>'C', 'Ć'=>'C', 'Ĉ'=>'C', 'Ċ'=>'C',
            'ç'=>'c', 'č'=>'c', 'ć'=>'c', 'ĉ'=>'c', 'ċ'=>'c',

            'Đ'=>'Dj', 'Ď'=>'D',
            'đ'=>'dj', 'ď'=>'d',

            'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ĕ'=>'E', 'Ē'=>'E', 'Ę'=>'E', 'Ė'=>'E',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ĕ'=>'e', 'ē'=>'e', 'ę'=>'e', 'ė'=>'e',

            'Ĝ'=>'G', 'Ğ'=>'G', 'Ġ'=>'G', 'Ģ'=>'G',
            'ĝ'=>'g', 'ğ'=>'g', 'ġ'=>'g', 'ģ'=>'g',

            'Ĥ'=>'H', 'Ħ'=>'H',
            'ĥ'=>'h', 'ħ'=>'h',

            'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'İ'=>'I', 'Ĩ'=>'I', 'Ī'=>'I', 'Ĭ'=>'I', 'Į'=>'I',
            'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'į'=>'i', 'ĩ'=>'i', 'ī'=>'i', 'ĭ'=>'i', 'ı'=>'i',

            'Ĵ'=>'J',
            'ĵ'=>'j',

            'Ķ'=>'K',
            'ķ'=>'k', 'ĸ'=>'k',

            'Ĺ'=>'L', 'Ļ'=>'L', 'Ľ'=>'L', 'Ŀ'=>'L', 'Ł'=>'L',
            'ĺ'=>'l', 'ļ'=>'l', 'ľ'=>'l', 'ŀ'=>'l', 'ł'=>'l',

            'Ñ'=>'N', 'Ń'=>'N', 'Ň'=>'N', 'Ņ'=>'N', 'Ŋ'=>'N',
            'ñ'=>'n', 'ń'=>'n', 'ň'=>'n', 'ņ'=>'n', 'ŋ'=>'n', 'ŉ'=>'n',

            'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ō'=>'O', 'Ŏ'=>'O', 'Ő'=>'O', 'Œ'=>'O',
            'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ō'=>'o', 'ŏ'=>'o', 'ő'=>'o', 'œ'=>'o', 'ð'=>'o',

            'Ŕ'=>'R', 'Ř'=>'R',
            'ŕ'=>'r', 'ř'=>'r', 'ŗ'=>'r',

            'Š'=>'S', 'Ŝ'=>'S', 'Ś'=>'S', 'Ş'=>'S',
            'š'=>'s', 'ŝ'=>'s', 'ś'=>'s', 'ş'=>'s',

            'Ŧ'=>'T', 'Ţ'=>'T', 'Ť'=>'T',
            'ŧ'=>'t', 'ţ'=>'t', 'ť'=>'t',

            'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ũ'=>'U', 'Ū'=>'U', 'Ŭ'=>'U', 'Ů'=>'U', 'Ű'=>'U', 'Ų'=>'U',
            'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ũ'=>'u', 'ū'=>'u', 'ŭ'=>'u', 'ů'=>'u', 'ű'=>'u', 'ų'=>'u',

            'Ŵ'=>'W', 'Ẁ'=>'W', 'Ẃ'=>'W', 'Ẅ'=>'W',
            'ŵ'=>'w', 'ẁ'=>'w', 'ẃ'=>'w', 'ẅ'=>'w',

            'Ý'=>'Y', 'Ÿ'=>'Y', 'Ŷ'=>'Y',
            'ý'=>'y', 'ÿ'=>'y', 'ŷ'=>'y',

            'Ž'=>'Z', 'Ź'=>'Z', 'Ż'=>'Z',
            'ž'=>'z', 'ź'=>'z', 'ż'=>'z'
        );

        return strtr($string, $table);
    }
}
