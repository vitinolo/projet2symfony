<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Rubrik;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{  
     //déclarer la variable $userRepository en protected
    protected $userRepository;

    //mettre en place le constructeur
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    #[Route('/admin', name: 'admin')]

    public function index(): Response
    {   //fixer le rôle le moins élévé
        if($this->isGranted('ROLE_EDITOR')){
            return $this->render('admin/dashboard.html.twig');

        }else
        return $this->redirectToRoute('app_post');
        
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());
        
        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }
        
        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
            
            
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet2symfony');
    }

    public function configureMenuItems(): iterable
    {   yield MenuItem::linkToRoute('Go to site', 'fa-solid fa-arrow-rotate-left','app_post');
        //definition du role admin
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home')->setPermission('ROLE_ADMIN') ;
        }
        //definition du role editor
        if($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Posts');
            yield MenuItem::subMenu('Posts', 'fa-sharp fa-solid fa-blog')->setSubItems([
                MenuItem::linkToCrud('Create Post','fas fa-newspaper', Post::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Post','fas fa-eye', Post::class),
            ]);
        }
        //definition du role admin
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Users');
            yield MenuItem::subMenu('Users', 'fa fa-user-circle')->setSubItems([
                MenuItem::linkToCrud('Create User','fas fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show User','fas fa-eye', User::class),
            ]);
        }
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Rubriks');
            yield MenuItem::subMenu('Rubriks', 'fas fa-elementor')->setSubItems([
                MenuItem::linkToCrud('Create Rubrik','menu-icon fa fw fas fa-plus-circle', Rubrik::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Rubrik','fas fa-eye', Rubrik::class),
            ]);
        }
        
    }
    //gestion de l'avatar dans le dashboard
    public function configureUserMenu(UserInterface $user):UserMenu
    {
        if(!$user instanceof User){
            throw new \Exception('Wrong user');
        }
        $avatar ='images/' . $user->getAvatar();
        return parent::configureUserMenu($user)->setAvatarUrl($avatar);
    }
}
