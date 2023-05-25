<?php

namespace App\Repository\Post;

use App\Entity\Post\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use \Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
        parent::__construct($registry, Post::class);
    }


//    /**
//     * @return Post[] Returns an array of Post objects
//     */
    public function findPublished(int $page, int $limit) : PaginationInterface
    {
        $data = $this->createQueryBuilder('p')
            ->andWhere('p.state = :state')
            ->setParameter('state', 'STATE_PUBLISHED')
            ->orderBy('p.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
        $posts = $this->paginator->paginate(
                $data,
                $page, /*page number*/
                $limit /*limit per page*/
        );
        return $posts;
    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
