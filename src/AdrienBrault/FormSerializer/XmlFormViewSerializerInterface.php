<?php

namespace AdrienBrault\FormSerializer;

use Symfony\Component\Form\FormView;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
interface XmlFormViewSerializerInterface
{
    /**
     * @param FormView    $formView
     * @param \DOMElement $formElement
     */
    public function serialize(FormView $formView, \DOMElement $formElement);
}
