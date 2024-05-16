<?php

require_once __DIR__ . '/BaseDao.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("users");
    }

    public function add_user($user)
    {

        $stmt = $this->connection->prepare("INSERT INTO users (username, email, password, send_updates) VALUES (:username, :email, :password, :send_updates)");

        $stmt->bindParam(':username', $user['username']);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':password', $user['password']);
        $stmt->bindParam(':send_updates', $user['send_updates']);

        $stmt->execute();

        if ($stmt->errorInfo()[2]) {
            echo "Error: " . $stmt->errorInfo()[2];
        } else {
            echo "New record created successfully";
        }

        return $user;
    }


    public function login($user)
    {

        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->bindParam(':email', $user['email']);

        $stmt->execute();

        $dbUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dbUser) {
            if ($dbUser && password_verify($user['password'], $dbUser['password'])) {

                unset($dbUser['password']);

                $jwt_payload = [
                    'user' => $dbUser,
                    'iat' => time(),
                    'exp' => time() + (60 * 60 * 24 * 365) // valid for one year
                ];

                $token = JWT::encode(
                    $jwt_payload,
                    JWT_SECRET,
                    'HS256' 
                );

                Flight::json(
                    array_merge($dbUser, ['token' => $token])
                );

                /*session_start();
                $_SESSION['user_id'] = $dbUser['id'];
                $_SESSION['username'] = $dbUser['username'];
                $_SESSION['email'] = $dbUser['email'];
                $_SESSION['rank'] = $dbUser['rank'];
                $_SESSION['avatar'] = $dbUser['avatar'];*/
            } else {
                echo json_encode(['success' => false, 'message' => 'Password incorrect']);
                return null;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
            return null;
        }
    }

    public function get_user($userId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $stmt = $this->connection->prepare("SELECT * FROM submissions WHERE user_id = :id");
            $stmt->bindParam(':id', $userId);

            $stmt->execute();

            $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user['submissions'] = $submissions;

            return $user;
        } else {
            return null;
        }
    }
}
