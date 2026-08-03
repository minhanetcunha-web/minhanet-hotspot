<?php

namespace App\Http\Controllers;

use App\Models\RadiusUser;
use App\Services\RadiusService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RadiusController extends Controller
{
    public function __construct(protected RadiusService $radiusService)
    {
    }

    public function index(): View
    {
        $usuarios = $this->radiusService->listarUsuarios();

        return view('radius.index', compact('usuarios'));
    }

    public function disconnect(RadiusUser $radiusUser): RedirectResponse
    {
        $this->radiusService->desconectar($radiusUser);

        return redirect()->route('radius.index')->with('success', 'Usuário desconectado com sucesso.');
    }

    public function block(RadiusUser $radiusUser): RedirectResponse
    {
        $this->radiusService->bloquear($radiusUser);

        return redirect()->route('radius.index')->with('success', 'Usuário bloqueado com sucesso.');
    }

    public function reactivate(RadiusUser $radiusUser): RedirectResponse
    {
        $this->radiusService->reativar($radiusUser);

        return redirect()->route('radius.index')->with('success', 'Usuário reativado com sucesso.');
    }

    public function destroy(RadiusUser $radiusUser): RedirectResponse
    {
        $this->radiusService->excluir($radiusUser);

        return redirect()->route('radius.index')->with('success', 'Usuário removido com sucesso.');
    }
}
