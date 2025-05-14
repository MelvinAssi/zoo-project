<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\Enclosure;
use App\Entity\Message;
use App\Entity\OpeningHours;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\Users;


class DashboardController extends AbstractDashboardController
{
    #[Route('/api', name: 'api')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zoo Gestion')
            ->setFaviconPath('images/logo_zoo.png')
            ->setDefaultColorScheme('light')
            ->setLocales( ['fr']);
            
    }

    public function configureMenuItems(): iterable
    {
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
            yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Users::class);
            yield MenuItem::linkToCrud('Animal', 'fas fa-paw', Animal::class);
            yield MenuItem::linkToCrud('Enclos', 'fas fa-square', Enclosure::class);
            yield MenuItem::linkToCrud('Horraire', 'fas fa-clock', OpeningHours::class);
            yield MenuItem::linkToCrud('Message', 'fas fa-envelope', Message::class);
    }
}
