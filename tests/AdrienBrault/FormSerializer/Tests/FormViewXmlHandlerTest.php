<?php

namespace AdrienBrault\FormSerializer\Tests;

use AdrienBrault\FormSerializer\FormViewXmlHandler;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\Form\Forms;

class FormViewXmlHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $serializer = SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistryInterface $handlers) {
                $handlers->registerSubscribingHandler(new FormViewXmlHandler());
            })
            ->build()
        ;

        $formFactory = Forms::createFormFactoryBuilder()->getFormFactory();
        $form = $formFactory->createBuilder('form')
            ->add('name', 'text')
            ->getForm()
        ;

        $xml = $serializer->serialize($form->createView(), 'xml');
        $this->assertEquals(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<form method="POST" action="">
  <input type="text" name="form[name]" required="required"/>
</form>

XML
            , $xml);
    }
}
