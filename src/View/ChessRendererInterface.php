<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\View;

interface ChessRendererInterface
{
    function render(array $positions): string;
}