<?php

namespace ThomasInckx\PodioLogger\Tests;

use PodioLogger;

class PodioLoggerTest extends TestCase
{
    /** @test */
    public function it_sets_the_level() 
    {
        $logger = new PodioLogger;

        info('test');
    }
    
    public function it_sets_the_message() {}
}