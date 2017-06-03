<?php

namespace common\bootstrap;

use yii\base\BootstrapInterface;
use frontend\services\auth\PasswordResetService;
use frontend\services\contact\ContactService;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(PasswordResetService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
        ]);

        $container->setSingleton(ContactService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
            $app->params['adminEmail']
        ]);
    }
}