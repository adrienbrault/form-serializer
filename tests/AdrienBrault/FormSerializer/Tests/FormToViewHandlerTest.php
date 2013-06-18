<?php

namespace AdrienBrault\FormSerializer\Tests;

use AdrienBrault\FormSerializer\FormToViewHandler;

class FormToViewHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $form = $this->getMock('Symfony\\Component\\Form\\Form', array(), array(), '', false);
        $form
            ->expects($this->once())
            ->method('createView')
            ->will($this->returnValue($formView = new \StdClass()))
        ;
        $visitor = $this->getMock('JMS\\Serializer\\VisitorInterface');
        $context = $this->getMock('JMS\Serializer\SerializationContext');
        $context
            ->expects($this->once())
            ->method('accept')
            ->with($formView)
            ->will($this->returnValue($acceptReturnValue = new \StdClass()))
        ;

        $handler = new FormToViewHandler();
        $this->assertEquals($acceptReturnValue, $handler->serialize($visitor, $form, array(), $context));
    }
}
