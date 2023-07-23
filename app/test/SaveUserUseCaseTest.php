<?php
namespace test;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../usecases/SaveUserUseCase.php';

use app\models\User;
use app\repository\UserRepository;
use app\usecases\SaveUserUseCase;

class SaveUserUseCaseTest extends TestCase
{
    public function testSaveUser()
    {
        $userRepository = new UserRepository();
        $filePath = __DIR__ . '/../db/table_users.txt';
        // Create the instance of SaveUserCase, passing the userRepository and filepath
        $saveUserUseCase = new SaveUserUseCase($userRepository, $filePath);
        // Execute of case use
        $saveUserUseCase->execute('John Gualteros', 'test@gmail.com', 'password');
        $fileContents = file_get_contents($filePath);
        $this->assertNotNull($fileContents);
    }
}