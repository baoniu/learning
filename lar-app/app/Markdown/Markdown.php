<?php
/**
 * Created by hare.
 * Email: 688977@qq.com
 * Date: 2017/2/11
 * Time: PM3:58
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    /**
     * Markdown constructor.
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text)
    {
        return $this->parser->makeHtml($text);
    }
}