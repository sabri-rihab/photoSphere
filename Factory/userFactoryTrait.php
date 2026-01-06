<?php
trait UserFactoryTrait
{
    public function createUserObject(array $user)
    {
        switch ($user['role']) {
            case 'Admin':
                return new Admin(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['isSuperAdmin']
                );

            case 'Moderator':
                return new Moderator(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['heirarchical_level']
                );

            case 'ProUser':
                return new ProUser(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['date_debut_abonnement'],
                    $user['date_fin_abonnement']
                );

            case 'BasicUser':
                return new BasicUser(
                    $user['username'],
                    $user['email'],
                    $user['password'],
                    $user['adresse'],
                    $user['bio'],
                    $user['uploadCount']
                );

            default:
                throw new \Exception("Unknown user role: {$user['role']}");
        }
    }
}