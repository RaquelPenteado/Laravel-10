<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SupportController extends Controller
{

    public function __construct(protected SupportService $service)
    {
        
    } 

    public function index(Request $request) {
        $supports = $this->service->paginate(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 15), filter: $request->filter,);
        return view('admin/supports/index', compact('supports'));
    }

    public function show(string $id) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/supports/show', compact('support'));
    }

    public function create() {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request) {

        $this->service->new(CreateSupportDTO::makeFromResponse($request));

        return redirect()->route('supports.index');
    }

    public function edit(string $id) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, string|int $id) {
        $support = $this->service->update(UpdateSupportDTO::makeFromResponse($request));

        if (!$support) {
            return back();
        }
        
        return redirect()->route('supports.index');
    }

    public function destroy(string $id) {

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
