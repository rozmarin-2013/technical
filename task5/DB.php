<?php declare(strict_types=1);

namespace Task5;


/**
 * Class DB
 * @package Task5
 */
class DB
{
    /**
     * @var \PDO
     */
    public \PDO $pdo;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $settings = $this->getPDOSettings();
        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
    }

    /**
     * @return array
     */
    protected function getPDOSettings(): array
    {
        $config = include ROOTPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'Db.php';
        $result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];

        return $result;
    }

    /**
     * @param string $query
     * @param array|null $params
     * @return array
     */
    public function execute(string $query, array $params=null): array
    {
        if(is_null($params)){
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}