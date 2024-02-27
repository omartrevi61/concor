<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RemitenteResource\Pages;
use App\Filament\Resources\RemitenteResource\RelationManagers;
use App\Models\Remitente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Section;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class RemitenteResource extends Resource
{
    protected static ?string $model = Remitente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Forms\Components\TextInput::make('nombre')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\TextInput::make('puesto')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telefono')
                        ->maxLength(100),
                    Forms\Components\TextInput::make('email')
                        ->unique()
                        ->maxLength(255),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('puesto')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    FilamentExportBulkAction::make('export')
                        ->deselectRecordsAfterCompletion()
                        ->fileNameFieldLabel('Nombre del Reporte')
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRemitentes::route('/'),
        ];
    }
}
