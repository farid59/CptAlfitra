<?php

namespace Alfitra\CptBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormulaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('civilite',  ChoiceType::class, array(
            //     'choices'  => [
            //         'Frère' => 'Frere',
            //         'Soeur' => 'Soeur',
            //         'Enfant' => 'Enfant',
            //     ]))
        ->add('civilite', ChoiceType::class, array('expanded' => true, 
                'choices'  => [
                    'Frère' => 'Frere',
                    'Soeur' => 'Soeur',
                    'Enfant' => 'Enfant',
                ],
                'label_attr' => ['class' => 'checkbox-inline']))
            ->add('montant')
            ->add('nom')
            ->add('prenom')
            ->add('modePaiement',  ChoiceType::class, array(
                'choices'  => [
                    'Espèce' => 'Espece',
                    'CB' => 'CB',
                    'Chèque' => 'Cheque',
                    'Promesse' => 'Promesse',
                    'Mensuel' => 'Mensuel'
                ]))
            ->add('anonyme')
            ->add('recuFiscal')
            ->add('telephone', TextType::class, array('required' => false))
            ->add('invocationPourqui', TextType::class, array('required' => false))
            ->add('invocationPourquoi', TextType::class, array('required' => false))
            ->add('invocationDetails', TextType::class, array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alfitra\CptBundle\Entity\Formulaire'
        ));
    }
}
