<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function index(CartService $cart): View
    {
        $summary = $cart->summary();

        return view('cart.index', [
            'summary' => $summary,
            'cartCount' => $cart->count(),
        ]);
    }

    public function add(Request $request, Article $article, CartService $cart): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        try {
            $cart->add($article, (int) ($validated['quantity'] ?? 1));
        } catch (ValidationException $exception) {
            return redirect()->back()
                ->withErrors($exception->errors());
        }

        return redirect()->back()
            ->with('success', "{$article->name} a ete ajoute au panier.");
    }

    public function update(Request $request, CartService $cart): RedirectResponse
    {
        $validated = $request->validate([
            'quantities' => ['required', 'array'],
            'quantities.*' => ['nullable', 'integer', 'min:0'],
        ]);

        try {
            $cart->update($validated['quantities']);
        } catch (ValidationException $exception) {
            return redirect()->back()
                ->withErrors($exception->errors());
        }

        return redirect()->route('cart.index')
            ->with('success', 'Panier mis a jour.');
    }

    public function remove(Article $article, CartService $cart): RedirectResponse
    {
        $cart->remove($article);

        return redirect()->route('cart.index')
            ->with('success', 'Article retire du panier.');
    }

    public function clear(CartService $cart): RedirectResponse
    {
        $cart->clear();

        return redirect()->route('cart.index')
            ->with('success', 'Panier vide.');
    }
}

