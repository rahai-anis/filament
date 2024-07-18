<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Projects;
use Illuminate\Http\Request;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\ComponentContainer;

use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        // Fetch projects belonging to the authenticated user
        $projectIds = Projects::where('user_id', auth()->guard('webb')->id())->pluck('id');

    // Récupérer les tâches liées à ces projets et inclure les projets dans le résultat
    $tasks = Task::whereIn('project_id', $projectIds)->with('projects')->get();

    return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        
        // Récupérer les projets appartenant à l'utilisateur authentifié
    $projects = Projects::where('user_id', auth()->guard('webb')->id())->pluck('name', 'id')->toArray();

    return view('tasks.create', compact('projects'));
    }
    public function store(Request $request)
{
    // Valider et créer une nouvelle tâche
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'project_id' => 'required|exists:projects,id',
        'status' => 'required|in:pending,in-progress,completed',
    ]);

    Task::create([
        'name' => $request->name,
        'description' => $request->description,
        'project_id' => $request->project_id,
        'status' => $request->status,
        'user_id' => auth()->id(), // Associer la tâche à l'utilisateur authentifié
    ]);

    return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
}
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // Assurez-vous que l'utilisateur est propriétaire du projet associé à la tâche
        if ($task->projects->user_id != auth()->guard('webb')->id()) {
            return redirect()->route('tasks.index')->with('error', 'Accès refusé.');
        }

        // Récupérer les projets de l'utilisateur authentifié pour le champ de sélection du projet
        $projects = Projects::where('user_id', auth()->guard('webb')->id())->pluck('name', 'id');

        return view('tasks.edit', compact('task', 'projects'));
    }

    // Mettre à jour une tâche spécifique dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'status' => 'required|string|in:pending,in-progress,completed',
        ]);

        $task = Task::findOrFail($id);

        // Assurez-vous que l'utilisateur est propriétaire du projet associé à la tâche
        if ($task->projects->user_id != auth()->guard('webb')->id()) {
            return redirect()->route('tasks.index')->with('error', 'Accès refusé.');
        }

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        // Assurez-vous que l'utilisateur est propriétaire du projet associé à la tâche
        if ($task->projects->user_id != auth()->guard('webb')->id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
