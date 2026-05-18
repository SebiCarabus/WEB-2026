<?php
declare(strict_types=1);
class ProjectsModel{
    public function getProjectsByUserId(int $userId):array{
        $pdo=DB::getConnection();
        $pstmt = $pdo->prepare("SELECT DISTINCT p.id, p.name FROM projects p JOIN teams t ON p.id = t.project_id WHERE t.user_id = :user_id");
        $pstmt->bindValue(":user_id", $userId);
        $pstmt->execute();
        $response=$pstmt->fetchAll(PDO::FETCH_ASSOC)?:[];
        return $response;
    }
}