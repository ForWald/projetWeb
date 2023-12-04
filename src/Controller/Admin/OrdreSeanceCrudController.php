<?php

namespace App\Controller\Admin;

use App\Entity\Programme;
use App\Entity\Categorie;
use App\Entity\Seance;
use App\Entity\Niveau;
use App\Entity\OrdreExercice;
use App\Entity\OrdreSeance;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class OrdreSeanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrdreSeance::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $className = $this->getEntityFqcn();
        $entityManager = $this->container->get('doctrine')->getManagerForClass($className);
        $someRepository = $entityManager->getRepository(Seance::class);
        return [
            
            IntegerField::new('ordre'),
            AssociationField::new('seance')->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Seance::class)->findAll()),
        ];
    }
}
