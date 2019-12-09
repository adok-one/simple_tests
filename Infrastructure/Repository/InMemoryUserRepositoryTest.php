<?php

namespace App\Tests\unitary\Infrastructure\Repository;

use App\Domain\User\Model\User;
use App\Infrastructure\Repository\InMemoryUserRepository;
use App\Tests\Core\Factory\UserModelFactory;
use App\Tests\Core\TestCase;

final class InMemoryUserRepositoryTest extends TestCase
{
    public function testRepositoryIsEmptyByDefault(): void
    {
        $repository = InMemoryUserRepository::getRepository(true);

        $this->assertEquals([], $repository->findAll());
    }

    public function testICanSaveAUser(): void
    {
        $repository = InMemoryUserRepository::getRepository(true);
        $user = UserModelFactory::getInstance()->create();

        $repository->save($user);

        $this->assertContains($user, $repository->findAll());
    }

    public function testICanRetrieveAUserByHisUsername(): void
    {
        $repository = InMemoryUserRepository::getRepository(true);

        $usernameToFind = $this->faker->userName;

        $repository->save(UserModelFactory::getInstance()->create());
        $repository->save(UserModelFactory::getInstance()->create());
        $repository->save(UserModelFactory::getInstance()->create());
        $repository->save(UserModelFactory::getInstance()->create([
            'username' => $usernameToFind,
        ]));

        $this->assertInstanceOf(User::class, $repository->findByUsername($usernameToFind));
    }

    public function testICanNotRetrieveAUserByHisUsernameIfHeDoesntExists(): void
    {
        $repository = InMemoryUserRepository::getRepository(true);

        $repository->save(UserModelFactory::getInstance()->create([
            'username' => 'seb',
        ]));

        $this->assertNull($repository->findByUsername('damien'));
    }
}
