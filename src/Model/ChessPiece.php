<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Model;

enum ChessPiece: int
{
    case King = 1;
    case Queen = 2;
    case Rook = 3;
    case Bishop = 4;
    case Knight = 5;
    case Pawn = 6;
}
