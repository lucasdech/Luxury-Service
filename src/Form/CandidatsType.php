<?php

namespace App\Form;

use App\Entity\Candidats;
use App\Entity\Experience;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Gender')
            ->add('first_name')
            ->add('last_name')
            ->add('adress')
            ->add('country')
            ->add('nationality')
            ->add('is_passPort')
            ->add('passPort_files')
            ->add('cv')
            ->add('profil_picture')
            ->add('current_location')
            ->add('date_of_birth')
            ->add('email')
            ->add('aviability', null, [
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('note')
            ->add('date_created', null, [
                'widget' => 'single_text',
            ])
            ->add('date_updated', null, [
                'widget' => 'single_text',
            ])
            ->add('date_delete', null, [
                'widget' => 'single_text',
            ])
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
