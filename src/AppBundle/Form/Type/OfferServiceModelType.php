<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Description of OfferServiceModelType
 *
 * @author Raibel Botta <raibelbotta@gmail.com>
 */
class OfferServiceModelType extends AbstractType
{
    private $elements;
    
    public function __construct(array $elements)
    {
        $this->elements = array();
        foreach($elements as $element) {
            $this->elements[$element['name']] = $element;
        }
    }
    
    public function getParent()
    {
        return ChoiceType::class;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $elements = $this->elements;
        
        $resolver
                ->setDefaults(array(
                    'choices'           => $this->getChoices(),
                    'choices_as_values' => true,
                    'choice_attr'       => function($val, $key, $index) use($elements, $accessor) {
                        return array(
                            'data-has-nights' => $accessor->getValue($elements[$val], '[has_night]') ? 1 : 0
                        );
                    }
                ));
    }
    
    private function getChoices()
    {
        $choices = array();
        foreach ($this->elements as $element) {
            $choices[$element['display']] = $element['name'];
        }
        
        return $choices;
    }
}