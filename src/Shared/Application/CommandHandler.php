<?php

namespace Colors\Shared\Application;

Interface CommandHandler
{
    public function handle(Command $command): void;
}