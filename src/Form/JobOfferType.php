<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\JobOffer;
use App\Entity\JobType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('description')
            ->add('is_active')
            ->add('notes')
            ->add('job_title')
            ->add('location')
            ->add('closing_date', null, [
                'widget' => 'single_text',
            ])
            ->add('salary')
            ->add('created_date', null, [
                'widget' => 'single_text',
            ])
            ->add('id_category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
            ])
            ->add('id_JobType', EntityType::class, [
                'class' => JobType::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
