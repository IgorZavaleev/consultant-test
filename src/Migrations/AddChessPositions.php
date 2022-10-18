<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Migrations;

use Igor\ConsultantTest\Database\DatabaseInterface;
use Igor\ConsultantTest\Model\ChessPiece;
use Igor\ConsultantTest\Model\ChessPieceColor;
use Igor\ConsultantTest\Model\ChessPieceLocation;
use Igor\ConsultantTest\Model\ChessPositionBuilder;
use Igor\ConsultantTest\Model\ChessPositionBuilderInterface;
use Igor\ConsultantTest\Model\ChessRepositoryInterface;

class AddChessPositions extends MigrationAbstract
{
    protected ChessRepositoryInterface $repository;
    protected ChessPositionBuilderInterface $builder;

    public function __construct(
        DatabaseInterface $database,
        ChessRepositoryInterface $repository,
        ChessPositionBuilderInterface $builder
    )
    {
        parent::__construct($database);
        $this->repository = $repository;
        $this->builder = $builder;
    }

    public function migrate()
    {
        $positions['Два короля'] = $this->builder
            ->addChessPieceLocation(new ChessPieceLocation(1, 1, ChessPiece::King, ChessPieceColor::White))
            ->addChessPieceLocation(new ChessPieceLocation(8, 8, ChessPiece::King, ChessPieceColor::Black))
            ->build();

        $positions['Короли и ферзи'] = $this->builder
            ->addChessPieceLocation(new ChessPieceLocation(2, 2, ChessPiece::King, ChessPieceColor::White))
            ->addChessPieceLocation(new ChessPieceLocation(6, 6, ChessPiece::King, ChessPieceColor::Black))
            ->addChessPieceLocation(new ChessPieceLocation(3, 3, ChessPiece::Queen, ChessPieceColor::White))
            ->addChessPieceLocation(new ChessPieceLocation(5, 5, ChessPiece::Queen, ChessPieceColor::Black))
            ->build();

        $positions['Короли и пешки'] = $this->builder
            ->addChessPieceLocation(new ChessPieceLocation(2, 2, ChessPiece::King, ChessPieceColor::White))
            ->addChessPieceLocation(new ChessPieceLocation(6, 6, ChessPiece::King, ChessPieceColor::Black))
            ->addChessPieceLocation(new ChessPieceLocation(3, 3, ChessPiece::Pawn, ChessPieceColor::White))
            ->addChessPieceLocation(new ChessPieceLocation(4, 3, ChessPiece::Pawn, ChessPieceColor::White))
            ->addChessPieceLocation(new ChessPieceLocation(5, 3, ChessPiece::Pawn, ChessPieceColor::White))
            ->addChessPieceLocation(new ChessPieceLocation(5, 5, ChessPiece::Pawn, ChessPieceColor::Black))
            ->addChessPieceLocation(new ChessPieceLocation(6, 5, ChessPiece::Pawn, ChessPieceColor::Black))
            ->addChessPieceLocation(new ChessPieceLocation(7, 5, ChessPiece::Pawn, ChessPieceColor::Black))
            ->build();


        foreach ($positions as $name => $position) {
            $this->repository->createAndSavePosition($name, $position);
        }
    }
}