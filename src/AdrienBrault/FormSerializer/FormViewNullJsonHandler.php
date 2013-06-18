<?php

namespace AdrienBrault\FormSerializer;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Context;
use Symfony\Component\Form\FormView;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class FormViewNullJsonHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'Symfony\Component\Form\FormView',
                'method' => 'serialize',
            ),
        );
    }

    public function serialize($visitor, FormView $formView, array $type, Context $context)
    {
        return null;
    }
}
