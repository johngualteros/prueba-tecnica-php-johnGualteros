<?php
namespace app\repository;
require_once __DIR__ . '/../models/User.php';
// import the space of names
use app\models\User;
class UserRepository
{
    private $file;
    public function __construct($file)
    {
        $this->file = $file;
    }
    public function save(User $user)
    {
        $userData = implode(',', [$user->getName(), $user->getEmail(), $user->getPassword()]) . PHP_EOL;
        file_put_contents($this->file, $userData, FILE_APPEND);
    }
    public function getAll()
    {
        return file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    public function loadUsers()
    {
        $users = [];
        $fileContents = file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($fileContents as $line) {
            list($name, $email, $password) = explode(',', $line);
            $users[] = new User($name, $email, $password);
        }
        return $users;
    }
    public function delete(User $user)
    {
        $users = $this->loadUsers();
        $updatedUsers = array_filter($users, function ($existingUser) use ($user) {
            return $existingUser->getEmail() !== $user->getEmail();
        });
        $this->saveUsersToFile($updatedUsers);
    }

    public function update(User $userToUpdate, User $updatedUser)
    {
        $users = $this->loadUsers();
        foreach ($users as $key => $existingUser) {
            if ($existingUser->getEmail() === $userToUpdate->getEmail()) {
                $users[$key] = $updatedUser;
                break;
            }
        }
        $this->saveUsersToFile($users);
    }

    private function saveUsersToFile(array $users)
    {
        $userStrings = array_map(function ($user) {
            return implode(',', [$user->getName(), $user->getEmail(), $user->getPassword()]);
        }, $users);
        $userData = implode(PHP_EOL, $userStrings);
        file_put_contents($this->file, $userData);
    }
}