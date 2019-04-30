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
class EventManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'events';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * Select events for next 30 days
     * @return array
     */
    public function selectEvents(): array
    {
        return $this->pdo->query('SELECT * ,date_format(event_date, \'%d/%m/%Y\') AS date,date_add(curdate(),
 interval 30 DAY) AS date_exp  FROM ' . $this->table . ' HAVING event_date < date_exp and event_date >= curdate()')->fetchAll();
    }
}
