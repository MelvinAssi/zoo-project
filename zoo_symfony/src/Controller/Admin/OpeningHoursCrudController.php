<?php

namespace App\Controller\Admin;


use App\Entity\OpeningHours;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpeningHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHours::class;
    }
            public function configureCrud(Crud $crud): Crud
    {
        return $crud
           ->setDefaultSort(
                [
                    'id' => 'ASC',
                ])
        ->setDateTimeFormat('hh:mm:ss am')
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
            TextField::new('day', 'Jour'),
            DateTimeField::new('openingTime', 'Ouverture'), 
            DateTimeField::new('closingTime', 'Fermeture'), 
        ];
    }

}
