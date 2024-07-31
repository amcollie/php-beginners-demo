<?php

declare(strict_types=1);

namespace Core;

class Authenticator
{
    /**
     * Attempts to authenticate a user by email and password.
     *
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     * @return bool Returns true if the user is authenticated, false otherwise.
     */
    public function attempt(string $email, string $password): bool
    {
        $db = App::resolve(Database::class);
        $user = $db->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            if (Validator::password($password, $user['password'])) {
                $this->login($user);

                return true;
            }

        }

        return false;
    }

    /**
     * Logs in a user by generating a new session ID and storing the user's email in the session array.
     *
     * @param array $user An associative array containing the user's email.
     * @return void
     */
    public function login(array $user): void
    {
        session_regenerate_id(true);

        Session::put('user', [
            'id' => $user['id'],
            'email' => $user['email']
        ]);
    }

    /**
     * Logs out the user by destroying the session and removing the session cookie.
     *
     * @return void
     */
    public function logout(): void
    {
        Session::destroy();
    }
}