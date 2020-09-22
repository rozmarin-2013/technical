<?php

namespace Task5;

use Task5\DB;

/**
 * Class Transctions
 * @package Task5
 */
class Transctions
{
    /**
     * @var \Task5\DB
     */
    private DB $db;

    /**
     * Transctions constructor.
     */
    public function __construct()
    {
        $this->db = new DB();
    }

    /**
     * @return array
     */
    public function query1(): array
    {
        $query = 'SELECT persons.fullname, 
            (IFNULL((SELECT sum(amount) FROM transactions where transactions.to_person_id=persons.id GROUP BY transactions.to_person_id), 0)
             - IFNULL((SELECT sum(amount) FROM transactions where transactions.from_person_id =persons.id GROUP BY transactions.from_person_id), 0))
             as sum 
             From persons';

        return $this->db->execute($query);
    }

    /**
     * @return array
     */
    public function query2(): array
    {
        $query = 'SELECT cities.name
            FROM cities
            INNER JOIN persons ON cities.id=persons.city_id
            INNER JOIN transactions ON transactions.from_person_id=persons.id
            LEFT JOIN transactions as tr1 ON tr1.to_person_id=persons.id
            GROUP BY persons.city_id
            HAVING count(persons.city_id) = (
                SELECT max(c1.count_cities)
                FROM (SELECT count(p1.city_id) as count_cities
                FROM persons p1 INNER JOIN transactions t1 ON t1.from_person_id=p1.id
                LEFT JOIN transactions as tr2 ON tr2.to_person_id=p1.id 
                GROUP BY p1.city_id
                ) c1)';
        return $this->db->execute($query);
    }

    /**
     * @return array
     */
    public function query3(): array
    {
        $query = 'SELECT c1.transaction_id, c1.from_person_id, c1.to_person_id, c1.amount, c1.city_id 
            FROM (SELECT t1.transaction_id, t1.from_person_id, t1.to_person_id, t1.amount, persons.city_id 
                FROM transactions t1 
                INNER JOIN persons ON t1.from_person_id=persons.id) as c1 
            INNER JOIN (SELECT t2.transaction_id, p2.city_id 
                FROM transactions t2 
                INNER JOIN persons p2 ON t2.to_person_id=p2.id) as c2 
                ON (c1.transaction_id = c2.transaction_id AND c1.city_id = c2.city_id)';

        return $this->db->execute($query);
    }
}