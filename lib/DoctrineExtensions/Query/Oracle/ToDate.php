<?php
/**
 * DoctrineExtensions Oracle Function Pack
 * 
 * PHP version 5
 *
 * LICENSE:
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * 
 */

namespace DoctrineExtensions\Query\Oracle;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 * ToDate(date, fmt, nlsparam)
 *
 * TO_DATE converts char of CHAR, VARCHAR2, NCHAR, or NVARCHAR2 data type 
 * to a value of DATE data type.
 * More info:
 * http://docs.oracle.com/database/121/SQLRF/functions218.htm#SQLRF06132
 *
 * @category    DoctrineExtensions
 * @package     DoctrineExtensions\Query\Oracle
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author      Mohammad ZeinEddin <mohammad@zeineddin.name>
 */

class ToDate extends FunctionNode
{
    private $date;
    private $fmt = null;
    private $nlsparam = null;

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        $sql = 'TO_DATE(' . $this->date->dispatch($sqlWalker);
        // use second format parameter if parsed
        if (null !== $this->fmt) {
            $sql .= ',' . $this->fmt->dispatch($sqlWalker);
            
            // use third nlsparam parameter if parsed
            if (null !== $this->nlsparam) {
                $sql .= ',' . $this->nlsparam->dispatch($sqlWalker);
            }
        }
        $sql .= ')';
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $lexer = $parser->getLexer();
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->date = $parser->ArithmeticExpression();
        
        // parse second format parameter if available
        if (Lexer::T_COMMA === $lexer->lookahead['type']) {
            $parser->match(Lexer::T_COMMA);
            $this->fmt = $parser->ArithmeticPrimary();
            
            // parse third nlsparam parameter if available
            if (Lexer::T_COMMA === $lexer->lookahead['type']) {
                $parser->match(Lexer::T_COMMA);
                $this->nlsparam = $parser->ArithmeticPrimary();
            }
        }
        
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
