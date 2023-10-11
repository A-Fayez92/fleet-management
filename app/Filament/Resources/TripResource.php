<?php

namespace App\Filament\Resources;

use Closure;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\Trip;
use Filament\Tables;
use App\Models\Station;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use function Laravel\Prompts\multiselect;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\TripResource\Pages;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\HasManyRepeater;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TripResource\RelationManagers;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                BelongsToSelect::make('bus_id')
                    ->relationship('bus', 'name')
                    ->required()
                    ->reactive()
                    ->placeholder(__('Bus')),

                BelongsToSelect::make('departure_station_id')
                    ->relationship('origin', 'name')
                    ->required()
                    ->reactive()
                    ->hidden(fn ($get) => $get('bus_id') === null)
                    ->placeholder(__('Origin')),

                BelongsToSelect::make('arrival_station_id')
                    ->relationship('destination', 'name', fn ($query, $get) => $query->where('id', '!=', $get('departure_station_id')))
                    ->required()
                    ->reactive()
                    ->hidden(fn ($get) => $get('bus_id') === null || $get('departure_station_id') === null)
                    ->placeholder(__('Destination')),

                DateTimePicker::make('departure_time')
                    ->required()
                    ->minDate(now())
                    ->reactive()
                    ->hidden(fn ($get) => $get('bus_id') === null || $get('departure_station_id') === null || $get('arrival_station_id') === null)
                    ->placeholder(__('Departure Time')),

                DateTimePicker::make('arrival_time')
                    ->required()
                    ->minDate(fn ($get) => $get('departure_time'))
                    ->reactive()
                    ->hidden(fn ($get) => $get('bus_id') === null || $get('departure_station_id') === null || $get('arrival_station_id') === null || $get('departure_time') === null)
                    ->placeholder(__('Arrival Time')),

                Repeater::make('stops')
                    ->schema([
                        BelongsToSelect::make('station_id')
                            ->relationship('station', 'name', fn ($query, $get) => $query->where('id', '!=', $get('departure_station_id'))->where('id', '!=', $get('arrival_station_id')))
                            ->required()
                            ->reactive()
                            ->placeholder(__('Station')),

                        DateTimePicker::make('arrival_time')
                            ->required()
                            ->minDate(fn ($get) => $get('departure_time'))
                            ->reactive()
                            ->placeholder(__('Arrival Time')),

                        DateTimePicker::make('departure_time')
                            ->required()
                            ->minDate(now())
                            ->reactive()
                            ->placeholder(__('Departure Time')),
                    ])
                    ->reactive()
                    ->hidden(fn ($get) => $get('bus_id') === null || $get('departure_station_id') === null || $get('arrival_station_id') === null)
                    ->relationship(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('bus.name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('origin.name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('destination.name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('departure_time')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('arrival_time')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('stops.station.name')
                    ->label('Stops')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
