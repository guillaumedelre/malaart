<?php

namespace App\Controller\Admin;

use App\Dashboard\DashboardBuilder;
use App\Entity\Jewel;
use App\Entity\Material;
use App\Entity\Purchase;
use App\Entity\Stone;
use App\Entity\Supplier;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private DashboardBuilder $dashboardBuilder;

    public function __construct(DashboardBuilder $dashboardBuilder)
    {
        $this->dashboardBuilder = $dashboardBuilder;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('dashboard.html.twig', [
            'dashboard_title' => 'Dashboard',
            'view_object' => $this->dashboardBuilder->getView(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // you can include HTML contents too (e.g. to link to an image)
                        ->setTitle('<img height="30" src="favicon.svg"> mâlâ<span class="text-small">_art</span>')
            // the path defined in this method is passed to the Twig asset() function
                        ->setFaviconPath('favicon.svg')
            // the domain used by default is 'messages'
            //            ->setTranslationDomain('my-custom-domain')
            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
                        ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
                        ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
                        ->renderSidebarMinimized()
            ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fal fa-home'),

            MenuItem::section('Catalogues', 'fal fa-list'),
            MenuItem::linkToCrud('Pierres', 'fal fa-gem', Stone::class),
            MenuItem::linkToCrud('Fournitures', 'fal fa-parachute-box', Material::class),
            MenuItem::linkToCrud('Fournisseurs', 'fal fa-truck', Supplier::class),

            MenuItem::section('Boutique', 'fal fa-store'),
            MenuItem::linkToCrud('Achats', 'fal fa-shopping-bag', Purchase::class),
            MenuItem::linkToCrud('Bijoux', 'fal fa-diamond', Jewel::class),

            MenuItem::section('Paramètres', 'fal fa-cog'),
            MenuItem::linkToCrud('Tags', 'fal fa-tags', Tag::class),
        ];
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('css/admin.css')

            ->addJsFile('js/admin.js')
            ->addJsFile('js/chart-helper.js')
            ->addJsFile('https://kit.fontawesome.com/e5bf68ef8c.js')
            ->addJsFile('https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js')
            ;
    }
}
