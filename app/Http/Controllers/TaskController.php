<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller {
    /**
     * タスクの一覧
     *
     * @param Folder $folder
     * @return void
     */
    public function index(Folder $folder) {
        if(Auth::user()->id !== $folder->user_id) {
            abort(403);
        }


        // folderテーブルの全てのレコードを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダを取得する
        // $current_folder = Folder::find($id);

        // $current_folderが空であれば間違ったURLなので404を返す。
        // if(is_null($current_folder)) {
        //     abort(404);
        // }

        // 選ばれたフォルダに紐づくタスクを取得する
        // $tasks = Task::where('folder_id', $current_folder->id)->get();と等価
        $tasks = $folder->tasks()->get();

        $param = [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ];

        return view('tasks.index', $param);
    }

    /**
     * タスクの作成フォーム
     *
     * @param Folder $folder
     * @return void
     */
    public function showCreateForm(Folder $folder) {
        return view('tasks/create', ['folder_id' => $folder->$id]);
    }

    /**
     * タスクの作成
     *
     * @param Folder $folder
     * @param CreateTask $request
     * @return void
     */
    public function create(Folder $folder, CreateTask $request) {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // 現在のフォルダに関連するタスクを取り出してDBに$taskを保存
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', ['id' => $folder->id]);
    }

    /**
     * タスク編集フォーム
     *
     * @param Folder $folder
     * @param Task $task
     * @return void
     */
    public function showEditForm(Folder $folder, Task $task) {
        return view('tasks/edit', ['task' => $task]);
    }

    public function edit(Folder $folder, Task $task, EditTask $request) {
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
