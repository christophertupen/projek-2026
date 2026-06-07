<?php

namespace App\Filament\Akademik\Widgets;

use Filament\Widgets\Widget;

class PanelLoginWidget extends Widget
{
    protected static string $view = 'filament.akademik.widgets.panel-login-widget';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';
}
