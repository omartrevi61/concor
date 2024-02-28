<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OficioResource\Pages;
use App\Filament\Resources\OficioResource\RelationManagers;
use App\Models\Oficio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\TextColumn;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Split;

class OficioResource extends Resource
{
    protected static ?string $model = Oficio::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationGroup = 'Correspondencia';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('oficio')
                            ->label('Número de Oficio')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(50),
                        Forms\Components\DatePicker::make('fecha_oficio')
                            ->label('Fecha del Oficio')
                            ->default(now())
                            ->required(),
                        Forms\Components\Select::make('destinatario_id')
                            ->required()
                            ->relationship('destinatario', 'nombre')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')
                                ->label('Nombre del nuevo Destinatario')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),
                        Forms\Components\DatePicker::make('fecha_recepcion')
                            ->label('Fecha de Recepción')
                            ->default(now())
                            ->required(),
                        
                        Forms\Components\Select::make('remitente_id')
                            ->required()
                            ->relationship('remitente', 'nombre')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')
                                ->label('Nombre del nuevo Remitente')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Select::make('departamento_id')
                            ->label('Departamento o Instancia Remitente')
                            ->required()
                            ->relationship('departamento', 'nombre')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')
                                ->label('Nombre del nuevo Departamento')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),
                        
                        Forms\Components\MarkdownEditor::make('asunto')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('seguimiento'),
                        Forms\Components\TextInput::make('archivado_en')
                            // ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\Select::make('status_oficios_id')
                            ->label('Status del Oficio')
                            ->required()
                            ->relationship('status_oficios', 'status'),

                        Forms\Components\FileUpload::make('imagen')
                            ->label('Imagen del Oficio')
                            ->image()
                            ->preserveFilenames(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\ImageColumn::make('imagen')->width(50)->height(50),
                Tables\Columns\TextColumn::make('oficio')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_oficio')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('remitente.nombre')
                    ->label('Remitente')
                    ->sortable()
                    ->searchable(),
                /* Tables\Columns\TextColumn::make('departamento.nombre')
                    ->label('Departamento')
                    ->sortable()
                    ->searchable(), */
                Tables\Columns\TextColumn::make('asunto')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
             
                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
             
                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_oficios.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pendiente' => 'warning',
                        'Atendido' => 'success',
                    })
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('fecha_oficio', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    FilamentExportBulkAction::make('export')
                        ->deselectRecordsAfterCompletion()
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Datos Generales del Oficio')
                ->schema([
                    TextEntry::make('oficio')->label('Número de Oficio'),
                    TextEntry::make('fecha_oficio')->date(),
                    TextEntry::make('destinatario.nombre'),
                    TextEntry::make('fecha_recepcion')->date(),
                    TextEntry::make('status_oficios.status')
                        ->label('Status')
                        ->limit(15)
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Pendiente' => 'warning',
                            'Atendido' => 'success',
                        }),

                    ImageEntry::make('imagen')->height(50),
                    TextEntry::make('asunto')->columnSpan('full'),
                ])->columns(6),

                Section::make('Información del Remitente')
                ->schema([
                    TextEntry::make('remitente.nombre'),
                    TextEntry::make('departamento.nombre')
                ])->columns(2),

                Section::make()
                ->schema([
                    TextEntry::make('seguimiento')
                    ->markdown()
                    ->prose()
                ]),              
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOficios::route('/'),
            'create' => Pages\CreateOficio::route('/create'),
            'edit' => Pages\EditOficio::route('/{record}/edit'),
            'view' => Pages\ViewOficio::route('/{record}'),

        ];
    }
}
