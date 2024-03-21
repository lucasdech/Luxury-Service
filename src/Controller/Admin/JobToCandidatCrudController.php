<?php

namespace App\Controller\Admin;

use App\Entity\JobToCandidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobToCandidatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobToCandidat::class;
    }

//    public function configureFields(string $pageName): iterable
//     {
//         return [
//             IdField::new('id')->hideOnForm(),
//             TextField::new('title')->hideOnDetail(),
//             TextEditorField::new('description')->hideOnForm(),
//             AssociationField::new('Candidats'),
//             AssociationField::new('JobOffer'),
//         ];
//     }
}
