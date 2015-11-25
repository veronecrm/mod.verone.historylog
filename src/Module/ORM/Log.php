<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\HistoryLog\ORM;

use CRM\ORM\Entity;

class Log extends Entity
{
  protected $id;
  protected $authorId;
  protected $authorName;
  protected $entityId;
  protected $entityName;
  protected $date;
  protected $object;
  protected $status;
  protected $module;

  /**
   * Gets the value of id.
   *
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Sets the value of id.
   *
   * @param mixed $id the id
   *
   * @return self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Gets the value of authorId.
   *
   * @return mixed
   */
  public function getAuthorId()
  {
    return $this->authorId;
  }

  /**
   * Sets the value of authorId.
   *
   * @param mixed $authorId the author id
   *
   * @return self
   */
  public function setAuthorId($authorId)
  {
    $this->authorId = $authorId;

    return $this;
  }

  /**
   * Gets the value of authorName.
   *
   * @return mixed
   */
  public function getAuthorName()
  {
    return $this->authorName;
  }

  /**
   * Sets the value of authorName.
   *
   * @param mixed $authorName the author name
   *
   * @return self
   */
  public function setAuthorName($authorName)
  {
    $this->authorName = $authorName;

    return $this;
  }

  /**
   * Gets the value of entityId.
   *
   * @return mixed
   */
  public function getEntityId()
  {
    return $this->entityId;
  }

  /**
   * Sets the value of entityId.
   *
   * @param mixed $entityId the entity id
   *
   * @return self
   */
  public function setEntityId($entityId)
  {
    $this->entityId = $entityId;

    return $this;
  }

  /**
   * Gets the value of entityName.
   *
   * @return mixed
   */
  public function getEntityName()
  {
    return $this->entityName;
  }

  /**
   * Sets the value of entityName.
   *
   * @param mixed $entityName the entity name
   *
   * @return self
   */
  public function setEntityName($entityName)
  {
    $this->entityName = $entityName;

    return $this;
  }

  /**
   * Gets the value of date.
   *
   * @return mixed
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * Sets the value of date.
   *
   * @param mixed $date the date
   *
   * @return self
   */
  public function setDate($date)
  {
    $this->date = $date;

    return $this;
  }

  /**
   * Gets the value of object.
   *
   * @return mixed
   */
  public function getObject()
  {
    return $this->object;
  }

  /**
   * Sets the value of object.
   *
   * @param mixed $object the object
   *
   * @return self
   */
  public function setObject($object)
  {
    $this->object = $object;

    return $this;
  }

  /**
   * Gets the value of status.
   *
   * @return mixed
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Sets the value of status.
   *
   * @param mixed $status the status
   *
   * @return self
   */
  public function setStatus($status)
  {
    $this->status = $status;

    return $this;
  }

  /**
   * Gets the value of module.
   *
   * @return mixed
   */
  public function getModule()
  {
    return $this->module;
  }

  /**
   * Sets the value of module.
   *
   * @param mixed $module the module
   *
   * @return self
   */
  public function setModule($module)
  {
    $this->module = $module;

    return $this;
  }
}
