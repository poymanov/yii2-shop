<?php

namespace shop\repositories;

use shop\entities\User\User;

class UserRepository
{
    public function findByUsernameOrEmail($value)
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function findByNetworkIdentity($network, $identity)
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

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

    public function remove(User $user)
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    private function getBy(array $condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('UserFixture not found.');
        }
        return $user;
    }

    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }
}