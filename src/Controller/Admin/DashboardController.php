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
            return Dashboard::new()
                // the name visible to end users
                ->setTitle('shop symfony.')
                // you can include HTML contents too (e.g. to link to an image)
    
                // the path defined in this method is passed to the Twig asset() function
    
                // the domain used by default is 'messages'
                ->setTranslationDomain('my-custom-domain')
    
                // there's no need to define the "text direction" explicitly because
                // its default value is inferred dynamically from the user locale
                ->setTextDirection('ltr')
    
                // set this option if you prefer the page content to span the entire
                // browser width, instead of the default design which sets a max width
                ->renderContentMaximized()
    
                // set this option if you prefer the sidebar (which contains the main menu)
                // to be displayed as a narrow column instead of the default expanded design
                ->renderSidebarMinimized()
    
                // by default, all backend URLs include a signature hash. If a user changes any
                // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
                // triggers an error. If this causes any issue in your backend, call this method
                // to disable this feature and remove all URL signature checks
                ->disableUrlSignatures()
    
                // by default, all backend URLs are generated as absolute URLs. If you
                // need to generate relative URLs instead, call this method
                ->generateRelativeUrls()
            ;
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
