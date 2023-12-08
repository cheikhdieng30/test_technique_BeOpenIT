<?php

namespace App\Controller;

use App\Service\GitHubService;
use App\Form\SearchUserFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function searchPage(Request $request, GitHubService $gitHubService)
    {
        $form = $this->createForm(SearchUserFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->getData()['username'];

            $userInfo = $gitHubService->getUserInfo($username);
            if (!empty($userInfo)) {
                return $this->render('home/user.html.twig', [
                    'userInfo' => $userInfo
                ]);
            } else {
                return $this->render('home/index.html.twig', [
                    'erreur' => "Cette utilisateur n'existe pas sur Github",
                    'form' => $form->createView(),
                ]);
            }
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'erreur' => "",
        ]);
    }
}
