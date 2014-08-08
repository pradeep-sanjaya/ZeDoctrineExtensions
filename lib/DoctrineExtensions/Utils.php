<?php
/**
 * DoctrineExtensions Function Pack Map Utility
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

namespace DoctrineExtensions;

/**
 * Get the Database custome DQL functions
 *
 * Get the name=>class of the custome DQL functions.
 *
 * @category    DoctrineExtensions
 * @package     DoctrineExtensions
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author      Mohammad ZeinEddin <mohammad@zeineddin.name>
 */

class Utils
{
    public static function getOracleDQLFunctions()
    {
        return array(
            'Nvl' => 'DoctrineExtensions\Query\Oracle\Nvl'
            'ToDate' => 'DoctrineExtensions\Query\Oracle\ToDate'
            'TruncDate' => 'DoctrineExtensions\Query\Oracle\Trunc',
        );
    }
    
    public static function getMySQLDQLFunctions()
    {
        return array(
            'TimeDiff' => 'DoctrineExtensions\Query\Mysql\TimeDiff',
            'TimeToSec' => 'DoctrineExtensions\Query\Mysql\TimeToSec',
            'SecToTime' => 'DoctrineExtensions\Query\Mysql\SecToTime',
        );
    }
}
