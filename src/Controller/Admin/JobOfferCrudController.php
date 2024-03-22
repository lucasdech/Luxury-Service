<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;


class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('reference'),
            TextField::new('description'),
            BooleanField::new('is_active'),
            TextField::new('notes'),
            TextField::new('job_title'),
            TextField::new('location'),
            DateField::new('closing_date'),
            NumberField::new('salary'),
            DateField::new('created_date'),

            AssociationField::new('id_category'),
            AssociationField::new('id_JobType'),
            AssociationField::new('client'),

            
        ];
    }
    
}
