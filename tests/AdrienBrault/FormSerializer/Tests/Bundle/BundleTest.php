<?php

namespace AdrienBrault\FormSerializer\Tests\Bundle;

class BundleTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $kernel = new AppKernel('test', true);
        $kernel->boot();
        $formFactory = $kernel->getContainer()->get('form.factory');
        $serializer = $kernel->getContainer()->get('serializer');

        $formView = $formFactory
            ->createBuilder('form', null, array('action' => '/target', 'method' => 'PUT'))
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->getForm()
            ->createView()
        ;

        $xml = $serializer->serialize($formView, 'xml');
        $json = $serializer->serialize($formView, 'json');

        $this->assertEquals(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<form method="PUT" action="/target">
  <input type="text" name="form[name]" required="required"/>
  <textarea name="form[description]" required="required"><![CDATA[]]></textarea>
</form>

XML
        , $xml);
        $this->assertEquals('null', $json);
    }
}
