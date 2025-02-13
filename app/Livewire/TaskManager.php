<?php

namespace App\Livewire;

use App\Models\Task;
use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use Livewire\Component;
use Hekmatinasser\Verta\Verta;
    class TaskManager extends Component
{
    public $title;
    public $description;
    public $due_date;
    public $priority = 'medium';
    public $status = 'pending';

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'nullable',
        'due_date' => 'required|date',
        'priority' => 'required|in:low,medium,high,critical',
        'status' => 'required|in:pending,in_progress,completed'
    ];

    public function createTask()
    {
        $this->validate();

        $task = Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'priority' => $this->priority,
            'status' => $this->status,
            'user_id' => auth()->id()
        ]);

        if ($task->priority === 'high' || $task->priority === 'critical') {
            dispatch(new ProcessHighPriorityTask($task));
        }

        event(new TaskCreated($task));

        $this->reset();
    }

    public function render()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($task) {
                $task->jalali_due_date = Verta::instance($task->due_date)->formatJalaliDate();
                return $task;
            });

        return view('livewire.task-manager', [
            'tasks' => $tasks
        ]);
    }
}
