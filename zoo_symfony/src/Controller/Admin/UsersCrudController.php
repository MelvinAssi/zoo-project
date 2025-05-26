<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Users) return;

        if ($entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $entityInstance,
                $entityInstance->getPassword()
            );
            $entityInstance->setPassword($hashedPassword);
    }

    $entityManager->persist($entityInstance);
    $entityManager->flush();
    }
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Users) return;

        if ($entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $entityInstance,
                $entityInstance->getPassword()
            );
            $entityInstance->setPassword($hashedPassword);
        }

        $entityManager->flush();
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->add(Crud::PAGE_EDIT, Action::DETAIL)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_NEW, Action::INDEX)            
            ->setPermission(actionName: Action::DELETE, permission:'ROLE_ADMIN')
            ->setPermission(actionName: Action::NEW, permission:'ROLE_ADMIN')
            ->setPermission(actionName: Action::EDIT, permission:'ROLE_ADMIN')
            ->setPermission(actionName: Action::DETAIL, permission:'ROLE_ADMIN')
            ->setPermission(actionName: Action::BATCH_DELETE, permission:'ROLE_ADMIN')
            ;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
           ->setDefaultSort(
                [
                    'id' => 'ASC',
                    'username' => 'ASC',
                ])
        ->setDateTimeFormat('dd/M/yy hh:mm:ss')
        ->setPaginatorPageSize(8)
        ;
    }

    

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->setFormTypeOption('disabled',$pageName),
            TextField::new('username', 'Nom d’utilisateur'),
            EmailField::new('email', 'Email'),
            TextField::new('password', 'Mot de passe')->hideOnIndex(),
            ArrayField::new('roles', 'Rôles'),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(), 
            BooleanField::new('isActive', 'Actif'),
            BooleanField::new('firstLoginDone', 'Première connexion faite'),
        ];
    }

    
}
