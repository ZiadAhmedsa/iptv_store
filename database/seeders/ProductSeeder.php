<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'luxury-services'],
            [
                'name' => 'خدمات فاخرة',
                'description' => 'باقات الخدمات الحصرية الفاخرة',
            ]
        );

        $products = [
            [
                'category_id' => $category->id,
                'name' => 'الباقة الملكية الذهبية',
                'description' => 'اشتراك فاخر يمنحك تجربة مشاهدة استثنائية مع دعم فني على مدار الساعة وجودة لا تضاهى.',
                'price' => 499.00,
                'discount_price' => 399.00,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'category_id' => $category->id,
                'name' => 'باقة كبار الشخصيات (VIP)',
                'description' => 'تجربة الـ VIP الحقيقية مع قنوات 4K حصرية واستقرار تام في البث السحابي.',
                'price' => 299.00,
                'discount_price' => null,
                'stock' => 100,
                'is_active' => true,
            ],
            [
                'category_id' => $category->id,
                'name' => 'الباقة الفضية المتميزة',
                'description' => 'الخيار الأمثل للباحثين عن التوازن بين الفخامة والسعر.',
                'price' => 149.00,
                'discount_price' => 99.00,
                'stock' => 200,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
