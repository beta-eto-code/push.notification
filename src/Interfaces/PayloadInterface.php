<?php


namespace Push\Interfaces;


interface PayloadInterface
{
    /**
     * @param MessageInterface $message
     * @return array
     */
    public function toArray(MessageInterface $message): array;
}
