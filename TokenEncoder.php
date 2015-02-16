<?php

namespace TeaTo\Component\Encoder;

final class TokenEncoder implements TokenEncoderInterface
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function encode($input)
    {
        $input = md5(time()) .'.'. base64_encode($input);

        return base64_encode($input);
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function decode($input)
    {
        $input = base64_decode($input);

        if (false === strpos($input, '.')) {
            throw new \RuntimeException('Invalid token');
        }

        list (,$input) = explode('.', $input);

        return base64_decode($input);
    }
}
