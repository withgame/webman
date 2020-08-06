<?php
foreach ($argv as $key => $value) {
    if ($key == 0) {
        continue;
    }
    switch ($value) {
        case '-v':
            try {
                $p = new Phar(dirname(__FILE__));
                foreach ($p->getMetadata() as $k => $v) {
                    echo "$k: $v\n";
                }
            } catch (Exception $e) {
            }
            exit(0);
        default:
            break;
    }
}
