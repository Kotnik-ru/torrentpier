<?php
/**
 * MIT License
 *
 * Copyright (c) 2005-2016 TorrentPier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

if (!defined('BB_ROOT')) {
    die(basename(__FILE__));
}

/** @var \TorrentPier\Di $di */
$di = \TorrentPier\Di::getInstance();

$smilies = [];

$rowset = DB()->fetch_rowset("SELECT * FROM " . BB_SMILIES);
sort($rowset);

foreach ($rowset as $smile) {
    $smilies['orig'][] = '#(?<=^|\W)' . preg_quote($smile['code'], '#') . '(?=$|\W)#';
    $smilies['repl'][] = ' <img class="smile" src="' . $di->config->get('smilies_path') . '/' . $smile['smile_url'] . '" alt="' . $smile['emoticon'] . '" align="absmiddle" border="0" />';
    $smilies['smile'][] = $smile;
}

$this->store('smile_replacements', $smilies);
