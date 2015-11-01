<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 01/11/2015
 * Time: 00:22
 */

namespace MyBooks\DAO;

use MyBooks\Domain\Author;
use MyBooks\Domain\Book;

class BookDAO extends DAO
{
    /**
     * @var AuthorDAO
     */
    protected $authorDAO;

    /**
     * @param AuthorDAO $authorDAO
     */
    public function setAuthorDAO(AuthorDAO $authorDAO)
    {
        $this->authorDAO = $authorDAO;
    }

    /**
     * @param int $id
     * @return Book
     * @throws
     */
    public function find($id)
    {
        $sql = "SELECT * FROM book WHERE book_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No Book matching id ".$id);
        }
    }

    /**
     * @return array  of books
     */
    public function findAll()
    {
        $sql = "SELECT * FROM book ORDER BY book_id DESC";
        $rows = $this->getDb()->fetchAll($sql);

        $books = array();
        foreach($rows as $row) {
            $books[] = $this->buildDomainObject($row);
        }
        return $books;
    }

    /**
     * Builds a domain object from a DB row.
     * Must be overridden by child classes.
     */
    protected function buildDomainObject($row)
    {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);
        $book->setAuthor($this->authorDAO->find($row['auth_id']));
        return $book;
    }
}