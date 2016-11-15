<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InputType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('partnername', ChoiceType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'choices' => [
                    'Select Partner' => 0,
                    'AdKnowledge' => 1,
                    'LiveIntent' => 2
                    ],
                'attr' => [
                    'class' => 'form-control',
                    'id'=> "ex3p"
                    ]])
            ->add('resourcename', ChoiceType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'placeholder' => 'Select Resource',
                'choices' => [
                    'Jobbery.com' => 1,
                    'OfficeJobsGurus.com' => 2,
                    'RemoteJobsForU.com' => 3,
                    'TravelFlex.com' => 4,
                    'Finsensitive.com' => 5,
                    'InsureGuidance.com' => 6,
                    'SmartEduPics.com' => 7,
                    'Relaxst.com' => 8,
                    'Mediaff.com' => 9
                ],
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('templatename', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Complete Template Name',
                    'class' => 'form-control'
                ]])
            ->add('numemails', TextType::class, [
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Number of Campaigns',
                    'class' => 'form-control',
                    'id'=> "ex3"
                    ]])
            ->add('submit', SubmitType::class, [
                'label' => 'Generate Campaigns',
                'attr' => array(
                    'class' => 'btn btn-success btn-block'
                )])
             ;
    }
    
    /**
    * @param OptionsResolverInterface $resolver
    */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CampaignInputDetails'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'input';
    }
}