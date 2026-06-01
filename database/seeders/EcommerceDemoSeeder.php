<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EcommerceDemoSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            'Fitness',
            'Tapis de course',
            'Musculation',
            'Rameurs',
            'Accessoires',
            'Nutrition',
        ])->mapWithKeys(function (string $name): array {
            return [
                $name => Categorie::query()->firstOrCreate(
                    ['name' => $name],
                    ['description' => "Categorie {$name}"]
                ),
            ];
        });

        $articles = [
            [
                'name' => 'Tapis de course X-Run 560',
                'category' => 'Tapis de course',
                'sku' => 'FIT-TAP-XRUN-560',
                'prix' => 799000,
                'prix_promotionnel' => 699000,
                'quantite' => 8,
                'image_principale' => 'https://images.unsplash.com/photo-1576678927484-cc907957088c?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'name' => 'Rameur magnetique Pro Row',
                'category' => 'Rameurs',
                'sku' => 'FIT-RAM-PRO-ROW',
                'prix' => 449000,
                'prix_promotionnel' => null,
                'quantite' => 12,
                'image_principale' => 'https://images.unsplash.com/photo-1599058917212-d750089bc07e?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'name' => 'Banc reglable multi-position',
                'category' => 'Musculation',
                'sku' => 'FIT-MUS-BANC-001',
                'prix' => 199000,
                'prix_promotionnel' => 169000,
                'quantite' => 10,
                'image_principale' => 'https://images.unsplash.com/photo-1534368959876-26bf04f2c947?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'name' => 'Pack halteres reglables',
                'category' => 'Musculation',
                'sku' => 'FIT-MUS-HALT-SET',
                'prix' => 289000,
                'prix_promotionnel' => null,
                'quantite' => 15,
                'image_principale' => 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'name' => 'Velo indoor Sprint Bike',
                'category' => 'Fitness',
                'sku' => 'FIT-VEL-SPRINT',
                'prix' => 549000,
                'prix_promotionnel' => null,
                'quantite' => 6,
                'image_principale' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'name' => 'Whey isolate chocolat',
                'category' => 'Nutrition',
                'sku' => 'FIT-NUT-WHEY-CHOCO',
                'prix' => 39900,
                'prix_promotionnel' => 34900,
                'quantite' => 30,
                'image_principale' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'name' => 'Shaker sport 700 ml',
                'category' => 'Accessoires',
                'sku' => 'FIT-ACC-SHAKER-700',
                'prix' => 9900,
                'prix_promotionnel' => null,
                'quantite' => 40,
                'image_principale' => 'https://images.unsplash.com/photo-1605296867424-35fc25c9212a?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'name' => 'Tapis training antiderapant',
                'category' => 'Accessoires',
                'sku' => 'FIT-ACC-TAPIS-TRAIN',
                'prix' => 34900,
                'prix_promotionnel' => 29900,
                'quantite' => 20,
                'image_principale' => 'https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?auto=format&fit=crop&w=700&q=80',
            ],
        ];

        foreach ($articles as $article) {
            Article::query()->updateOrCreate(
                ['sku' => $article['sku']],
                [
                    'name' => $article['name'],
                    'slug' => Str::slug($article['name']),
                    'est_visible' => true,
                    'description' => "Article boutique {$article['name']}",
                    'image_principale' => $article['image_principale'],
                    'prix' => $article['prix'],
                    'prix_promotionnel' => $article['prix_promotionnel'],
                    'quantite' => $article['quantite'],
                    'statut' => 'disponible',
                    'poids' => 1,
                    'category_id' => $categories[$article['category']]->id,
                ]
            );
        }
    }
}

