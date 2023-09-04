<?php

namespace App\Controller\Admin;

use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\config\Action;
use EasyCorp\Bundle\EasyAdminBundle\config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Utilisateurs')
        ->setEntityLabelInSingular('Utilisateur')
        ->setPageTitle("index", "MyApps -Administration")
        ->setEntityLabelInSingular('User')
        ->setDefaultSort(['createdAt'=> 'DESC'])
        ->setPaginatorPageSize(5)
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            EmailField::new('email'),
            $roles= ChoiceField::new('roles')->setColumns('col-md-4')->setChoices([
                'ROLE_USER'=>'ROLE_USER',
                'ROLE_EDITOR'=>'ROLE_EDITOR',
                'ROLE_ADMIN'=>'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN'=>'ROLE_SUPER_ADMIN'
            ])->allowMultipleChoices(),
            TextField::new('password'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('address'),
            TextField::new('city'),
            TextField::new('zipcode'),
            TextField::new('gender'),
            TextField::new('pseudo'),
            TextField::new('avatar'),
            DateField::new('createdAt'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('firstname')
        ->add('lastname')
        ->add('address')
        ->add('city')
        ->add('zipcode')
        ->add('gender')
        ->add('createdAt')
        ;
    }
   
}
