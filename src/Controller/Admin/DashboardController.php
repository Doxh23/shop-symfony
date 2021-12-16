<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        {
            return Dashboard::new();
        }
    }

    public function configureMenuItems(): iterable
    {
        return [
         MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
         MenuItem::linkToCrud('user', 'fas fa-user', User::class),
         MenuItem::linkToCrud('category', 'fas fa-list', Category::class),
        MenuItem::linkToCrud('Products', 'fas fa-tag', Product::class),

        ];
    }
}
