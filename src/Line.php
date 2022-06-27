<?php

namespace Laracasts\Transcriptions;

// Line object:
// 00:00:03.210 --> 00:00:04.110
// Here is a,

class Line
{

    public function __construct(public string $timestamp, public string $body)
    {
    }

    public function toAnchorTag()
    {

        return "<a href=\"?time={$this->beginningTimestamp()}\">{$this->body}</a>";

        //var_dump($matches);
        //return '<a href="?time=' . $matches[1] . '">' . $this->body . '</a>';
    }

    public function beginningTimestamp()
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);
        return $matches[1];
    }

    public static function valid($line)
    {
        return $line !== 'WEBVTT' && $line !== '' && !is_numeric($line);
    }
}
