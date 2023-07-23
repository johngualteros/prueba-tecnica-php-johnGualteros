<?php
namespace app\usecases;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

use app\models\User;
use app\repository\UserRepository;

class SaveUserUseCase
{
    private $userRepository;
    private $file;

    public function __construct(UserRepository $userRepository, $file)
    {
        $this->userRepository = $userRepository;
        $this->file = $file;
    }
    public function execute($name, $email, $password)
    {
        $newUser = new User($name, $email, $password);
        $this->userRepository->save($newUser);
    }
}