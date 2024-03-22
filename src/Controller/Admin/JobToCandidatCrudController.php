<?php

namespace App\Controller\Admin;

use App\Entity\JobToCandidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\Validator\Constraints\Date;

class JobToCandidatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobToCandidat::class;
    }

   public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('time'),
            BooleanField::new('is_approved'),
            AssociationField::new('id_Candidat'),
            AssociationField::new('id_JobOffer'),
        ];
    }

}
