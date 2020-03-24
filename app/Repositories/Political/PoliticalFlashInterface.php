<?php

namespace App\Repositories\Political;

interface PoliticalFlashInterface
{
    public function __construct(array $options);

    public function hasHours();

    public function getHours();

    public function getDispositions();

    public function getAnswers();
}
