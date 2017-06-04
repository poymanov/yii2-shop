<?php

namespace common\repositories;

use common\entities\User;

class UserRepository
{
    public function getByEmailConfirmToken($token)
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    public function getByEmail($email)
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPasswordResetToken($token)
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken($token)
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function save(User $user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    private function getBy(array $condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}