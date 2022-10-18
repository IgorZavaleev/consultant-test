<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Model;

interface ChessPositionBuilderInterface
{
    public function addChessPieceLocation(ChessPieceLocation $location): self;
    public function build(): ChessPosition;
}