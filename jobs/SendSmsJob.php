<?php

namespace app\jobs;

use app\models\Book;
use app\models\Subscription;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\queue\JobInterface;

class SendSmsJob extends BaseObject implements JobInterface
{
    public Book $book;

    /**
     * @throws InvalidConfigException
     */
    public function execute($queue):void
    {
        $book = $this->book;

        foreach ($book->getAuthors()->all() as $author) {
            $subscriptions = Subscription::find()->where(['author_id' => $author->id])->all();

            foreach ($subscriptions as $subscription) {
                $phone = $subscription->phone; // номер телефона в международном формате
                $text = "Вышла новая книга: $book->title, от автора: $author->name"; // текст сообщения
                $sender = 'INFORM'; //  имя отправителя из списка https://smspilot.ru/my-sender.php
// !!! Замените API-ключ на свой https://smspilot.ru/my-settings.php
                $apikey = '';//env

                $url = 'https://smspilot.ru/api.php'
                    .'?send='.urlencode( $text )
                    .'&to='.urlencode( $phone )
                    .'&from='.$sender
                    .'&apikey='.$apikey
                    .'&format=json';

                file_get_contents( $url );
            }
        }
    }
}