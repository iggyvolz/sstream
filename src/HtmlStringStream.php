<?php

namespace iggyvolz\sstream;

use Stringable;

class HtmlStringStream extends StringStream
{
    public function append(string|Stringable $string): static
    {
        if(!$string instanceof NoEscapeHtml) $string = htmlspecialchars($string);
        $thisStr = $this->__toString();
        $stringStr = ($string instanceof Stringable) ? $string->__toString() : $string;
        $res = $thisStr . $stringStr;
        return new static($res);
    }
}