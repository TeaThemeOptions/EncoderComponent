<?php

namespace TeaTo\Component\Encoder;

final class TokenEncoder implements TokenEncoderInterface
{
    /**
     * @var int
     */
    protected $hashLifetime = 5;

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
     * @param mixed $input
     *
     * @return bool
     */
    public function isTokenValid($input)
    {
        if (!$input->headers->has('X-Token') || !$input->headers->has('X-Token-Date')) {
            return false;
        }

        $hash = base64_decode($input->headers->get('X-Token'));

        if (false === strpos($hash, '.')) {
            return false;
        }

        list($encodedTime,) = explode('.', $hash);
        $attemptDate = $input->headers->get('X-Token-Date');

        return $encodedTime == md5($attemptDate) && $attemptDate + $this->hashLifetime <= time();
    }
}
