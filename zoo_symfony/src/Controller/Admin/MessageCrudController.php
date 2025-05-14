<?php

namespace App\Controller\Admin;


use App\Entity\Message;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }
            public function configureCrud(Crud $crud): Crud
    {
        return $crud
           ->setDefaultSort(
                [
                    'id' => 'ASC',
                ])
        ->setDateTimeFormat('dd/M/yy hh:mm:ss')
        ->setPaginatorPageSize(8)
        ;
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->add(Crud::PAGE_EDIT, Action::DETAIL)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_NEW, Action::INDEX)            
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->setFormTypeOption('disabled', $pageName ),
            TextField::new('name', 'Nom '),
            EmailField::new('email', 'Email'),
            TextField::new('subject', 'Sujet'),
            TextField::new('content', 'Contenue')->hideOnIndex(), 
            BooleanField::new('is_read', 'Lu'), 
            BooleanField::new('is_responded', 'Repondu'),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(), 
            AssociationField::new('processed_by', 'Traité par '),

        ];
    }

}
