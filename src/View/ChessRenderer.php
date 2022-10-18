<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\View;

use Igor\ConsultantTest\Model\ChessPiece;
use Igor\ConsultantTest\Model\ChessPieceColor;
use Igor\ConsultantTest\Model\ChessPieceLocation;
use Igor\ConsultantTest\Model\ChessPosition;

class ChessRenderer implements ChessRendererInterface
{
    private function renderPosition(ChessPosition $position): string
    {
        $chessPieceNames = [
            ChessPiece::King->value => 'Король',
            ChessPiece::Queen->value => 'Ферзь',
            ChessPiece::Rook->value => 'Ладья',
            ChessPiece::Bishop->value => 'Слон',
            ChessPiece::Knight->value => 'Конь',
            ChessPiece::Pawn->value => 'Пешка',
        ];

        $colors = [
            ChessPieceColor::Black->value => 'black',
            ChessPieceColor::White->value => 'white',
        ];

        $desk = [];
        foreach ($position->getChessPieceLocations() as $chessPiece) {
            /**
             * @var ChessPieceLocation $chessPiece
             */
            $desk[$chessPiece->getY()][$chessPiece->getX()] = [
                'name' => $chessPieceNames[$chessPiece->getChessPieceCode()],
                'color' => $colors[$chessPiece->getChessPieceColorCode()]
            ];
        }

        $result = '<table>';
        for ($i = 1; $i <= 8; $i++) {
            $result .= '<tr>';
            for ($j = 1; $j <= 8; $j++) {
                $iModulo = $i % 2;
                $jModulo = $j % 2;
                $bgColor =
                    (($iModulo && $jModulo) || (!$iModulo && !$jModulo)) ?
                        'white' :
                        'black'
                ;

                $figure = '&nbsp';
                if (!empty($desk[$i][$j])) {
                    $figure = "<b style='background:gray;color:{$desk[$i][$j]['color']}'>{$desk[$i][$j]['name']}</b>";
                }
                $result .= "<td style='background:$bgColor; width:50; height:50'>$figure</td>";
            }
            $result .= '</tr>';
        }
        $result .= '</table>';

        return $result;
    }

    public function render(array $positions): string
    {
        $result = '';

        foreach ($positions as $name => $position) {
            $result .= "<h1>$name</h1>";
            $result .= $this->renderPosition($position);
        }

        return $result;
    }
}