<?php

namespace App\Tests\unitary\Infrastructure\Repository;

use App\Infrastructure\Repository\InMemoryUserRepository;
use App\Tests\Core\Factory\UserModelFactory;
use App\Tests\Core\TestCase;

final class AnyInMemoryUsingSingletonTraitTest extends TestCase
{
    public function testForcingNewRepositoryCreationReallyCreatesANewOne(): void
    {
        $repository = InMemoryUserRepository::getRepository(true);
        $repository->save(UserModelFactory::getInstance()->create());

        $repository = InMemoryUserRepository::getRepository(true);

        $this->assertCount(0, $repository->findAll());
    }

    public function testNotForcingNewRepositoryWillReturnCurrentlyExistingRepository(): void
    {
        $repository = InMemoryUserRepository::getRepository(true);
        $repository->save(UserModelFactory::getInstance()->create());

        $repository = InMemoryUserRepository::getRepository();

        $this->assertCount(1, $repository->findAll());
    }
}
