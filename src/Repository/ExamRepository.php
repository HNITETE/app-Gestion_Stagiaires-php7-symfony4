<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 10/05/2019
 * Time: 12:29
 */

// src/Repository/StagiaireRepositoryry.php
namespace App\Repository;

use App\Examen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class ExamRepository extends  ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Examen::class);
    }

    /**
     * @param $codegr
     * @return Examen[]
     */
    public function findDetails($codese): array
    {
        /* return $this->createQueryBuilder('p')
             // p.category refers to the "category" property on product
             //->innerJoin('p.codegr', 'c')
             // selects all the category data to avoid the query
             ->addSelect('c')
             ->andWhere('p.codest = :id')
             ->setParameter('id', $codest)
             ->getQuery()
             ->getOneOrNullResult();*/

        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('e')
            //->andWhere('p.price > :price')
            ->setParameter('codese', $codese)
            //->orderBy('p.price', 'ASC')
            ->getQuery();

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }

}