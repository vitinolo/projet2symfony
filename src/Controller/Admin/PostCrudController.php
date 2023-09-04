<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->OnlyOnIndex(),
            TextField::new('titre')->setColumns('col-md-12'),
            TextEditorField::new('abstract')->setFormType(CKEditorType::class)->setColumns('col-md-12'),
            TextEditorField::new('content')->setFormType(CKEditorType::class)->setColumns('col-md-6'),
            AssociationField::new('rubriks')->setColumns('col-md-3'),
            DateField::new('createdAt')->setColumns('col-md-3'),

            $image = ImageField::new('image')
                ->setUploadDir('public/images')
                ->setBasePath('images')
                ->setSortable(false)
                ->setFormTypeOption('required' ,false)->setColumns('col-md-2'),
            AssociationField::new('users')->setColumns('col-md-3'),
            $isactive = BooleanField::new('published')->setPermission('ROLE_EDITOR')->setColumns('col-md-1')->setLabel('Publié'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('post')
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPaginatorPageSize(5)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('users') 
            ->add('titre') 
            ->add('content') 
            ->add('rubriks') 
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
           
        ;
    }
}


