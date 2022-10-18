<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Model;

use LogicException;

class ChessPositionBuilder implements ChessPositionBuilderInterface
{
    private array $chessPieceLocations = [];

    public function addChessPieceLocation(ChessPieceLocation $location): self
    {
        $this->chessPieceLocations[] = $location;

        return $this;
    }

    public function build(): ChessPosition
    {
        $this->validatePosition();
        $position = new ChessPosition($this->chessPieceLocations);
        $this->chessPieceLocations = [];
        return $position;
    }

    private function validatePosition()
    {
        $desk = [];
        $blackKing = 0;
        $whiteKing = 0;
        /**
         * @var ChessPieceLocation $location
         */
        foreach ($this->chessPieceLocations as $location) {
            if (!empty($desk[$location->getY()][$location->getX()])) {
                throw new LogicException("Error adding chess piece location.");
            }
            $desk[$location->getY()][$location->getX()] = 1;

            if ($location->getChessPieceCode() == ChessPiece::King->value) {
                switch ($location->getChessPieceColorCode()) {
                    case ChessPieceColor::Black:
                        $blackKing++;
                        break;
                    case ChessPieceColor::White:
                        $whiteKing++;
                        break;
                }

                if (($blackKing > 1) || ($blackKing > 1))
                {
                    throw new LogicException('Too many kings');
                }
            }
        }


    }
}