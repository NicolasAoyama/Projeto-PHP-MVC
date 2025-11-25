<?php 

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepository{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function formarObjeto(array $video): Video{
        return new Video(
            $video['id'],
            $video['url'],
            $video['title'],
            $video['image_path']
            
        );
    }
    public function addVideo(Video $video): bool{
        $sql1 = "INSERT INTO videos (url, title, image_path) VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql1);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);
        $statement->bindValue(3, $video->getFilePath());
        return $statement->execute();
    
    }
    public function removeVideo(int $id): bool{
        $sql = "DELETE FROM videos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        return $statement->execute();
    }
    public function editVideo(Video $video): bool{
        $sql = "UPDATE videos SET url = :url, title = :title, image_path = :image_path WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
       $statement->bindValue(':id', $video->id); 
       $statement->bindValue(':image_path', $video->getFilePath()); 
        return $statement->execute();
    }
    public function listaVideos(): array{
        
        $sql = "SELECT * FROM videos";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $listaObjetos = $statement->fetchAll(PDO::FETCH_ASSOC);
        $listaVideos = [];

        foreach($listaObjetos as $video){
            $listaVideos[] = $this->formarObjeto($video);
        }

        return $listaVideos;
    }
    public function getID($id): array{
        $sql = "SELECT * FROM videos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        return $videoEditado = $statement->fetch(PDO::FETCH_ASSOC);
    }
}
