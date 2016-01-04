<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 - 2016 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\HistoryLog\ORM;

use CRM\ORM\Entity;

class Change extends Entity
{
    protected $id;
    protected $change;
    protected $field;
    protected $pre;
    protected $post;

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
     * Gets the value of change.
     *
     * @return mixed
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * Sets the value of change.
     *
     * @param mixed $change the change
     *
     * @return self
     */
    public function setChange($change)
    {
        $this->change = $change;

        return $this;
    }

    /**
     * Gets the value of field.
     *
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Sets the value of field.
     *
     * @param mixed $field the field
     *
     * @return self
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Gets the value of pre.
     *
     * @return mixed
     */
    public function getPre()
    {
        return $this->pre;
    }

    /**
     * Sets the value of pre.
     *
     * @param mixed $pre the pre
     *
     * @return self
     */
    public function setPre($pre)
    {
        $this->pre = $pre;

        return $this;
    }

    /**
     * Gets the value of post.
     *
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Sets the value of post.
     *
     * @param mixed $post the post
     *
     * @return self
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }
}
