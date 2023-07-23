<?php
namespace test;
// include the library PHPUnit
use PHPUnit\Framework\TestCase;
// include the class User
require_once __DIR__ . '/../models/User.php';
// import the space of names
use app\models\User;

class UserTest extends TestCase
{
    public function testGetName() {
        // Create the object user for made the test
        $user = new User("John Doe", "john@example.com", "password123");
        // validate if method getName() return the correct name
        $this->assertEquals("John Doe", $user->getName());
    }
    public function testSetName() {
        // Create the object user for made the test
        $user = new User("John Doe", "john@example.com", "password123");
        // validate if the method setName() establish the name successfully
        $user->setName("John Gualteros");
        $this->assertEquals("John Gualteros", $user->getName());
    }
    public function testGetEmail() {
        // Create the object user for made the test
        $user = new User("John Doe", "john@example.com", "password123");
        // validate if method getEmail() return the correct email
        $this->assertEquals("john@example.com", $user->getEmail());
    }
    public function testSetEmail() {
        // Create the object user for made the test
        $user = new User("John Doe", "john@example.com", "password123");
        // validate if the method setEmail() establish the email successfully
        $user->setEmail("john.doe@example.com");
        $this->assertEquals("john.doe@example.com", $user->getEmail());
    }
    public function testGetPassword() {
        // Create the object user for made the test
        $user = new User("John Doe", "john@example.com", "password123");
        // validate if method getPassword() return the correct password
        $this->assertEquals("password123", $user->getPassword());
    }
    public function testSetPassword() {
        // Create the object user for made the test
        $user = new User("John Doe", "john@example.com", "password123");
        // validate if the method setPassword() establish the password successfully
        $user->setPassword("password1234");
        $this->assertEquals("password1234", $user->getPassword());
    }
}
