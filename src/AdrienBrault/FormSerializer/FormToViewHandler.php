<?php

namespace AdrienBrault\FormSerializer;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\VisitorInterface;
use Symfony\Component\Form\Form;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class FormToViewHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        $methods = array();
        foreach (array('json', 'xml', 'yml') as $format) {
            $methods[] = array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => $format,
                'type' => 'Symfony\Component\Form\Form',
                'method' => 'serialize',
            );
        }

        return $methods;
    }

    public function serialize(VisitorInterface $visitor, Form $form, array $type, SerializationContext $context)
    {
        return $context->accept($form->createView());
    }
}
