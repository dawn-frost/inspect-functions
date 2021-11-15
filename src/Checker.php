<?php

declare(strict_types=1);

namespace DawnFrost\Inspect;

class Checker
{
    /*
      * 验证标签：
      * <script> / <script type="text/javascript">
      * <script type="text/vbscript">
      * <?php
      * <xss.
      *
      * 验证函数：
      */
    public static function checkXSS(string $value): bool
    {
        $pattern1 = [
            '<\?', '<\\?php', '<script', '<xss', 'javascript:', 'mocha:', 'vbscript:', '\.php', '\.js', '\.sh', '\.cookie', '\.open', 'alert\(', 'eval\(', 'expression\(',
        ];
        $pattern2 = [
            'fscommand', 'onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onbegin', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragdrop', 'ondragstart', 'ondrop', 'onend', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhashchange', 'onhelp', 'oninput', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmediacomplete', 'onmediaerror', 'onmessage', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onoffline', 'ononline', 'onoutofsync', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onredo', 'onrepeat', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onresume', 'onreverse', 'onrowsenter', 'onrowexit', 'onrowdelete', 'onrowsinserted', 'onscroll', 'onseek', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onstorage', 'onsyncrestored', 'onsubmit', 'ontimeerror', 'ontrackchange', 'onundo', 'onunload', 'onurlflip', 'seeksegmenttime',
        ];

        foreach ($pattern1 as $p) {
            if (1 === preg_match('/'.$p.'/i', $value)) {
                return false;
            }
        }

        foreach ($pattern2 as $p) {
            if (1 === preg_match('/'.$p.'[=,\(]{1}/i', $value)) {
                return false;
            }
        }

        return true;
    }
}
