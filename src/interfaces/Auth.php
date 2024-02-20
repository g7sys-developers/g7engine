<?php

namespace G7Engine\interfaces;

interface Auth
{
    public function getPassword();
    public function getUsername();
    public function getBuilder();
}