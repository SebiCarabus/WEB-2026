<?php
declare(strict_types=1);

class UsersModel {

    public function verifyPassword(string $userName, string $pass): bool {
        $pdo = DB::getConnection();
        $pstmt = $pdo->prepare(
            "SELECT id FROM users WHERE user_name = :user_name AND password = :pass"
        );
        $pstmt->bindValue(":user_name", $userName);
        $pstmt->bindValue(":pass", $pass);
        $pstmt->execute();

        $userData = $pstmt->fetch(PDO::FETCH_ASSOC);

        return $userData !== false;
    }

    public function getUserId(string $user): ?int {
        $pdo = DB::getConnection();
        $pstmt = $pdo->prepare(
            "SELECT id FROM users WHERE user_name = :user_name"
        );
        $pstmt->bindValue(":user_name", $user);
        $pstmt->execute();

        $userData = $pstmt->fetch(PDO::FETCH_ASSOC);

        if ($userData === false) {
            return null;
        }

        return (int) $userData['id'];
    }
}