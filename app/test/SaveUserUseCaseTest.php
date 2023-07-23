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
        // Create the mock of UserRepository
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        // Define of behavior waited for UserRepository
        $userRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(User::class));
        // Create the instance of SaveUserCase, passing the UserRepository mock
        $saveUserUseCase = new SaveUserUseCase($userRepositoryMock);
        $saveUserUseCase->execute('Nombre del Usuario', 'correo@example.com', 'contraseña');
    }
}