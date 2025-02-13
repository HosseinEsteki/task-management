import './bootstrap';
import 'livewire-turbolinks';

Echo.channel('tasks')
    .listen('TaskCreated', (e) => {
        Livewire.emit('taskCreated', e.task);
    })
    .listen('TaskUpdated', (e) => {
        Livewire.emit('taskUpdated', e.task);
    });
