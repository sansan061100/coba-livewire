<?php

namespace App\Http\Livewire\Product;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use App\Trait\ActionTrait;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ProductTable extends DataTableComponent
{
    protected $model = Product::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setSearchStatus(true);

        $this->setSortingEnabled();
    }

    public function filters(): array
    {
        return [
            // filter price by range

            SelectFilter::make('Price')
                ->options([
                    '0-100' => '0 - 100',
                    '101-200' => '101 - 200',
                    '201-300' => '201 - 300',
                    '>300' => '> 300',
                ])
                ->filter(function (Builder $builder, string $value) {
                    switch ($value) {
                        case '0-100':
                            $builder->whereBetween('price', [0, 100]);
                            break;
                        case '101-200':
                            $builder->whereBetween('price', [101, 200]);
                            break;
                        case '201-300':
                            $builder->whereBetween('price', [201, 300]);
                            break;
                        case '>300':
                            $builder->where('price', '>', 300);
                            break;
                    }
                }),
            SelectFilter::make('Name')
                ->options([
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                    'E' => 'E',
                    'F' => 'F',
                    'G' => 'G',
                    'H' => 'H',
                    'I' => 'I',
                    'J' => 'J',
                    'K' => 'K',
                    'L' => 'L',
                    'M' => 'M',
                    'N' => 'N',
                    'O' => 'O',
                    'P' => 'P',
                    'Q' => 'Q',
                    'R' => 'R',
                    'S' => 'S',
                    'T' => 'T',
                    'U' => 'U',
                    'V' => 'V',
                    'W' => 'W',
                    'X' => 'X',
                    'Y' => 'Y',
                    'Z' => 'Z',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('name', 'like', $value . '%');
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")->format(fn () => ++$this->index +  ($this->page - 1) * $this->perPage),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $button = '<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-2 m-2 rounded m-1" wire:click="$emit(\'editProduct\', ' . $row->id . ')">Edit</button>';

                        $button .= '<button class="bg-red-500 hover:bg-red-800 text-white font-bold p-2 m2 rounded m-1" wire:click="$emit(\'deleteProduct\', ' . $row->id . ')">Delete</button>';

                        return $button;
                    }
                )->html()
        ];
    }
}
