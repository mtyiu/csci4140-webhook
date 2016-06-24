<?php

namespace CSCI4140\WebhookBundle\Repository;

class StudentRepository extends \Doctrine\ORM\EntityRepository {
	public function findByAccount( $account ) {
		$ret = $this
			->createQueryBuilder( 's' )
			->where( 's.account = :account' )
			->setParameter( 'account', $account )
			->getQuery()
			->getOneOrNullResult();
		return $ret;
	}
}
