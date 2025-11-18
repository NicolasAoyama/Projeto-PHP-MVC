<?php 

namespace Alura\Mvc\Entity;

Class Video
{
    public readonly string $url;
    
    public function __construct(
        public readonly ?int $id,
        string $url, 
        public readonly string $title

        )
    {
        $this->setUrl($url);

    }
    public function setUrl(string $url){
        if (filter_var($url, FILTER_VALIDATE_URL) === false){
            header('Location: /');
            exit();
        }
        $this->url = $url;
    }
}