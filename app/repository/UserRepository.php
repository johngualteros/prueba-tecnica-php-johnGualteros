<?php
namespace app\repository;
require_once __DIR__ . '/../models/User.php';
// import the space of names
use app\models\User;
class UserRepository
{
    public function __construct()
    {
    }
    public function save(User $user, $file)
    {
        $userData = implode(',', [$user->getName(), $user->getEmail(), $user->getPassword()]) . PHP_EOL;
        file_put_contents($file, $userData, FILE_APPEND);
    }
    public function getAll($file)
    {
        return file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    public function loadUsers($file)
    {
        $users = [];
        $fileContents = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($fileContents as $line) {
            list($name, $email, $password) = explode(',', $line);
            $users[] = new User($name, $email, $password);
        }
        return $users;
    }
    public function delete(User $user, $file)
    {
        $users = $this->loadUsers($file);
        $updatedUsers = array_filter($users, function ($existingUser) use ($user) {
            return $existingUser->getEmail() !== $user->getEmail();
        });
        $this->saveUsersToFile($updatedUsers, $file);
    }

    public function update(User $userToUpdate, User $updatedUser, $file)
    {
        $users = $this->loadUsers($file);
        foreach ($users as $key => $existingUser) {
            if ($existingUser->getEmail() === $userToUpdate->getEmail()) {
                $users[$key] = $updatedUser;
                break;
            }
        }
        $this->saveUsersToFile($users, $file);
    }

    private function saveUsersToFile(array $users, $file)
    {
        $userStrings = array_map(function ($user) {
            return implode(',', [$user->getName(), $user->getEmail(), $user->getPassword()]);
        }, $users);
        $userData = implode(PHP_EOL, $userStrings);
        file_put_contents($file, $userData);
    }
}