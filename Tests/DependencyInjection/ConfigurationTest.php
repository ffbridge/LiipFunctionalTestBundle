<?php

/*
 * This file is part of the Liip/FunctionalTestBundle
 *
 * (c) Lukas Kahwe Smith <smith@pooteeweet.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\FunctionalTestBundle\Tests\DependencyInjection;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Test default configuration.
 */
class ConfigurationTest extends WebTestCase
{
    private $container = null;

    public function setUp()
    {
        $client = static::makeClient();
        $this->container = $client->getContainer();
    }

    /**
     * @dataProvider parametersProvider
     */
    public function testParameter($node, $value)
    {
        $name = 'liip_functional_test.'.$node;

        $this->assertNotNull($this->container);

        $this->assertTrue(
            $this->container->hasParameter($name),
            $name.' parameter is not defined.'
        );

        $this->assertSame(
            $value,
            $this->container->getParameter($name)
        );
    }

    public function parametersProvider()
    {
        return array(
            array('cache_sqlite_db', false),
            array('command_verbosity', 'normal'),
            array('command_decoration', true),
            array('query', array(
                'max_query_count' => null,
            )),
            array('authentication', array(
                'username' => '',
                'password' => '',
            )),
            array('html5validation', array(
                'url' => 'https://validator.nu/',
                'ignores' => array(),
                'ignores_extract' => array(),
            )),
        );
    }
}
