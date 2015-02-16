<?php

namespace TeaTo\Component\Encoder;

interface TokenEncoderInterface
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function encode($input);

    /**
     * @param string $input
     *
     * @return string
     */
    public function decode($input);
}