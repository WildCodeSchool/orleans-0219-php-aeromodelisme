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
 interval 30 DAY) AS date_exp  FROM ' . $this->table .
            ' HAVING event_date < date_exp and event_date >= curdate()')->fetchAll();
    }

    /**
     * @param array $event
     * @return bool
     */
    public function update(array $event): bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title, `event_date` = :event_date,
 `picture` = :picture, `description` = :description  WHERE `id` = :id");
        $statement->bindValue('id', $event['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $event['title'], \PDO::PARAM_STR);
        $statement->bindValue('event_date', $event['event_date']);
        $statement->bindValue('picture', $event['picture'], \PDO::PARAM_STR);
        $statement->bindValue('description', $event['description'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
