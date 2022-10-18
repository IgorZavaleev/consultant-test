<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Model;

class ChessPosition
{
    private array $chessPieceLocations;

    public function __construct(array $chessPieceLocations)
    {
        foreach ($chessPieceLocations as $location) {
            if (!$location instanceof ChessPieceLocation) {
                throw new \InvalidArgumentException("Array members must be instances of ChessPieceLocation class");
            }
        }
        $this->chessPieceLocations = $chessPieceLocations;
    }

    public function getChessPieceLocations(): array
    {
        return $this->chessPieceLocations;
    }
}