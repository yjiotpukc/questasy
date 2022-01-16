<?php

declare(strict_types=1);

namespace Game\Presentation\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Game\Application\GameSeeder;
use Game\Domain\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GameController extends AbstractController
{
    public function questProgress(DocumentManager $dm): Response
    {
        $player = $dm->find(Player::class, '61db07efdf36e1609145afd4');
        $walkthrough = $player->currentWalkthrough;

        if ($walkthrough->currentQuest === null) {
            $view = 'game/hub.html.twig';
        } else {
            $view = 'game/quest.html.twig';
        }

        return $this->render($view, compact('walkthrough'));
    }

    public function resetWalkthrough(GameSeeder $gameSeeder): Response
    {
        $gameSeeder->resetWalkthrough();

        return $this->redirect('/game');
    }
}
