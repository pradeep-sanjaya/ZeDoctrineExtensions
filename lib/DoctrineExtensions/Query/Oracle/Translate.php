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
 * Translate(expr, from_string, to_string)
 *
 * TRANSLATE returns expr with all occurrences of each character in from_string 
 * replaced by its corresponding character in to_string. 
 * More info:
 * http://docs.oracle.com/database/121/SQLRF/functions231.htm#SQLRF06145
 *
 * @category    DoctrineExtensions
 * @package     DoctrineExtensions\Query\Oracle
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author      Pradeep Sanjaya <sanjayangp@gmail.com>
 */

class Translate extends FunctionNode
{
    private $expr;
    private $fromString;
    private $toString;

    /**
     * {@inheritDoc}
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return sprintf(
            'TRANSLATE(%s, %s, %s)',
            $sqlWalker->walkArithmeticPrimary($this->expr),
            $sqlWalker->walkArithmeticPrimary($this->fromString),
            $sqlWalker->walkArithmeticPrimary($this->toString)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->expr = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->fromString = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->toString = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
