<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @param int $id
     * @return void Returns an array of Category objects
     */

   // public function add($value)
   // {
   //     return $this->createQueryBuilder('c')
   //         ->andWhere('c.exampleField = :val')
   //         ->setParameter('val', $value)
   //         ->orderBy('c.id', 'ASC')
   //         ->setMaxResults(10)
   //         ->getQuery()
   //         ->getResult()
   //     ;
   // }

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getArticleFromCategory ($idCategory){
        $qb = $this->createQueryBuilder('a');
        $qb->add('select', 'a');
        $qb->leftJoin('a.recette_category', 'c');
        $qb->where('c.category_id LIKE :recette_category'); /* i have guessed a.name */
        $qb->setParameter('category', $idCategory);
        $qb->getQuery()->getResult();
    }
}
