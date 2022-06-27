<?php

namespace Laracasts\Transcriptions;

use Laracasts\Transcriptions\Line;

class Transcription
{

    /*
     * As of PHP 7.4.0, property definitions can include a Type declarations, with the exception of callable.
     */

    //protected array $lines;

    public function __construct(protected array $lines)
    {
        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
    }


    public static function load(string $path): self
    {
        return new static(file($path));

        // $instance = new static();

        // //$instance->lines = file($path);
        // $instance->lines = $instance->discardInvalidLines(array_map('trim', file($path)));

        // return $instance;
    }

    public function lines(): array
    {
        //var_dump(explode("\n", $this->lines));
        //var_dump($this->lines);
        //return $this->lines;


        //pair of lines: timestamp + text

        $lines = [];

        for ($i = 0; $i < count($this->lines); $i += 2) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }
        return $lines;
    }

    public function htmlLines()
    {

        //var_dump($this->lines);

        // preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);


        $htmlLines =  array_map(function (Line $line) {
            return $line->toAnchorTag();
        }, $this->lines());

        return implode("\n", $htmlLines);
    }

    protected function discardInvalidLines(array $lines): array
    {
        return array_values(array_filter(
            $lines,
            fn ($line) => Line::valid($line)
        ));


        // $lines = array_map('trim', $lines);

        // return array_filter($lines, function ($line) {
        //     return $line !== 'WEBVTT' && $line !== '' && !is_numeric($line);
        // });
    }

    public function __toString(): string
    {
        return implode("", $this->lines);
        //return $this->lines;
    }
}
