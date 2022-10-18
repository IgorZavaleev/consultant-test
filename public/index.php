<?php

declare(strict_types=1);

use Igor\ConsultantTest\Controller\ChessController;
use Igor\ConsultantTest\Database\Mysql;
use Igor\ConsultantTest\Migrations\AddChessPositions;
use Igor\ConsultantTest\Migrations\CreateTables;
use Igor\ConsultantTest\Migrations\Migrator;
use Igor\ConsultantTest\Model\ChessPositionBuilder;
use Igor\ConsultantTest\Model\ChessRepository;
use Igor\ConsultantTest\View\ChessRenderer;

require dirname(__DIR__).'/vendor/autoload.php';;

try
{
    // TODO вынести в контейнер
    $database = new Mysql();
    $chessRepository = new ChessRepository($database);
    $chessPositionBuilder = new ChessPositionBuilder();
    $chessRenderer = new ChessRenderer();

    Migrator::applyMigrations([
        new CreateTables($database),
        new AddChessPositions($database, $chessRepository, $chessPositionBuilder)
    ]);

    $controller = new ChessController($chessRepository, $chessRenderer);
    $controller->execute();
}

catch(Exception $e)
{
    // TODO логирование ошибок
    echo "<hr>", "ERROR: ", $e->getMessage();
}
