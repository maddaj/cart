<?php

interface IStorage
{
    function connect(): void;

    function saveCommands(Command $command): void;

    function loadCommands(): array;
}
