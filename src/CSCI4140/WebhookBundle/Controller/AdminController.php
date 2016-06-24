<?php

namespace CSCI4140\WebhookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CSCI4140\WebhookBundle\Entity\Student;

class AdminController extends Controller {
	public function indexAction() {
		return $this->redirectToRoute( 'csci4140_webhook_admin_list_submissions', array( 'assignment' => 1 ) );
	}

	public function importAction() {
		$em = $this->getDoctrine()->getManager();

		$students = file_get_contents( __DIR__ . '/../Resources/data/student.txt' );
		$students = explode( "\n", trim( $students ) );
		foreach( $students as $index => $s ) {
			$students[ $index ] = explode( '","', $s );
			for( $i = 0; $i < 3; $i++ ) {
				$students[ $index ][ $i ] = str_replace( '"', '', $students[ $index ][ $i ] );
			}
			if ( $students[ $index ][ 2 ] == 'NULL' ) {
				$students[ $index ][ 2 ] = NULL;
			}
			$student = new Student();
			$student->setStudentId( $students[ $index ][ 0 ] );
			$student->setName( $students[ $index ][ 1 ] );
			$student->setAccount( $students[ $index ][ 2 ] );
			$em->persist( $student );
		}
		$em->flush();
		$data = array( 'students' => $students );
		return $this->render( 'CSCI4140WebhookBundle:Admin:import.html.twig', $data );
	}

	public function listStudentsAction( $sort ) {
		$em = $this->getDoctrine()->getManager();
		$studentRepo = $em->getRepository( 'CSCI4140WebhookBundle:Student' );
		$data = array(
			'current' => array( 'sort' => $sort ),
			'students' => $studentRepo->findBy( array(), array( $sort => 'ASC' ) ),
		);
		return $this->render( 'CSCI4140WebhookBundle:Admin:students.html.twig', $data );
	}

	public function listSubmissionsAction( $assignment, $account ) {
		$em = $this->getDoctrine()->getManager();
		$submissionRepo = $em->getRepository( 'CSCI4140WebhookBundle:Submission' );
		$data = array(
			'current' => array( 'assignment' => $assignment, 'account' => $account ),
			'assignment' => $assignment == 1 ? 'Assignment 1: Web Instagram' : 'Assignment 2: YouTube Remote',
			'submissions' => $submissionRepo->listAll( $assignment, $account ),
		);
		return $this->render( 'CSCI4140WebhookBundle:Admin:submissions.html.twig', $data );
	}
}
