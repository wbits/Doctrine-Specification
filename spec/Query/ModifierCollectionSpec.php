<?php

namespace spec\Rb\DoctrineSpecification\Query;

use Doctrine\ORM\QueryBuilder;
use Rb\DoctrineSpecification\Exception\InvalidArgumentException;
use Rb\DoctrineSpecification\Query\ModifierInterface;
use Rb\DoctrineSpecification\Result;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModifierCollectionSpec extends ObjectBehavior
{
    public function it_should_call_modify_on_child_modifiers(
        ModifierInterface $modifierA,
        ModifierInterface $modifierB,
        QueryBuilder $queryBuilder
    ) {
        $dqlAlias = 'a';
        $this->beConstructedWith($modifierA, $modifierB);

        $modifierA->modify($queryBuilder, $dqlAlias)->shouldBeCalled();
        $modifierB->modify($queryBuilder, $dqlAlias)->shouldBeCalled();

        $this->modify($queryBuilder, $dqlAlias);
    }

    public function it_should_throw_exception_when_adding_incorrect_children(Result\ModifierInterface $resultModifier)
    {
        $this->shouldThrow(InvalidArgumentException::class)
            ->during('add', [$resultModifier]);
    }
}