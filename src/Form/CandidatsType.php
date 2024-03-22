<?php

namespace App\Form;

use App\Entity\Candidats;
use App\Entity\Experience;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;



class CandidatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Gender', ChoiceType::class, [
               'choices' => [
                    'homme' => true,
                    'femme' => true,
                    'trans' => true, 
                    ]
               ])
            ->add('first_name')
            ->add('last_name')
            ->add('adress')
            ->add('country')
            ->add('nationality')
            ->add('is_passPort')
            
            ->add('passPort_files', FileType::class, [
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                    'mimeTypes' => [
                        'image/*' ,
                    ],
                    'mimeTypesMessage' => 'Please upload a valid jpg document',
                    ])
                ]
            ])
            ->add('cv', FileType::class, [
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                    'mimeTypes' => [
                        'application/pdf',
                        'application/x-pdf',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid document',
                    ])
                ]
            ])
            ->add('profil_picture', FileType::class, [
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                    'mimeTypes' => [
                        'image/*',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid document',
                    ])
                ]
            ])
            ->add('current_location')
            ->add('date_of_birth')
            ->add('email')
            ->add('aviability', null, [
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('note')
            ->add('file')
            ->add('id_experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidats::class,
        ]);
    }
}
