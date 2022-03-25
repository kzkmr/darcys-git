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

class DateFormat extends FunctionNode
{
    protected $string;
    protected $format;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->string = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA); // (5)
        $this->format = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        switch ($sqlWalker->getConnection()->getDriver()->getName()) {
            case 'pdo_pgsql':
                $sql = sprintf("DATE_FORMAT(%s, %s)", $this->string->dispatch($sqlWalker), $this->format->dispatch($sqlWalker));
                break;
            case 'pdo_mysql':
                $sql = sprintf('DATE_FORMAT(%s, %s)', $this->string->dispatch($sqlWalker), $this->format->dispatch($sqlWalker));
                break;
            default:
                $sql = sprintf('DATE_FORMAT(%s, %s)', $this->string->dispatch($sqlWalker), $this->format->dispatch($sqlWalker));
                break;
        }

        return $sql;
    }
}
