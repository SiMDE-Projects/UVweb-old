<?php

namespace Uvweb\UvBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PollRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PollRepository extends EntityRepository
{
	public function findOrderedPollsByUv(Uv $uv) {
		$qb = $this->createQueryBuilder('p');

		$qb->where('p.uv = :uv')->setParameter('uv', $uv);
		$qb->setMaxResults(4);
		$qb->orderBy('p.semester', 'DESC');
		return $qb->getQuery()->getResult();
	}
}