<?php

namespace CSCI4140\WebhookBundle\Entity;

/**
 * Submission
 */
class Submission
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var \DateTime
	 */
	private $submittedAt;

	/**
	 * @var int
	 */
	private $assignment;

	/**
	 * @var string
	 */
	private $ref;

	/**
	 * @var string
	 */
	private $head;

	/**
	 * @var string
	 */
	private $repositoryName;

	/**
	 * @var string
	 */
	private $repositoryFullName;


	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set submittedAt
	 *
	 * @param \DateTime $submittedAt
	 *
	 * @return Submission
	 */
	public function setSubmittedAt($submittedAt)
	{
		$this->submittedAt = $submittedAt;

		return $this;
	}

	/**
	 * Get submittedAt
	 *
	 * @return \DateTime
	 */
	public function getSubmittedAt()
	{
		return $this->submittedAt;
	}

	/**
	 * Set assignment
	 *
	 * @param integer $assignment
	 *
	 * @return Submission
	 */
	public function setAssignment($assignment)
	{
		$this->assignment = $assignment;

		return $this;
	}

	/**
	 * Get assignment
	 *
	 * @return int
	 */
	public function getAssignment()
	{
		return $this->assignment;
	}

	/**
	 * Set ref
	 *
	 * @param string $ref
	 *
	 * @return Submission
	 */
	public function setRef($ref)
	{
		$this->ref = $ref;

		return $this;
	}

	/**
	 * Get ref
	 *
	 * @return string
	 */
	public function getRef()
	{
		return $this->ref;
	}

	/**
	 * Set head
	 *
	 * @param string $head
	 *
	 * @return Submission
	 */
	public function setHead($head)
	{
		$this->head = $head;

		return $this;
	}

	/**
	 * Get head
	 *
	 * @return string
	 */
	public function getHead()
	{
		return $this->head;
	}

	/**
	 * Set repositoryName
	 *
	 * @param string $repositoryName
	 *
	 * @return Submission
	 */
	public function setRepositoryName($repositoryName)
	{
		$this->repositoryName = $repositoryName;

		return $this;
	}

	/**
	 * Get repositoryName
	 *
	 * @return string
	 */
	public function getRepositoryName()
	{
		return $this->repositoryName;
	}

	/**
	 * Set repositoryFullName
	 *
	 * @param string $repositoryFullName
	 *
	 * @return Submission
	 */
	public function setRepositoryFullName($repositoryFullName)
	{
		$this->repositoryFullName = $repositoryFullName;

		return $this;
	}

	/**
	 * Get repositoryFullName
	 *
	 * @return string
	 */
	public function getRepositoryFullName()
	{
		return $this->repositoryFullName;
	}

	public function updateTimestamp()	{
		$this->setSubmittedAt( new \DateTime( date( 'Y-m-d H:i:s' ) ) );
	}
    /**
     * @var string
     */
    private $account;

    /**
     * @var \CSCI4140\WebhookBundle\Entity\Student
     */
    private $student;


    /**
     * Set account
     *
     * @param string $account
     *
     * @return Submission
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set student
     *
     * @param \CSCI4140\WebhookBundle\Entity\Student $student
     *
     * @return Submission
     */
    public function setStudent(\CSCI4140\WebhookBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \CSCI4140\WebhookBundle\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }
}
