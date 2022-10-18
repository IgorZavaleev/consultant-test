<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Model;

use Igor\ConsultantTest\Database\DatabaseInterface;

class ChessRepository implements ChessRepositoryInterface
{
    private DatabaseInterface $database;

    public function __construct(DatabaseInterface $database) {
        $this->database = $database;
    }

    public function createAndSavePosition(string $positionName, ChessPosition $position): void
    {
        $this->database->executeQuery(
            'INSERT INTO chess_position (name) VALUES (:name)',
            ['name' => $positionName]
        );
        $positionId = (int) $this->database->lastInsertId();
        foreach ($position->getChessPieceLocations() as $location) {
            /**
             * @var ChessPieceLocation $location
             */
            $this->database->executeQuery(
                'INSERT INTO chess_piece_location (x, y, chess_piece, color, position_id) VALUES (:x, :y, :chess_piece, :color, :position_id)',
                [
                    'x' => $location->getX(),
                    'y' => $location->getY(),
                    'chess_piece' => $location->getChessPieceCode(),
                    'color' => $location->getChessPieceColorCode(),
                    'position_id' => $positionId,
                ]
            );
        }
    }

    public function loadAllPositions(): array
    {
        $this->database->executeQuery('select id, name from chess_position');
        $chessPositions = $this->database->fetchLastResult();
        $result = [];
        foreach ($chessPositions as $position) {
            $name = $position['name'];
            $id = $position['id'];
            $this->database->executeQuery(
                'select * from chess_piece_location where position_id=:position_id',
                ['position_id' => $id]
            );

            $locationModels = [];
            $locations = $this->database->fetchLastResult();
            foreach ($locations as $location) {
                $locationModels[] = new ChessPieceLocation(
                    $location['x'],
                    $location['y'],
                    ChessPiece::from($location['chess_piece']),
                    ChessPieceColor::from($location['color'])
                );
            }

            $result[$name] = new ChessPosition($locationModels);
        }

        return $result;
    }
}