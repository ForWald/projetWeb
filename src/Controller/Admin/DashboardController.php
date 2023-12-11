<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\ContactSportif;
use App\Entity\Exercice;
use App\Entity\OrdreExercice;
use App\Entity\Programme;
use App\Entity\Seance;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_COACH')")]

    public function index(): Response
    {

        $roles = $this->getUser()->getRoles();
        if (in_array('ROLE_ADMIN', $roles)) {

            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
        } else {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            return $this->redirect($adminUrlGenerator->setController(ProgrammeCrudController::class)->generateUrl());
        }
        
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('WorkoutWizard')
            ->setFaviconPath('build/images/favicon.png');
    }

    public function configureMenuItems(): iterable
    {
        $roles = $this->getUser()->getRoles();

        yield MenuItem::linkToRoute('Accueil', 'fa fa-home', 'home');

        if (in_array('ROLE_ADMIN', $roles)) {
            yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', User::class);
        }

        yield MenuItem::linkToCrud('Programme', 'fa-solid fa-calendar-days', Programme::class);
        yield MenuItem::linkToCrud('Seance', 'fa-regular fa-calendar', Seance::class);
        yield MenuItem::linkToCrud('Exercice', 'fa-solid fa-dumbbell', Exercice::class);

        if (in_array('ROLE_ADMIN', $roles)) {
            yield MenuItem::linkToCrud('Contact ', 'fa-solid fa-table', Contact::class);
            yield MenuItem::linkToCrud('Contact Sportif', 'fa-solid fa-table-list', ContactSportif::class);
        } else if (in_array('ROLE_COACH', $roles)) {
            yield MenuItem::linkToCrud('Contact Sportif', 'fa-solid fa-table', ContactSportif::class);
        }
    }
}
