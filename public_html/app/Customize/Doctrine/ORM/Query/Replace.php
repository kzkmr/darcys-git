<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Doctrine\ORM\Query;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Replace extends FunctionNode
{
    protected $string;
    protected $find_string;
    protected $replace_with;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->string = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA); // (5)
        $this->find_string = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA); // (7)
        $this->replace_with = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        switch ($sqlWalker->getConnection()->getDriver()->getName()) {
            case 'pdo_pgsql':
                $sql = sprintf("REPLACE(%s, %s, %s)", $this->string->dispatch($sqlWalker), $this->find_string->dispatch($sqlWalker), $this->replace_with->dispatch($sqlWalker));
                break;
            case 'pdo_mysql':
                $sql = sprintf('REPLACE(%s, %s, %s)', $this->string->dispatch($sqlWalker), $this->find_string->dispatch($sqlWalker), $this->replace_with->dispatch($sqlWalker));
                break;
            default:
                $sql = sprintf('REPLACE(%s, %s, %s)', $this->string->dispatch($sqlWalker), $this->find_string->dispatch($sqlWalker), $this->replace_with->dispatch($sqlWalker));
                break;
        }

        return $sql;
    }
}
