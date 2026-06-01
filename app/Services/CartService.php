<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Facture;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class CartService
{
    private const SESSION_KEY = 'shop.cart';

    /**
     * @return array<int, int>
     */
    public function all(): array
    {
        return collect(session(self::SESSION_KEY, []))
            ->mapWithKeys(fn (mixed $quantity, mixed $articleId): array => [(int) $articleId => max(0, (int) $quantity)])
            ->filter(fn (int $quantity): bool => $quantity > 0)
            ->all();
    }

    public function count(): int
    {
        return array_sum($this->all());
    }

    public function add(Article $article, int $quantity): void
    {
        $this->ensureArticleCanBeSold($article, $quantity);

        $cart = $this->all();
        $currentQuantity = (int) ($cart[$article->id] ?? 0);
        $newQuantity = $currentQuantity + $quantity;

        if ($newQuantity > (int) $article->quantite) {
            throw ValidationException::withMessages([
                'quantity' => "Stock insuffisant pour {$article->name}. Stock disponible : {$article->quantite}.",
            ]);
        }

        $cart[$article->id] = $newQuantity;
        session([self::SESSION_KEY => $cart]);
    }

    /**
     * @param array<int|string, int|string|null> $quantities
     */
    public function update(array $quantities): void
    {
        $articleIds = collect($quantities)->keys()->map(fn (mixed $id): int => (int) $id)->all();

        $articles = Article::query()
            ->whereIn('id', $articleIds)
            ->get()
            ->keyBy('id');

        $cart = [];

        foreach ($quantities as $articleId => $quantity) {
            $articleId = (int) $articleId;
            $quantity = (int) $quantity;

            if ($quantity < 1) {
                continue;
            }

            /** @var Article|null $article */
            $article = $articles->get($articleId);

            if (! $article) {
                continue;
            }

            $this->ensureArticleCanBeSold($article, $quantity);
            $cart[$articleId] = $quantity;
        }

        session([self::SESSION_KEY => $cart]);
    }

    public function remove(Article $article): void
    {
        $cart = $this->all();
        unset($cart[$article->id]);

        session([self::SESSION_KEY => $cart]);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * @return array{
     *     items: Collection<int, array{article: Article, quantity: int, unit_price: float, line_total: float}>,
     *     subtotal: float,
     *     tax_rate: float,
     *     tax: float,
     *     total: float
     * }
     */
    public function summary(): array
    {
        $this->normalize();

        $cart = $this->all();
        $articles = Article::query()
            ->whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        $items = collect($cart)
            ->map(function (int $quantity, int $articleId) use ($articles): ?array {
                /** @var Article|null $article */
                $article = $articles->get($articleId);

                if (! $article) {
                    return null;
                }

                $unitPrice = (float) $article->prix_vente;

                return [
                    'article' => $article,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $unitPrice * $quantity,
                ];
            })
            ->filter()
            ->values();

        $subtotal = (float) $items->sum('line_total');
        $taxRate = Facture::TVA_RATE;
        $tax = $subtotal * ($taxRate / 100);

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax' => $tax,
            'total' => $subtotal + $tax,
        ];
    }

    public function normalize(): void
    {
        $cart = $this->all();

        if ($cart === []) {
            return;
        }

        $articles = Article::query()
            ->whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        $normalized = [];

        foreach ($cart as $articleId => $quantity) {
            /** @var Article|null $article */
            $article = $articles->get($articleId);

            if (! $article || ! $article->is_available_for_sale) {
                continue;
            }

            $normalized[$articleId] = min($quantity, (int) $article->quantite);
        }

        session([self::SESSION_KEY => $normalized]);
    }

    private function ensureArticleCanBeSold(Article $article, int $quantity): void
    {
        if ($quantity < 1) {
            throw ValidationException::withMessages([
                'quantity' => 'La quantite doit etre superieure a 0.',
            ]);
        }

        if (! $article->is_available_for_sale) {
            throw ValidationException::withMessages([
                'article' => "L'article {$article->name} n'est pas disponible a la vente.",
            ]);
        }

        if ($quantity > (int) $article->quantite) {
            throw ValidationException::withMessages([
                'quantity' => "Stock insuffisant pour {$article->name}. Stock disponible : {$article->quantite}.",
            ]);
        }
    }
}

