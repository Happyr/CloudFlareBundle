<?php

namespace HappyR\UserProjectBundle\Tests\Factory;

use HappyR\UserProjectBundle\Factory\ProjectFactory;
use Mockery as m;

/**
 * Class ProjectFactoryTest
 *
 * @author Tobias Nyholm
 *
 */
class ProjectFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testMakePrivate()
    {
        $user=m::mock('HappyR\UserProjectBundle\Model\ProjectMemberInterface')
            ->shouldReceive('getId')->andReturn('4711')
            ->getMock();

        $project=m::mock('HappyR\UserProjectBundle\Entity\Project');
        $project
            ->shouldReceive('setName')->with('_private_4711')->andReturn($project)
            ->shouldReceive('setPublic')->with(false)->andReturn($project)
            ->shouldReceive('addUser')->with($user)->andReturn($project);

        $factory=new ProjectFactory(
            m::mock('Doctrine\Common\Persistence\ObjectManager'),
            m::mock('HappyR\UserProjectBundle\Manager\PermissionManager')
        );

        $factory->makePrivate($project, $user);
    }
}