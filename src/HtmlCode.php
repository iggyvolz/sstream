<?php

namespace iggyvolz\sstream;

class HtmlCode implements NoEscapeHtml
{
    public function __construct(public readonly string $contents)
    {
    }

    public function __toString(): string
    {
        return $this->contents;
    }
}