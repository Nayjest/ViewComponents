<?php
namespace Presentation\Framework\Test\Components;

use Presentation\Framework\Components\Container;
use Presentation\Framework\Components\Text;
use Presentation\Framework\Components\Repeater;
use PHPUnit_Framework_TestCase;

class RepeaterTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $repeater = new Repeater(
            [
                ['value' => 1],
                ['value' => 2],
                ['value' => 3],
            ],
            [new Text]
        );
        self::assertEquals('123', $repeater->render());
    }

    public function testWithMultipleComponents()
    {
        $repeater = new Repeater(
            [
                ['value' => 1],
                ['value' => 2],
            ],
            [new Text, new Text]
        );
        self::assertEquals('1122', $repeater->render());
    }
    public function testWithContainer()
    {
        $repeater = new Repeater(
            [
                ['value' => 1],
                ['value' => 2],
            ],
            [
                new Container([
                    new Text('[')
                ]),
                new Text,
                new Container([
                    new Text(']')
                ])
            ]
        );
        self::assertEquals('[1][2]', $repeater->render());
    }
}
