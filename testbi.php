<?php
class Test {
    public function __construct(
        private int $a,
        private int $c,
        private ?string $b = null,
    ) {}
}
$t = new Test(1, 2);
