<?php

namespace CSCI4140\WebhookBundle\Entity;

/**
 * Student
 */
class Student
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $studentId;

	/**
	 * @var string
	 */
	private $account;

	/**
	 * @var \DateTime
	 */
	private $createdAt;

	/**
	 * @var \DateTime
	 */
	private $modifiedAt;


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
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Student
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set studentId
	 *
	 * @param string $studentId
	 *
	 * @return Student
	 */
	public function setStudentId($studentId)
	{
		$this->studentId = $studentId;

		return $this;
	}

	/**
	 * Get studentId
	 *
	 * @return string
	 */
	public function getStudentId()
	{
		return $this->studentId;
	}

	/**
	 * Set account
	 *
	 * @param string $account
	 *
	 * @return Student
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
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
	 *
	 * @return Student
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set modifiedAt
	 *
	 * @param \DateTime $modifiedAt
	 *
	 * @return Student
	 */
	public function setModifiedAt($modifiedAt)
	{
		$this->modifiedAt = $modifiedAt;

		return $this;
	}

	/**
	 * Get modifiedAt
	 *
	 * @return \DateTime
	 */
	public function getModifiedAt()
	{
		return $this->modifiedAt;
	}

	public function updateTimestamp()	{
		if ( ! $this->getCreatedAt() )
			$this->setCreatedAt( new \DateTime( date( 'Y-m-d H:i:s' ) ) );
		$this->setModifiedAt( new \DateTime( date( 'Y-m-d H:i:s' ) ) );
	}
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $submissions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->submissions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add submission
     *
     * @param \CSCI4140\WebhookBundle\Entity\Submission $submission
     *
     * @return Student
     */
    public function addSubmission(\CSCI4140\WebhookBundle\Entity\Submission $submission)
    {
        $this->submissions[] = $submission;

        return $this;
    }

    /**
     * Remove submission
     *
     * @param \CSCI4140\WebhookBundle\Entity\Submission $submission
     */
    public function removeSubmission(\CSCI4140\WebhookBundle\Entity\Submission $submission)
    {
        $this->submissions->removeElement($submission);
    }

    /**
     * Get submissions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubmissions()
    {
        return $this->submissions;
    }
}
