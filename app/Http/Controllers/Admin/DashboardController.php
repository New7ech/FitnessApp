<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $selectedType = $request->query('type');
        $selectedStatus = $request->query('status');

        $requests = CustomerRequest::query()
            ->when(array_key_exists((string) $selectedType, CustomerRequest::TYPES), fn ($query) => $query->where('type', $selectedType))
            ->when(array_key_exists((string) $selectedStatus, CustomerRequest::STATUSES), fn ($query) => $query->where('status', $selectedStatus))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $stats = CustomerRequest::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.dashboard', [
            'requests' => $requests,
            'types' => CustomerRequest::TYPES,
            'statuses' => CustomerRequest::STATUSES,
            'selectedType' => $selectedType,
            'selectedStatus' => $selectedStatus,
            'stats' => $stats,
            'totalRequests' => CustomerRequest::query()->count(),
        ]);
    }

    public function update(Request $request, CustomerRequest $customerRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(CustomerRequest::STATUSES))],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($customerRequest->read_at === null) {
            $validated['read_at'] = now();
        }

        $customerRequest->update($validated);

        return back()->with('admin_status', 'Demande mise a jour.');
    }

    public function destroy(CustomerRequest $customerRequest): RedirectResponse
    {
        $customerRequest->delete();

        return back()->with('admin_status', 'Demande supprimee.');
    }

    public function notify(Request $request, CustomerRequest $customerRequest): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Mail::raw($validated['message'], function ($message) use ($customerRequest, $validated): void {
            $message
                ->to($customerRequest->email, $customerRequest->name)
                ->subject($validated['subject']);
        });

        $note = implode(PHP_EOL, [
            '['.now()->format('d/m/Y H:i').'] Notification envoyee',
            'Sujet: '.$validated['subject'],
            $validated['message'],
        ]);

        $customerRequest->update([
            'status' => $customerRequest->status === 'new' ? 'contacted' : $customerRequest->status,
            'read_at' => $customerRequest->read_at ?? now(),
            'admin_notes' => trim(collect([$customerRequest->admin_notes, $note])->filter()->implode(PHP_EOL.PHP_EOL)),
        ]);

        return back()->with('admin_status', 'Notification envoyee au demandeur.');
    }
}
