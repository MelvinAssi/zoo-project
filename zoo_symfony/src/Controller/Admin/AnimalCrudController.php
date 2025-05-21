<?php

namespace App\Controller\Admin;
use App\Entity\Animal;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use function Symfony\Component\Clock\now;

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


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Animal) return;
        $entityInstance->setCreatedAt(now());
        $entityInstance->setCreatedBy($this->getUser());
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Animal) return;
        $entityInstance->setUpdatedAt(now());
        $entityInstance->setUpdatedBy($this->getUser());

        $entityManager->flush();
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
            ImageField::new('photo', 'Photo')
                ->setBasePath('/images/animals')
                ->setUploadDir('public/images/animals') 
                ->setUploadedFileNamePattern('[randomhash].[extension]') 
                ->setRequired(false),
            DateTimeField::new('createdAt', 'Date de création')->setFormTypeOption('disabled', $pageName), 
            DateTimeField::new('updated_at', 'Date de maj')->setFormTypeOption('disabled', $pageName), 
            AssociationField::new('createdBy', 'Fait par ')->setFormTypeOption('disabled', $pageName),
            AssociationField::new('updatedBy', 'Maj par ')->setFormTypeOption('disabled', $pageName),
            AssociationField::new('enclosure', 'Enclos '),
        ];
    }

}
