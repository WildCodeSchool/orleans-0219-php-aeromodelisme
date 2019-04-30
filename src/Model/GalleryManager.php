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
}
