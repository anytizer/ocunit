<?php

namespace cases\core;

use Opencart\System\Library\Encryption;
use PHPUnit\Framework\TestCase;

require_once DIR_OPENCART."system/library/encryption.php";

class EncryptionTest extends TestCase
{
    public function testEncrypt()
    {
        $message = "something";
        $key = "9acd35f146d93542c062e73697564373f0eac52ebfb8556b79339d9f3fbb518c32f9a72ab4226a495c2a6aa0f4508a7f8662d1d8fc7d5cfba81a89294556ba10338771247914482be7ce08e4c196af019802a8b69874a82f50863c7f89f64dcc84ace1d9f59f2face8c5c4ed67d2939ebe86756e6fe4f1fbeb7bf3189d195883";

        $c = new Encryption();

        $cipher = $c->encrypt($key, $message);
        $plain = $c->decrypt($key, $cipher);

        $this->assertEquals($message, $plain);
        $this->assertNotEquals($message, $cipher);
    }
}
