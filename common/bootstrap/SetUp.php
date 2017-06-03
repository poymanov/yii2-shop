<?php

namespace common\bootstrap;

use yii\base\BootstrapInterface;
use frontend\services\auth\UserPasswordResetService;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(UserPasswordResetService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
        ]);
    }
}