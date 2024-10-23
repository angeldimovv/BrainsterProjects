<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityLogRelationManager extends RelationManager
{
    protected static string $relationship = 'activity_log';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('points')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('points')
                    ->label('Points Gained'),
                Tables\Columns\TextColumn::make('bought_tickets')
                    ->label('Bought Tickets for Events')
                ->formatStateUsing(function ($record) {
                    $tickets = '';
                    foreach($record->bought_tickets as $event) {
                        $title = Event::where('id', $event)->first()->title;
                        $tickets .= $title . ', ';
                    }
                    return rtrim($tickets, ', ');
                }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
