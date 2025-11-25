<?php 

namespace Alura\Mvc\Entity;

Class Video
{
    public readonly string $url;
    private ?string $filePath = null;
    public function __construct(
        public readonly ?int $id,
        string $url, 
        public readonly string $title,
        ?string $filePath = null
        )
    {
        $this->setUrl($url);
        $this->filePath = $filePath;

    }
    public function setUrl(string $url){
        if (filter_var($url, FILTER_VALIDATE_URL) === false){
            header('Location: /');
            exit();
        }
        $this->url = $url;
    }
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }
    public function getFilePath(): ?string
    {
        return $this->filePath;
    }
}