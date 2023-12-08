<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GitHubService
{
    private $httpClient;
    
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getUserInfo(string $username): array
    {
        $apiKey = $_ENV['GITHUB_API_KEY']; // Récupérez la clé d'API depuis les variables d'environnement
        $response = $this->httpClient->request('GET', 'https://api.github.com/users/'.$username, [
            'headers' => [
                'Authorization' => "token $apiKey",
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            
            return $response->toArray();
        } else {
            // Gérer les erreurs ici, par exemple renvoyer un tableau vide ou un message d'erreur
            return [];
        }
    }
}
