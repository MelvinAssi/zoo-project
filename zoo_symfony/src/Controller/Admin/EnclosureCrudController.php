<?php

namespace App\Controller\Admin;

use App\Entity\Enclosure;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EnclosureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enclosure::class;
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
            NumberField::new('max_capacity', 'Capacité'),
            TextField::new('specie_type', 'Espèces'),
            NumberField::new('localisation', 'Localisation'),
        ];
    }

}

