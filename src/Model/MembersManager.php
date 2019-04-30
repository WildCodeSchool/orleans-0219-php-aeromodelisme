<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 17/04/19
 * Time: 11:00
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class MembersManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'members';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


}
