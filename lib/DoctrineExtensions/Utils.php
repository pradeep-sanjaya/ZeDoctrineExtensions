<?php
namespace DoctrineExtensions;

/**
 * Get the Database custome DQL functions
 *
 * Get the name=>class of the custome DQL functions.
 *
 * @category    DoctrineExtensions
 * @package     DoctrineExtensions
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author      Pradeep Sanjaya <sanjayangpo@gmail.com>
 */

class Utils
{
    public static function getOracleDQLFunctions()
    {
        return array(
            'datetime_functions' => array(
                'Nvl' => 'DoctrineExtensions\Query\Oracle\Nvl',
                'Translate' => 'DoctrineExtensions\Query\Oracle\Translate',
                'ToDate' => 'DoctrineExtensions\Query\Oracle\ToDate',
                'TruncDate' => 'DoctrineExtensions\Query\Oracle\TruncDate',
            ),
            'string_functions' => array(),
            'numeric_functions' => array(
                'ToNumber' => 'DoctrineExtensions\Query\Oracle\ToNumber'
            ),
        );
    }
    
    public static function getMySQLDQLFunctions()
    {
        return array(
            'datetime_functions' => array(
                'Date' => 'DoctrineExtensions\Query\MySQL\Date',
                'SecToTime' => 'DoctrineExtensions\Query\MySQL\SecToTime',
                'TimeDiff' => 'DoctrineExtensions\Query\MySQL\TimeDiff',
                'TimeToSec' => 'DoctrineExtensions\Query\MySQL\TimeToSec',
                'StrToDate' => 'DoctrineExtensions\Query\MySQL\StrToDate',
                'Extract' => 'DoctrineExtensions\Query\MySQL\Extract',
            ),
            'string_functions' => array(
                'IfNull' => 'DoctrineExtensions\Query\MySQL\IfNull',
                'NullIf' => 'DoctrineExtensions\Query\MySQL\NullIf',
            ),
            'numeric_functions' => array(),
        );
    }
}
