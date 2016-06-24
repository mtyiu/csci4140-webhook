<?php

namespace CSCI4140\WebhookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class JSONPController extends Controller {
	public function listAction( Request $request, $assignment, $account ) {
		$em = $this->getDoctrine()->getManager();
		$submissionRepo = $em->getRepository( 'CSCI4140WebhookBundle:Submission' );
		$data = $submissionRepo->listAll( $assignment, $account );
		foreach( $data as $k => $d ) {
			$student = $d->getStudent();
			$data[ $k ] = array(
				'i' => $d->getId() - ( $assignment == 1 ? 0 : 355 ),
				't' => $d->getSubmittedAt()->format( 'Y-m-d H:i:s' ),
				's' => $student ? $student->getStudentId() : null,
				'a' => $student ? null : $d->getAccount(),
				// 'r' => $d->getRef(),
				'h' => $d->getHead()
			);
		}

		$callback = $request->get( 'callback' );
		$response = new JsonResponse( $data );
		$response->setCallback( $callback );
		return $response;
	}
}
