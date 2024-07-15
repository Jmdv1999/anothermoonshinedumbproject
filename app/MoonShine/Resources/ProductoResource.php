<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use ForestLynx\MoonShine\Fields\Decimal;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Producto>
 */
class ProductoResource extends ModelResource
{
    protected string $model = Producto::class;

    protected string $title = 'Productos';

    protected bool $createInModal = true; 
 
    protected bool $editInModal = true; 

    protected bool $detailInModal = true; 
    //protected bool $withPolicy = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('nombre')->sortable()->placeholder('Nombre Del producto')->required(),
                Number::make('cantidad')->default(0)->placeholder('Cantidad disponible en stock'),
                
                Decimal::make('Precio','precio')->placeholder('Precio del producto')->precision(2,true),
                BelongsTo::make('Categoria','Categoria',resource: new CategoriasResource)->valuesQuery(fn(Builder $query, Field $field) => $query->where('deleted_at', '=',NULL))
            ]),
        ];
    }

    public function search(): array 
    {
        return ['nombre', 'precio', 'categoria'];
    } 

    /**
     * @param Producto $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
