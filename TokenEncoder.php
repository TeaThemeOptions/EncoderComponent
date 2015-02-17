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

    /**
     * @param int $attempt
     * @param string $hash
     *
     * @return bool
     */
    public function isDateValid($attempt, $hash)
    {
        $encodedTime = base64_decode($hash);

        if (false === strpos($encodedTime, '.')) {
            return false;
        }

        list ($encodedTime,) = explode('.', $encodedTime);

        return $encodedTime == md5($attempt) && $attempt + 60 <= time();
    }
}
