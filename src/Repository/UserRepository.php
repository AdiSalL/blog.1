<?php
namespace Pc\Blogapp\Repository;

use Pc\Blogapp\Domain\User;

class UserRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection) {
        $this->connection = $connection;
    }

    public function save(User $user): User {
        $statement = $this->connection->prepare("INSERT INTO users (name, password, role) VALUES (?, ?, ?)");
        $statement->execute([
            $user->name, $user->password, $user->role
        ]);
        return $user;
    }

    public function findById(int $id): ?User {
        $statement = $this->connection->prepare("SELECT id, name, password, role FROM users WHERE id = ?");
        $statement->execute([$id]);

        if ($row = $statement->fetch()) {
            $user = new User();
            $user->id = $row["id"];
            $user->name = $row["name"];
            $user->password = $row["password"];
            $user->role = $row["role"];

            return $user;
        } else {
            return null;
        }
    }

    public function findByName(string $name): ?User {
        $statement = $this->connection->prepare("SELECT id, name, password, role FROM users WHERE name = ?");
        $statement->execute([$name]);

        if ($row = $statement->fetch()) {
            $user = new User();
            $user->id = $row["id"];
            $user->name = $row["name"];
            $user->password = $row["password"];
            $user->role = $row["role"];

            return $user;
        } else {
            return null;
        }
    }

    public function deleteAll():void {
        $statement = $this->connection->prepare("DELETE FROM users");
        $statement->execute();
    }
}
