<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use Laracasts\Transcriptions\Transcription;

use Laracasts\Transcriptions\Line;

class TranscriptionTest extends TestCase
{

    /** @test */
    function it_loads_a_vtt_file_as_a_string()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);
        $this->assertStringContainsString('Here is a,', $transcription);
        $this->assertStringContainsString('Example of a VVT file.', $transcription);
        // $this->assertStringEqualsFile(
        //     $file,
        //     Transcription::load($file)
        // );
    }


    /** @test */
    function it_can_convert_to_an_array_of_line_objects()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';


        $lines = Transcription::load($file)->lines();
        $this->assertCount(2, $lines);

        //var_dump($lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /** @test */
    function it_discards_lines_from_the_vtt_file()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        //var_dump($transcription->lines());

        $this->assertStringNotContainsString("WEBVTT", $transcription);

        $this->assertCount(2, Transcription::load($file)->lines());
    }

    /** @test */
    function it_renders_the_lines_as_html()
    {

        $transcription = Transcription::load(__DIR__ . '/stubs/basic-example.vtt');

        $expected = <<<EOT
<a href="?time=00:03">Here is a,</a>
<a href="?time=00:04">Example of a VVT file.</a>
EOT;

        $this->assertEquals($expected, $transcription->htmlLines());
    }
}
