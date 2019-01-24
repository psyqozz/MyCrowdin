<?php

namespace App\Repository;

use App\Entity\SourceTranslated;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SourceTranslated|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceTranslated|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceTranslated[]    findAll()
 * @method SourceTranslated[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceTranslatedRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SourceTranslated::class);
    }
    
    public function showByLang($value)
    {
        return $this->createQueryBuilder('s')
            ->Where('s.lang_translate == value');
    }
    

   /* 
    public function findOneBySomeField($value): ?SourceTranslated
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
   */
   public function findBysource_id($value)
    {
	$conn = $this->getEntityManager()->getConnection();
	
        $query = 'SELECT count(DISTINCT source_id) as sourceTrans FROM source_translated, source, project WHERE project.id = source.project_id and source.id = source_translated.source_id and  project.id = :project_id';

	$stmt = $conn->prepare($query);
	$stmt->execute(['project_id' => $value]);
	    return $stmt->fetchAll();
    }
}
