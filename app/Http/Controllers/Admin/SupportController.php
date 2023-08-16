<?php

namespace App\Http\Controllers\Admin;

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
        $supports = $this->service->getAll($request->filter);
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

    public function store(StoreUpdateSupport $request, Support $support) {
        $data = $request->validated();
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }

    public function edit(string $id) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    public function update(Support $support, StoreUpdateSupport $request, string|int $id) {
        if (!$support = $support->find($id)) {
            return back();
        }
        $support->update($request->validated());
        
        return redirect()->route('supports.index');
    }

    public function destroy(string $id) {

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
