<?php

namespace App\Form;

use App\Entity\Candidats;
use App\Entity\JobOffer;
use App\Entity\JobToCandidat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobToCandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('time', null, [
                'widget' => 'single_text',
            ])
            ->add('is_approved')
            ->add('id_JobOffer', EntityType::class, [
                'class' => JobOffer::class,
                'choice_label' => 'id',
            ])
            ->add('id_Candidat', EntityType::class, [
                'class' => Candidats::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobToCandidat::class,
        ]);
    }
}
