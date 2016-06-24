<?php

namespace CSCI4140\WebhookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
	public function indexAction() {
		return $this->redirect( 'http://www.tywong-mole.com/~csci4140/' );
	}

	public function listAction( $assignment, $account ) {
		$em = $this->getDoctrine()->getManager();
		$submissionRepo = $em->getRepository( 'CSCI4140WebhookBundle:Submission' );
		$data = array(
			'current' => array( 'assignment' => $assignment, 'account' => $account ),
			'assignment' => $assignment == 1 ? 'Assignment 1: Web Instagram' : 'Assignment 2: YouTube Remote',
			'submissions' => $submissionRepo->listAll( $assignment, $account ),
		);
		return $this->render( 'CSCI4140WebhookBundle:Default:submissions.html.twig', $data );
	}

	public function removeTrailingSlashAction(Request $request) {
		$pathInfo = $request->getPathInfo();
		$requestUri = $request->getRequestUri();

		$url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);

		return $this->redirect($url, 301);
	}
}
