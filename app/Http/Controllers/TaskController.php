<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{   
    /**
     * タスクリポジトリーインスタンス
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    public function index( Request  $request) 
    {   
        $tasks = Task::Where( 'user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
                 
        return view( 'tasks.index',[
            'tasks' => $tasks,
        ] );
    }

    /**
     * 新タスク作成
     *
     * @param  Request  $request
     * @return Response
     */

    public function store( Request $request )
    {
        $this->validate( $request, [
            'name' => 'required|max:255',
        ] );

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect( '/tasks' );
    }

    /**
     * 指定タスクの削除
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy( Request $request,  Task $task)
    {           
        if ( $request->user()->id  != $task->user_id ){ 
            abort(403);
        }

        $task->delete();

        return redirect('/tasks');
    }
}
