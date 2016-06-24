<?php

namespace CSCI4140\WebhookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CSCI4140\WebhookBundle\Entity\Submission;

class GitHubController extends Controller {
	public function submitAction( Request $request, $assignment ) {
		$handler = $this->get( 'csci4140_webhook.handler' );
		$ret = $handler->handle(
			$request->server->get( 'HTTP_X_HUB_SIGNATURE' ),
			$request->server->get( 'HTTP_X_GITHUB_EVENT' ),
			$request->server->get( 'HTTP_X_GITHUB_DELIVERY' ),
			$request->getContent()
		);
		if ( $ret ) {
			$em = $this->getDoctrine()->getManager();
			$studentRepo = $em->getRepository( 'CSCI4140WebhookBundle:Student' );
			$submission = new Submission();
			$data = $handler->getData();

			if ( ! isset( $data[ 'ref' ] ) )
				return new Response( '' );

			switch( $assignment ) {
				case '1':
					$submission->setAssignment( 1 );
					$prefix = 'asg1-instagram-';
					break;
				case '2':
					$submission->setAssignment( 2 );
					$prefix = 'asg2-youtube-remote-';
					break;
				default:
					$ret = false;
					break;
			}
			$submission->setRef( str_replace( 'refs/heads/', '', $data[ 'ref' ] ) );
			$submission->setHead( $data[ 'head_commit' ][ 'id' ] );
			$submission->setRepositoryName( $data[ 'repository' ][ 'name' ] );
			$submission->setRepositoryFullName( $data[ 'repository' ][ 'full_name' ] );

			$account = str_replace( $prefix, '', $data[ 'repository' ][ 'name' ] );
			$submission->setAccount( $account );

			$student = $studentRepo->findByAccount( $account );
			$submission->setStudent( $student );

			if ( $ret ) {
				$em->persist( $submission );
				$em->flush();
			}
		}
		return new Response(
			'[' . ( $ret ? 'SUCCESS' : 'FAIL' ) . '] Submission time: ' . date( 'Y-m-d H:i:s' )
		);
	}
}
