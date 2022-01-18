<?php

declare(strict_types=1);

namespace Game\Application;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Game\Domain\Entity\Player;
use Game\Domain\Entity\Quest;

class GameSeeder
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function resetWalkthrough(): void
    {
        $quest = $this->documentManager->find(Quest::class, '61e6185a0dba103d14fc4de3');
        $player = $this->documentManager->find(Player::class, '61db07efdf36e1609145afd4');
        if ($player->currentWalkthrough->currentQuest) {
            $player->currentWalkthrough->finishQuest();
        }
        $player->currentWalkthrough->updatePossibleQuests(new ArrayCollection([$quest]));
        $this->documentManager->persist($player);
        $this->documentManager->flush();
    }

    public function upsertShipQuest(): void
    {
        $this->documentManager
            ->createQueryBuilder(Quest::class)
            ->updateOne()
            ->upsert()
            ->setNewObj([
                "title" => "Шутки погоды",
                "description" => "Твоё первое дежурство на озере",
                "startingStageId" => "1",
                "stages" => [
                    [
                        "id" => "1",
                        "text" => "Кто-то скажет “Круто быть пограничником”, но с этим поспорит каждый, кому “посчастливилось” служить здесь. Хотя бы потому, что погоду здесь предсказать просто невозможно!С утра еще было солнце, но к полудню стало ясно, что грозы уже не миновать. Да и вообще, откуда она взялась в октябре!?..",
                        "effects" => [],
                        "actions" => ["1"]
                    ],
                    [
                        "id" => "2",
                        "text" => "Поежившись от усиливающегося ветра, ты поднимаешь голову к темному,  вдали сверкающему небу и первые тяжелые капли дождя разбиваются о твое лицо.",
                        "effects" => [],
                        "actions" => ["2"]
                    ],
                    [
                        "id" => "3",
                        "text" => "Ты невольно задумываешься о том, как повезло тем, кто сейчас сидит в казарме.\"Вот и дернул же меня черт играть с ними в карты! Мог бы сейчас…\"Из твоих размышлений тебя выдергивает оклик со стороны смотровой будки. Но из-за раскатов грома ты не можешь чётко разобрать слов.",
                        "effects" => [],
                        "actions" => ["3", "4", "5"]
                    ],
                    [
                        "id" => "4",
                        "text" => "\"Эй, рядовой! Иди-ка сюда!\"",
                        "effects" => [],
                        "actions" => ["6", "7"]
                    ],
                    [
                        "id" => "5",
                        "text" => "\"Ты новенький? Хотя, чего это я спрашиваю ? И так видно — новенький! К озеру без плаща лучше не соваться! Ну, что стоишь? Заходи! Посидим, выпьем чаю, чего интересного расскажу. Раз буря пришла, это надолго. Не бойся, в такую погоду сюда  все равно никто не рискнет сунуться.\"",
                        "effects" => [],
                        "actions" => ["8", "9", "10"]
                    ],
                    [
                        "id" => "6",
                        "text" => "\"Где же я их на всех вас найду-то? У меня один остался и то, пара заплат на нем!\nА вот чай у меня есть!\"",
                        "effects" => [],
                        "actions" => ["11", "12", "13", "14"]
                    ],
                    [
                        "id" => "7",
                        "text" => "\"Ладно уж! Старик сегодня добрый. Одолжу тебе этот несчастный плащ.\"",
                        "effects" => [],
                        "actions" => ["15"]
                    ],
                    [
                        "id" => "8",
                        "text" => "\"Ишь, какие ушлые пошли! Со стариком поболтать, так никто не хочет, а плащ каждому выдай.\"",
                        "effects" => [],
                        "actions" => ["11"]
                    ],
                    [
                        "id" => "9",
                        "text" => "\"Приятно иметь дело с вежливыми людьми. Держи плащ!\"",
                        "effects" => [
                            [
                                "amount" => -100,
                                "type" => "giveMoney"
                            ]
                        ],
                        "actions" => ["15"]
                    ],
                    [
                        "id" => "10",
                        "text" => "\"Проходи, садись. Здесь тесновато, но уютно. Знаешь, сколько я уже здесь на службе?\" — спрашивает Старый пока заваривает чай.",
                        "effects" => [],
                        "actions" => ["16"]
                    ],
                    [
                        "id" => "11",
                        "text" => "\"Уже 30 лет! А вы молодняк все с теми же ошибками! Ну, ладно-ладно, не сердись на старика, это я все так, к слову. А знаешь что поговаривают об этом озере?\"",
                        "effects" => [],
                        "actions" => ["17", "18", "19"]
                    ],
                    [
                        "id" => "12",
                        "text" => "\"Ну, как хочешь. Молодёжь сегодня совсем не слушает стариков.\" Вы сидите и пьёте чай в тишине.",
                        "effects" => [],
                        "actions" => ["20"]
                    ],
                    [
                        "id" => "13",
                        "text" => "\"Многое поговаривают об этих местах, но вот озеро… Это самое загадочное место здесь. И говорю я сейчас даже не про грозы в октябре или град в середине июля, я говорю про туман. Слышал про него?\"— Старый вдруг принял многозначительный вид.",
                        "effects" => [],
                        "actions" => ["21"]
                    ],
                    [
                        "id" => "14",
                        "text" => "\"Чаще к ночи, но кто-то утверждает, что видел его и днем, густой туман внезапно обволакивает озеро, как будто сахарную вату кто разбросал, зябко становится, как будто ведром ледяной воды тебя окатили, и разглядеть ничего в нем нельзя.\"",
                        "effects" => [],
                        "actions" => ["22"]
                    ],
                    [
                        "id" => "15",
                        "text" => "\"А потом пропадает так же внезапно, как и появляется. Поверь мне, зрелище это не для слабонервных. А кто и рискнул сунуться в этот туман, тот не вернулся.\"",
                        "effects" => [],
                        "actions" => ["23"]
                    ],
                    [
                        "id" => "16",
                        "text" => "\"Правда, помнится, один как-то смог выплыть, но объяснить ничего не смог, навсегда онемел и лишь мычал, бедолага.\" — Старый откидывается на спинку кресла,— \"Вот поэтому никто и не любит бывать здесь на посту, да и в другое время тут чаще всего безлюдно.\"",
                        "effects" => [],
                        "actions" => ["20"]
                    ],
                    [
                        "id" => "100",
                        "text" => "Ты промок. А потом заболел. Следующий день ты проведёшь в лазарете.",
                        "effects" => [],
                        "actions" => []
                    ],
                    [
                        "id" => "101",
                        "text" => "Эта ночь показалась тебе самой долгой за всю жизнь. Штормило так, что пару раз пришлось хватиться за фонарь, чтобы тебя не унесло. К счастью, всё позади.",
                        "effects" => [],
                        "actions" => []
                    ],
                    [
                        "id" => "102",
                        "text" => "Ты дождался конца дежурства в тепле и уюте. Пора возвращаться в казарму.",
                        "effects" => [],
                        "actions" => []
                    ]
                ],
                "actions" => [
                    [
                        "id" => "1",
                        "text" => "Посмотреть вверх",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "2",
                        "type" => "determined"
                    ],
                    [
                        "id" => "2",
                        "text" => "Подумать о сослуживцах",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "3",
                        "type" => "determined"
                    ],
                    [
                        "id" => "3",
                        "text" => "Крикнуть \"Что?\"",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "4",
                        "type" => "determined"
                    ],
                    [
                        "id" => "4",
                        "text" => "Подойти поближе",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "5",
                        "type" => "determined"
                    ],
                    [
                        "id" => "5",
                        "text" => "Сделать вид, что не слышал",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "100",
                        "type" => "determined"
                    ],
                    [
                        "id" => "6",
                        "text" => "Подойти",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "5",
                        "type" => "determined"
                    ],
                    [
                        "id" => "7",
                        "text" => "Отказаться",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "100",
                        "type" => "determined"
                    ],
                    [
                        "id" => "8",
                        "text" => "Согласиться",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "10",
                        "type" => "determined"
                    ],
                    [
                        "id" => "9",
                        "text" => "Отказаться",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "100",
                        "type" => "determined"
                    ],
                    [
                        "id" => "10",
                        "text" => "Попросить плащ",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "6",
                        "type" => "determined"
                    ],
                    [
                        "id" => "11",
                        "text" => "Вернуться на пост без плаща",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "100",
                        "type" => "determined"
                    ],
                    [
                        "id" => "12",
                        "text" => "Постараться уболтать",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "possibleStages" => [
                            [
                                "questStageId" => "7",
                                "possibility" => [
                                    "base" => 7,
                                    "type" => "simple"
                                ]
                            ],
                            [
                                "questStageId" => "8",
                                "possibility" => [
                                    "base" => 3,
                                    "type" => "simple"
                                ]
                            ]
                        ],
                        "type" => "random"
                    ],
                    [
                        "id" => "13",
                        "text" => "Предложить за плащ деньги",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "9",
                        "type" => "determined"
                    ],
                    [
                        "id" => "14",
                        "text" => "Согласиться выпить чаю",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "10",
                        "type" => "determined"
                    ],
                    [
                        "id" => "15",
                        "text" => "Вернуться на пост в плаще",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "101",
                        "type" => "determined"
                    ],
                    [
                        "id" => "16",
                        "text" => "Лет 20?",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "11",
                        "type" => "determined"
                    ],
                    [
                        "id" => "17",
                        "text" => "\"И о чем же судачат?\"",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "13",
                        "type" => "determined"
                    ],
                    [
                        "id" => "18",
                        "text" => "\"Кое-что слышал\"",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "13",
                        "type" => "determined"
                    ],
                    [
                        "id" => "19",
                        "text" => "\"Вот только не надо травить байки!\"",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "12",
                        "type" => "determined"
                    ],
                    [
                        "id" => "20",
                        "text" => "Дождаться конца дежурства",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "102",
                        "type" => "determined"
                    ],
                    [
                        "id" => "21",
                        "text" => "\"И что с этим туманом?\"",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "14",
                        "type" => "determined"
                    ],
                    [
                        "id" => "22",
                        "text" => "Слушать дальше",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "15",
                        "type" => "determined"
                    ],
                    [
                        "id" => "23",
                        "text" => "Слушать дальше",
                        "visibilityCondition" => null,
                        "availabilityCondition" => null,
                        "questStageId" => "16",
                        "type" => "determined"
                    ]
                ],
            ])->getQuery()->execute();
    }
}
