<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;


class ProjectController extends Controller
{
    // Display a listing of the projects
    public function index()
    {
        // Fetch projects belonging to the authenticated user
        $projects = Projects::where('user_id', auth()->guard('webb')->id())->get();

        return view('projects.index', compact('projects'));

        //return view('projects.index', compact('projects'));
    }

    // Show the form for creating a new project
    public function create()
    {
        return view('projects.create');
    }

    // Store a newly created project in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            // Add validation rules as needed
        ]);
        //dd(auth()->id());die();
        
        Projects::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->guard('webb')->id(), // Assuming user_id is the authenticated user's ID
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    // Show the form for editing a specific project
    public function edit($id)
    {
        $project = Projects::findOrFail($id);
      //  dd($project->user_id,auth()->guard('webb')->id() );
        // Check if the authenticated user owns the project
        if ($project->user_id != auth()->guard('webb')->id()) {
            abort(403, 'Unauthorized action.'); // Return a 403 Forbidden response
        }
    
        return view('projects.edit', compact('project'));
    }

    // Update a specific project in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            // Add validation rules as needed
        ]);

        $project = Projects::findOrFail($id);
        if ($project->user_id != auth()->guard('webb')->id()) {
            abort(403, 'Unauthorized action.'); // Return a 403 Forbidden response
        }
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    // Delete a specific project from the database
    public function destroy($id)
    {
        $project = Projects::findOrFail($id);
        if ($project->user_id != auth()->guard('webb')->id()) {
            abort(403, 'Unauthorized action.'); // Return a 403 Forbidden response
        }
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
