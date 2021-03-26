<?php


namespace Push\Interfaces;


interface MessageOptionsInterface
{
    /**
     * @param MessageInterface $message
     * @return void
     */
    public function loadTo(MessageInterface $message);
}
