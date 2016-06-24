<?php

namespace CSCI4140\WebhookBundle\Repository;

class SubmissionRepository extends \Doctrine\ORM\EntityRepository {
	public function listAll( $assignment, $account = null, $sort = 'submittedAt', $order = 'DESC' ) {
		$query = $this->createQueryBuilder( 's' );
		$where = 's.assignment = :assignment';
		if ( $account ) {
			$where .= ' AND s.account = :account';
			$query->setParameter( 'assignment', $assignment );
			$query->setParameter( 'account', $account );
		} else {
			$query->setParameter( 'assignment', $assignment );
		}
		return $query
			->where( $where )
			->orderBy( 's.' . $sort, $order )
			->getQuery()
			->getResult();
	}

	public function listAllValid( $assignment, $account = null, $sort = 'submittedAt', $order = 'DESC' ) {
		$query = $this->createQueryBuilder( 's' );
		$where = 's.assignment = :assignment AND s.ref = :ref';
		if ( $account ) {
			$where .= ' AND s.account = :account';
			$query->setParameter( 'account', $account );
		}
		$query->setParameter( 'assignment', $assignment );
		$query->setParameter( 'ref', 'master' );
		return $query
			->where( $where )
			->orderBy( 's.' . $sort, $order )
			->getQuery()
			->getResult();
	}
}
