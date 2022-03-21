<?php

namespace iggyvolz\sstream;

use Stringable;
use UnexpectedValueException;
use ZEngine\ClassExtension\Hook\DoOperationHook;
use ZEngine\ClassExtension\ObjectCreateInterface;
use ZEngine\ClassExtension\ObjectCreateTrait;
use ZEngine\ClassExtension\ObjectDoOperationInterface;
use ZEngine\System\OpCode;

abstract class StringStream implements Stringable, ObjectCreateInterface, ObjectDoOperationInterface
{
    final public function __construct(public readonly string $contents = "") {}
    public abstract function append(string|Stringable $string): static;
    final public function __toString(): string
    {
        return $this->contents;
    }
    use ObjectCreateTrait;

    public static function __doOperation(DoOperationHook $hook)
    {
        $left = $hook->getFirst();
        $right = $hook->getSecond();
        if($hook->getOpcode() !== OpCode::SL) {
            throw new UnexpectedValueException("Invalid operation " . OpCode::name($hook->getOpcode()));
        }
        if(!$left instanceof self) {
            throw new UnexpectedValueException("Invalid left side type " . get_debug_type($left));
        }
        if(!($right instanceof Stringable) && !(is_string($right))) {
            throw new UnexpectedValueException("Invalid right side type " . get_debug_type($right));
        }
        return $left->append($right);
    }
}