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
            if (strpos($kv, '=') >= 0) {
                list($k, $v) = explode('=', str_replace('--', '', $kv));
                $meta[$k] = $v;
            }
        }
    }
}
$phar = new Phar($pharname, 0, $pharname);
if (sizeof($meta) > 0) {
    $phar->setMetadata($meta);
}
$phar->buildFromDirectory(__DIR__, '/^((?!\.git).)*$/');
$phar->delete("build.php");
$defStub = Phar::createDefaultStub('start.php');
$phar->setStub("#!/usr/bin/env php\n$defStub");

