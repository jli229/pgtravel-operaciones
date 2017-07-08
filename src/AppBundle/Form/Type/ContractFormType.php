<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use AppBundle\Entity\Contract;

/**
 * Description of ContractFormType
 *
 * @author Raibel Botta <raibelbotta@gmail.com>
 */
class ContractFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('model', ContractModelType::class)
                ->add('supplier', ContractSupplierType::class)
                ->add('name')
                ->add('description')
                ->add('notes')
                ->add('signedAt', null, array(
                    'format'    => 'dd/MM/yyyy',
                    'html5'     => false,
                    'widget'    => 'single_text',
                    'required'  => false
                ))
                ->add('startAt', null, array(
                    'format'    => 'dd/MM/yyyy',
                    'html5'     => false,
                    'widget'    => 'single_text',
                    'required'  => false
                ))
                ->add('endAt', null, array(
                    'format'    => 'dd/MM/yyyy',
                    'html5'     => false,
                    'widget'    => 'single_text',
                    'required'  => false
                ))
                ->add('extraConditions', CKEditorType::class, array(
                    'required' => false
                ))
                ->add('topServices', CollectionType::class, array(
                    'entry_type' => ContractTopServiceType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => 'General services'
                ))
                ->add('privateHouseServices', CollectionType::class, array(
                    'entry_type' => ContractPrivateHouseServiceType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => 'Private house services'
                ))
                ->add('carRentalServices', CollectionType::class, array(
                    'entry_type' => ContractCarRentalServiceType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => 'Services'
                ))
                ->add('attachments', CollectionType::class, array(
                    'entry_type' => ContractAttachmentType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ))
                ->add('facilities', CollectionType::class, array(
                    'entry_type' => ContractFacilityType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => 'Hotels'
                ))
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Contract::class);
    }
}
