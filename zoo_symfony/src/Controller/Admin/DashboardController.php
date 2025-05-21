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
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DashboardController extends AbstractDashboardController
{
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    #[Route('/api', name: 'api')]
    public function index(): Response
    {
        $firebaseConfig = [
            'apiKey' => $_ENV['FIREBASE_API_KEY'],
            'authDomain' => $_ENV['FIREBASE_AUTH_DOMAIN'],
            'projectId' => $_ENV['FIREBASE_PROJECT_ID'],
            'storageBucket' => $_ENV['FIREBASE_STORAGE_BUCKET'],
            'messagingSenderId' => $_ENV['FIREBASE_MESSAGING_SENDER_ID'],
            'appId' => $_ENV['FIREBASE_APP_ID'],
            'measurementId' => $_ENV['FIREBASE_MEASUREMENT_ID'],
        ];
        return $this->render('admin/dashboard.html.twig', [
            'firebase_config' => $firebaseConfig,
        ]);
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