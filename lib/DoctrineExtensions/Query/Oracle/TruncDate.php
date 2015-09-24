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
 * TruncDate(date, fmt)
 *
 * The TRUNC (date) function returns date with the time portion of the day 
 * truncated to the unit specified by the format model fmt.
 * More info:
 * http://docs.oracle.com/database/121/SQLRF/functions235.htm#SQLRF06151
 *
 * @category    DoctrineExtensions
 * @package     DoctrineExtensions\Query\Oracle
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author      Pradeep Sanjaya <sanjayangp@gmail.com>
 */

class TruncDate extends FunctionNode
{
    private $date;
    private $fmt = null;

    /**
     * {@inheritDoc}
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        $sql = 'TRUNC(' . $this->date->dispatch($sqlWalker);
        // use second format parameter if parsed
        if (null !== $this->fmt) {
            $sql .= ',' . $this->fmt->dispatch($sqlWalker);
        }
        $sql .= ')';
        
        return $sql;
    }

    /**
     * {@inheritDoc}
     */
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
        }
        
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
