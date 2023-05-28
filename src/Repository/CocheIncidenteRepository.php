<?php

namespace App\Repository;

use App\Entity\CocheIncidente;
use App\Entity\Incidente;
use App\Entity\Coche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @extends ServiceEntityRepository<CocheIncidente>
 *
 * @method CocheIncidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method CocheIncidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method CocheIncidente[]    findAll()
 * @method CocheIncidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CocheIncidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CocheIncidente::class);
    }

    public function save(CocheIncidente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CocheIncidente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCarsByIncident(Incidente $i)
    {
        $qb = $this->createQueryBuilder('ci');
        $qb->where('ci.incidente = :incidente')
            ->setParameter('incidente', $i);

        return $qb->getQuery()->getResult();
    }

    public function existsCar(Coche $c, Incidente $i)
    {
        $qb = $this->createQueryBuilder('ci');
        $qb->where('ci.coche = :coche')
            ->andWhere('ci.incidente = :incidente')
            ->setParameter('coche', $c)
            ->setParameter('incidente', $i);

        return $qb->getQuery()->getResult();
    }

    public function updateCars(Incidente $i, ArrayCollection $cars, bool $flush = false): void
    {
        $carsRelateds = $this->findCarsByIncident($i);
        foreach ($carsRelateds as $carRelated) {
            $this->remove($carRelated, $flush);
        }
        foreach ($cars as $car) {
            $ci = new CocheIncidente();
            $ci->setIncidente($i);
            $ci->setCoche($car);
            $ci->setDescripcion('');
            $this->save($ci, $flush);
        }
    }

    //    /**
    //     * @return CocheIncidente[] Returns an array of CocheIncidente objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CocheIncidente
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
