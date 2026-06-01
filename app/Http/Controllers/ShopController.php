<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Services\CartService;
use Illuminate\Contracts\View\View;

class ShopController extends Controller
{
    public function home(CartService $cart): View
    {
        $catalogProducts = Article::query()
            ->with('categorie')
            ->where('est_visible', true)
            ->where('statut', 'disponible')
            ->where('quantite', '>', 0)
            ->latest()
            ->limit(24)
            ->get();

        $newProducts = $catalogProducts->skip(4)->take(4)->values();
        $rowers = $catalogProducts
            ->filter(fn (Article $article): bool => str_contains(mb_strtolower($article->categorie?->name ?? ''), 'rameur'))
            ->take(4)
            ->values();
        $supplements = $catalogProducts
            ->filter(fn (Article $article): bool => str_contains(mb_strtolower($article->categorie?->name ?? ''), 'nutrition'))
            ->take(4)
            ->values();

        $categoryCards = Categorie::query()
            ->withCount(['articles' => fn ($query) => $query
                ->where('est_visible', true)
                ->where('statut', 'disponible')
                ->where('quantite', '>', 0)])
            ->orderBy('name')
            ->get()
            ->map(fn (Categorie $categorie): array => [
                'code' => mb_strtoupper(mb_substr($categorie->name, 0, 3)),
                'label' => $categorie->name,
            ]);

        return view('welcome', [
            'storeCategoryCards' => $categoryCards,
            'storeProducts' => $catalogProducts->take(4),
            'storeNewProducts' => $newProducts->isNotEmpty() ? $newProducts : $catalogProducts->take(4),
            'storeRowers' => $rowers->isNotEmpty() ? $rowers : $catalogProducts->take(4),
            'storeSupplements' => $supplements->isNotEmpty() ? $supplements : $catalogProducts->take(4),
            'cartCount' => $cart->count(),
        ]);
    }
}
