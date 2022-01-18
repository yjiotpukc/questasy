<?php

declare(strict_types=1);

namespace Game\Presentation\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Game\Application\GameSeeder;
use Game\Domain\Entity\Player;
use Game\Domain\Entity\Quest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function startQuest(DocumentManager $dm, Request $request): Response
    {
        $questId = $request->get('quest_id');
        $player = $dm->find(Player::class, '61db07efdf36e1609145afd4');
        $walkthrough = $player->currentWalkthrough;
        $walkthrough->startQuest($questId);
        $dm->persist($walkthrough);
        $dm->flush();

        return $this->redirect('/game#last-stage');
    }

    public function progressQuest(DocumentManager $dm, Request $request): Response
    {
        $actionId = $request->get('action_id');
        $player = $dm->find(Player::class, '61db07efdf36e1609145afd4');
        $walkthrough = $player->currentWalkthrough;
        $walkthrough->progress($actionId);
        $dm->persist($walkthrough);
        $dm->flush();

        return $this->redirect('/game#last-stage');
    }

    public function finishQuest(DocumentManager $dm): Response
    {
        $player = $dm->find(Player::class, '61db07efdf36e1609145afd4');
        $walkthrough = $player->currentWalkthrough;
        $walkthrough->finishQuest();

        $possibleQuests = new ArrayCollection($dm->getRepository(Quest::class)->findAll());
        $walkthrough->updatePossibleQuests($possibleQuests);

        $dm->persist($walkthrough);
        $dm->flush();

        return $this->redirect('/game');
    }

    public function resetWalkthrough(GameSeeder $gameSeeder): Response
    {
        $gameSeeder->resetWalkthrough();

        return $this->redirect('/game');
    }

    public function resetShipQuest(GameSeeder $gameSeeder): Response
    {
        $gameSeeder->upsertShipQuest();

        return $this->redirect('/game');
    }
}
