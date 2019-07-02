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
        $string = str_replace(['&', '"', "'", '<', '>'], ['&amp;', '&quot;', '&#39;', '&lt;', '&gt;'], $string);
        
        if (!empty($maxLength) && strlen($string) > $maxLength) {
            return substr($string, 0, $maxLength);
        }
        
        return $string;
    }
}
