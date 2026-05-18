<?php
declare(strict_types=1);
class IssuesModel{
    public function getProjectInfo(int $projectId,int $userId):array{
        $pdo=DB::getConnection();
        $pstmt = $pdo->prepare("SELECT * FROM projects WHERE id=:project");
        $pstmt -> bindValue(":project",$projectId);
        $pstmt -> execute();
        $project_info=$pstmt->fetch(PDO::FETCH_ASSOC);
        return $project_info?:[];
    }
    
    public function getIssues(int $projectId,int $userId):array{
        $pdo=DB::getConnection();
        $pstmt = $pdo->prepare("SELECT * FROM issues JOIN users ON issues.author_id=users.id WHERE project_id=:project and users.id=:user");
        $pstmt -> bindValue(":project",$projectId);
        $pstmt -> bindValue(":user",$userId);
        $pstmt->execute();
        $issues=$pstmt-> fetchAll(PDO::FETCH_ASSOC);
        return $issues?:[];
    }
    public function addIssue(int $projectId ,int $userId){
        $new_error=[
            "title"       => $_POST['title'] ?? '',
            "description" => $_POST['description'] ?? '',
            "date"        => date("d-m-Y"),
            "author"      => $_SESSION['user_id']??''
        ];

        $pdo=DB::getConnection();

        $pstmt_new_issue = $pdo->prepare("INSERT INTO issues(author_id,project_id,title,description) VALUES(:user,:project,:title,:descriere)");

        $pstmt_new_issue->bindValue(":user",$userId);
        $pstmt_new_issue->bindValue(":project",$projectId);
        $pstmt_new_issue->bindValue(":title",$new_error["title"]);
        $pstmt_new_issue->bindValue(":descriere",$new_error["description"]);
        $pstmt_new_issue->execute();
    }

    public function isUserInvolvedInProject(int $userId):bool{
        $pdo=DB::getConnection();
        $pstmtv = $pdo->prepare("SELECT * FROM users u JOIN teams t ON u.id=t.user_id WHERE u.id=:user_id");
        $pstmtv -> bindValue(":user_id",$userId);
        $pstmtv -> execute();
        $user_valid = $pstmtv -> fetch(PDO::FETCH_ASSOC);
        if($user_valid === false){
            return false;
        }
        return true;
    }

    public function getContributors(int $projectId){
        $pdo=DB::getConnection();
        $pstmt1 = $pdo->prepare("SELECT * FROM projects p JOIN teams t ON p.id=t.project_id JOIN users u ON u.id=t.user_id WHERE p.id=:project ");
        $pstmt1 -> bindValue(":project",$projectId);
        $pstmt1->execute();
        $contributors=$pstmt1->fetchAll(PDO::FETCH_ASSOC);
        return $contributors?:[];
    }
}