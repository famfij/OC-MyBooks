<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 01/11/2015
 * Time: 00:07
 */

namespace MyBooks\DAO;

use MyBooks\Domain\Author;

class AuthorDAO extends DAO
{
    /**
     * @param int $id
     * @return Author
     * @throws
     */
    public function find($id)
    {
        $sql = "SELECT * FROM author WHERE auth_id=?";
        $row = $this->getdb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No Author matching id ".$id);
        }
    }

    /**
     * Builds a domain object from a DB row.
     * Must be overridden by child classes.
     */
    protected function buildDomainObject($row)
    {
        $author = new Author();
        $author->setId($row['auth_id']);
        $author->setFirstName($row['auth_first_name']);
        $author->setLastName($row['auth_last_name']);

        return $author;
    }
}