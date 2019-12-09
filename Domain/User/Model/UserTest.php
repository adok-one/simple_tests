<?php

namespace App\Tests\unitary\Domain\User\Model;

use App\Domain\User\Model\User;
use App\Tests\Core\TestCase;

final class UserTest extends TestCase
{
    public function testICanCreateAUserByProvidingAUsername(): void
    {
        $username = $this->faker->userName;
        $user = new User($username);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($username, $user->getUsername());
    }
}
