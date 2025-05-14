<?php

namespace App\Controller\Admin;
use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
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
            IdField::new('id', 'ID')->setFormTypeOption('disabled', $pageName),
            TextField::new('name', 'Nom '),
            TextField::new('specie', 'Espèces'),
            NumberField::new('age', 'Age'),
            TextField::new('description', 'Description')->hideOnIndex(),
            TextField::new('photo', 'nom photo'),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(), 
            DateTimeField::new('updated_at', 'Date de maj')->hideOnForm(), 
            AssociationField::new('createdBy', 'Fait par '),
            AssociationField::new('updatedBy', 'Maj par '),
            AssociationField::new('enclosure', 'Enclos '),
        ];
    }

}
