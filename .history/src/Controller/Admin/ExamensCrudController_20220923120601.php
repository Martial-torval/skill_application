<?php

namespace App\Controller\Admin;

use App\Entity\Examens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExamensCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Examens::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            // TextField::new('subtitle'),
            TextField::new('city'),
            DateTimeField::new('date'),
        ];
    }
    
}
