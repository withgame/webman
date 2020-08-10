<?php
$pharname = "webman.phar";
$meta = [];
if (sizeof($argv) > 1) {
    foreach ($argv as $idx => $kv) {
        if ($idx == 0) {
            continue;
        }
        if (strpos($kv, '--') === false) {
            $pharname = $kv;
        } else {
            list($k, $v) = explode('=', str_replace('--', '', $kv));
            $meta[$k] = $v;
        }
    }
}
$phar = new Phar($pharname, 0, $pharname);
if (sizeof($meta) > 0) {
    $phar->setMetadata($meta);
}
$phar->buildFromDirectory(__DIR__, '/^((?!\.git)(?!\.idea).)*$/');
$ignore_files = ['build.php', 'extract.php', 'info.php', 'Makefile', 'workerman.log'];
foreach ($ignore_files as $file) {
    if (file_exists($file)) {
        $phar->delete($file);
    }
}
$defstub = Phar::createDefaultStub('index.php');
$phar->setStub("#!/usr/bin/env php\n$defstub");
