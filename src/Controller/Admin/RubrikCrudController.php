<?php

namespace App\Controller\Admin;

use App\Entity\Rubrik;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
class RubrikCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rubrik::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->OnlyOnIndex(),
            TextField::new('name'),
        ];
    }
   
}
