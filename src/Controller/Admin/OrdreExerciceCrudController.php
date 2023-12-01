<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Exercice;
use App\Entity\Niveau;
use App\Entity\OrdreExercice;
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

class OrdreExerciceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrdreExercice::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $className = $this->getEntityFqcn();
        $entityManager = $this->container->get('doctrine')->getManagerForClass($className);
        $someRepository = $entityManager->getRepository(Exercice::class);
        return [

            IntegerField::new('ordre'),
            IntegerField::new('nb_rep'),
            IntegerField::new('nb_series'),
            NumberField::new('temps'),
            NumberField::new('temps_repos'),
            AssociationField::new('exercice')->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Exercice::class)->findAll()),
        ];
    }

}
