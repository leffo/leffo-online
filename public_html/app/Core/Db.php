<?php


namespace Telegram\Core;

use PDO;
use Telegram\Exception\DbException;


class Db
{
    /**
     * @var Db $instance
     */
    private static $instance;
    private PDO $pdo;

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
    // part of singleton (private constructor)
    private function __construct()
    {
        $dbOptions = (require '../../config/settings.php')['db'];

        try {
            $this->pdo = new PDO('mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']);

            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
    }

    public function query(string $sql, array $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll();
    }

    // simple singleton for Db call, without clone and copy
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}