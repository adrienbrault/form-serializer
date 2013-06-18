<?php

namespace AdrienBrault\FormSerializer\Tests;

use AdrienBrault\FormSerializer\FormViewNullJsonHandler;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormView;

class FormViewNullJsonHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $handler = new FormViewNullJsonHandler();
        $this->assertEquals(null, $handler->serialize(null, new FormView(), array(), SerializationContext::create()));
    }
}
