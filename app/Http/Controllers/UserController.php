<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;


class UserController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'marks' => 'required|numeric',
        ]);
      $student = Student::updateOrCreate(
            ['name' => $validated['name'], 'subject' => $validated['subject']],
            [
                'name' => $validated['name'],
                'subject' => $validated['subject'],
                'marks' => $validated['marks'],
            ]
        );
    
        return redirect()->route('users.index')->with('success', 'Student created successfully.');
    }

     // Display user list
     public function index()
     {
         $users = Student::all();
         return view('index', compact('users'));
     }
 
     // Update user details
     public function update(Request $request, $id)
     {
         $user = Student::findOrFail($id);
 
         // Validate the request
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'subject' => 'required',
             'marks' => 'required|numeric',
            ]);
 
         $user->update($validated);
 
         return redirect()->route('users.index')->with('success', 'Student marks updated successfully');
     }
 
     // Delete user
     public function destroy($id)
     {
         $user = Student::findOrFail($id);
         $user->delete();
 
         // Redirect back with success message
         return redirect()->route('users.index')->with('success', 'Student deleted successfully');
     }

     
 
    
}
