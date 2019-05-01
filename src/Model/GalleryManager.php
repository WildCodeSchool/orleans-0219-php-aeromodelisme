<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class GalleryManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'gallery';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function randomPicture(): array
    {
        return $this->pdo->query("SELECT * FROM $this->table ORDER BY RAND() LIMIT 1")->fetch();
    }

    public function gallery2018(): array
    {
        return $this->pdo->query("SELECT * FROM $this->table WHERE year = 2018")->fetchAll();
    }

    public function gallery2017(): array
    {
        return $this->pdo->query("SELECT * FROM $this->table WHERE year = 2017")->fetchAll();
    }

    public function selectByYear(int $year)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE year=:year");
        $statement->bindValue('year', $year, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectAllYears() :array
    {
        return $this->pdo->query("SELECT year FROM $this->table GROUP BY year")->fetchAll();
    }
}
