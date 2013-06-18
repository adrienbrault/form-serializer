<?php

namespace AdrienBrault\FormSerializer;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\XmlSerializationVisitor;
use JMS\Serializer\Context;
use Symfony\Component\Form\FormView;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class FormViewXmlHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'xml',
                'type' => 'Symfony\Component\Form\FormView',
                'method' => 'serializeToXML',
            ),
        );
    }

    /**
     * @var XmlFormViewSerializerInterface
     */
    private $xmlFormViewSerializer;

    public function __construct(XmlFormViewSerializerInterface $xmlFormViewSerializer = null)
    {
        $this->xmlFormViewSerializer = $xmlFormViewSerializer ?: new XmlFormViewSerializer();
    }

    public function serializeToXML(XmlSerializationVisitor $visitor, FormView $formView, array $type, Context $context)
    {
        if (null === $visitor->document) {
            $visitor->document = $visitor->createDocument(null, null, false);
            $visitor->setCurrentNode($visitor->document->createElement('form'));
            $visitor->document->appendChild($visitor->getCurrentNode());
        }

        $this->xmlFormViewSerializer->serialize($formView, $visitor->getCurrentNode());
    }
}
