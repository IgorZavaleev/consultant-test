<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Model;

class ChessPieceLocation
{
    private int $x;
    private int $y;
    private int $chessPieceCode;
    private int $chessPieceColorCode;

    public function __construct(int $x, int $y, ChessPiece $chessPiece, ChessPieceColor $chessPieceColor)
    {
        if (($x < 1) || ($x > 8) || ($y < 1) || ($y > 8)) {
            throw new \LogicException('Invalid chess piece location');
        }

        $this->x = $x;
        $this->y = $y;
        $this->chessPieceCode = $chessPiece->value;
        $this->chessPieceColorCode = $chessPieceColor->value;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getChessPieceCode(): int
    {
        return $this->chessPieceCode;
    }

    public function getChessPieceColorCode(): int
    {
        return $this->chessPieceColorCode;
    }
}
