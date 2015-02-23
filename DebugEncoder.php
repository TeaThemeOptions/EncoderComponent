<?php

namespace TeaTo\Component\Encoder;

final class DebugEncoder implements TokenEncoderInterface
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function encode($input)
    {
        return $input;
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function decode($input)
    {
        return $input;
    }

    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function isTokenValid($input)
    {
        return true;
    }
}
