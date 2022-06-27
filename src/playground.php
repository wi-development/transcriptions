<?php

// namespace Laracasts\Transcriptions;

use Laracasts\Transcriptions\Transcription;

require 'vendor/autoload.php';

$path = __DIR__ . '/../tests/stubs/basic-example.vtt';

$lines = Transcription::load($path)->lines();

foreach ($lines as $key => $line) {
    var_dump($line->beginningTimestamp() . ' - ' . $line->body);
}
