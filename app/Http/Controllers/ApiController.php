<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class ApiController extends Controller
{
    public function getAllTodos() {
        $todos = Todo::get()->toJson(JSON_PRETTY_PRINT);
    return response($todos, 200);
 }

    public function createTodo($user_id,Request $request ) {
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->completed =$request->completed;
        // $todo->user_id =$request->user_id;
         $user = User::where('id',$user_id)->first();
        return(['user_id' => $user]);
        $todo->save();
        
    return response()->json([
        "message" => "todo record created"
    ], 201);
    }

    public function getTodo($id) {
        if (Todo::where('id', $id)->exists()) {
            $todo = Todo::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($todo, 200);
}
        else {
            return response()->json([
  "message" => "Todo not found"
            ], 404);
          }
      }

      public function updateTodo(Request $request, $id) {
        if (Todo::where('id', $id)->exists()) {
            $todo = Todo::find($id);
            $todo->title = is_null($request->title) ? $todo->title : $request->title;
            $todo-> completed = is_null($request->completed) ? $todo->completed : $request->completed;
            $todo->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "todo not found"
            ], 404);

        }
      }

      public function deleteTodo ($id) {
        if(Todo::where('id', $id)->exists()) {
            $todo = Todo::find($id);
            $todo->delete();

            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Todo not found"
            ], 404);
          }
      }
}
