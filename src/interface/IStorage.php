<?php

interface IStorage
{
    function connect(): void;

    function saveCommands(array $command): void;

    function loadCommands(): array;
}
