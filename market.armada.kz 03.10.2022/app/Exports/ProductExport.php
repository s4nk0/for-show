<?php

namespace App\Exports;

use App\Http\Services\ProductService;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromQuery,  WithMapping, WithHeadings,WithStyles
{


    protected $export_store_id;

    public function __construct($export_store_id)
    {
        $this->export_store_id = $export_store_id;
    }

    public function prepareRows($rows)
    {
        $productService = new ProductService();
        return $rows->transform(function ($product) use ($productService) {
            $product->isActive = $product->isActive ? 'Да' : 'Нет';
            $product->is_hot = $product->is_hot ? 'Да' : 'Нет';
            $product->delivery_ids = $productService->export_delivery($product->delivery_ids);
            $product->pay_ids = $productService->export_payment($product->pay_ids);
            return $product;
        });
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }
    public function map($product): array
    {
        return [
            $product->title,
            $product->articul,
            $product->isActive,
            $product->is_hot,
            $product->presence->title,
            $product->price,
            $product->store->title,
            $product->catalog->title,
            $product->subcatalog->title,
            $product->item->title,
            $product->delivery_ids,
            $product->pay_ids,
            $product->manufacture,
            $product->country->title_ru ?? null,
            $product->colors,
            $product->width,
            $product->height,
            $product->depth,
            $product->seo_title,
            $product->meta_description,
            $product->meta_tags,
            $product->created_at
        ];
    }
    public function headings(): array
    {
        return [
            'Название',
            'Артикул',
            'Активный',
            'Горячий',
            'Наличие',
            'Цена',
            'Продавец',
            'Каталог',
            'Подкаталог',
            'Раздел',
            'Доставка',
            'Оплата',
            'Материал',
            'Страна',
            'Цвета',
            'Длина',
            'Высота',
            'Глубина',
            'SEO Заголовок',
            'SEO Описание',
            'Ключевые слова',
            'Дата создания'
        ];
    }

    public function query()
    {
        return Product::query()->where('store_id','=', $this->export_store_id);
    }

//
//    /**
//    * @return array
//     */
//    public function collection()
//    {
//        return Product::query()->where('store_id','=', $this->export_store_id)->get();
//    }
}
