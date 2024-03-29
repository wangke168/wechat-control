<?php
/**
 * Created by PhpStorm.
 * User: thinpig
 * Date: 2022/4/22
 * Time: 16:23
 */

namespace App\WeChat;


class DES
{
    private $_key = '12345678';//输入密钥

    public function encrypt($string) {
        $ivArray = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF);
        $iv      = null;
        foreach ($ivArray as $element) {
            $iv.=CHR($element);
        }
        $size   = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
        $string = $this->pkcs5Pad($string, $size);
        $data   = mcrypt_encrypt(MCRYPT_DES, $this->_key, $string, MCRYPT_MODE_CBC, $iv);
        $data   = base64_encode($data);
        return $data;
    }

    public function decrypt($string) {
        $ivArray = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF);
        $iv      = null;
        foreach ($ivArray as $element) {
            $iv.=CHR($element);
        }
        $string = base64_decode($string);
        $result = mcrypt_decrypt(MCRYPT_DES, $this->_key, $string, MCRYPT_MODE_CBC, $iv);
        $result = $this->pkcs5Unpad($result);

        return $result;
    }

    private function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    private function pkcs5Unpad($text) {
        $pad = ord($text {strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, - 1 * $pad);
    }


}