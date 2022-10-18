<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Controller;

use Igor\ConsultantTest\Model\ChessRepositoryInterface;
use Igor\ConsultantTest\View\ChessRendererInterface;

class ChessController
{
    private ChessRepositoryInterface $repository;
    private ChessRendererInterface $chessRenderer;

    public function __construct(
        ChessRepositoryInterface $repository,
        ChessRendererInterface $chessRenderer
    )
    {
        $this->repository = $repository;
        $this->chessRenderer = $chessRenderer;
    }

    public function execute()
    {
        $positions = $this->repository->loadAllPositions();
        echo $this->chessRenderer->render($positions);
    }
}