<?php
/**
 * Tea and Code Doctrine Extensions Bundle
 *
 * PHP version 5
 * 
 * @category Bundle
 * @package  TeaAndCodeDoctrineExtensionsBundle
 * @version  1.0
 * @author   Dave Nash <dave.nash@teaandcode.com>
 * @license  Apache License, Version 2.0
 * @link     http://www.teaandcode.com
 */

namespace TeaAndCode\DoctrineExtensions\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Sin extends FunctionNode
{
    public $arithmeticExpression;

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'SIN(' .
                $sqlWalker->walkSimpleArithmeticExpression(
                    $this->arithmeticExpression
                ) .
            ')';
    }

    public function parse(Parser $parser)
    {
        $lexer = $parser->getLexer();

        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->arithmeticExpression = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}