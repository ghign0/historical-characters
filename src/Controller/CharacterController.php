<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use App\Reposiotry\CharacterRepository;

class CharacterController extends SymfonyController
{

    /**
     * carica il CharacterRepository
     *
     * @return CharacterRepository
     */
    private function getRepository() : CharacterRepository
    {
        $dispatcher = $this->get('event_dispatcher');
        return  new CharacterRepository($dispatcher);
    }


    /**
     * @param null $param
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function list($param = null)
    {
        $map = [
            '' => 'all',
            'all'   => 'all',
            'century' => 'century',
            'year' => 'year',
            'born-today' => 'anniversary'
        ];
        if(null === $param) {
            $characterRepository = $this->getRepository();
            $chars = $characterRepository->getCharacters('all',[]);
            return $this->render('@template/characters/list.html.twig', [
                'chars' => $chars
            ]);
        }
        if (!in_array($param, $map)) {
            return $this->redirectToRoute('list-not-found-error' );
        }
        $characterRepository = $this->getRepository();
        $chars = $characterRepository->getCharacters($map[$param],[]);
        return $this->render('@template/characters/list.html.twig', [
            'chars' => $chars
        ]);
    }

    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function detail($slug)
    {
        $characterRepository = $this->getRepository();
        if ( !in_array($slug,$characterRepository->getCharactersNameList())) {
            return $this->redirectToRoute('404');
        }

        $character = $characterRepository->getCharacterByFilename($slug);

        return $this->render('@template/characters/detail.html.twig', [
            'character' => $character
        ]);
    }
}
