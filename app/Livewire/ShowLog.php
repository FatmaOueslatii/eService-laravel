<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ShowLog extends Component
{

//    public function showLogs(User $user)
//    {
//        $activities = Activity::query()
//            ->where('causer_id', $user->id)
//            ->orWhere(function ($q) use ($user) {
//                $q->where('subject_id', $user->id)
//                    ->where('subject_type', User::class);
//            })
//            ->orderBy('created_at', 'desc')
//            ->get();
//
//        return view('livewire.show-log', [
//            'user' => $user,
//            'activities' => $activities,
//        ]);
//    }

    #[Computed]
    public function activities()
    {
        return Activity::with('causer')
            ->latest()
            ->limit(20)
            ->get();
    }

    public function render()
    {
        return view('livewire.show-log');
    }


//    public function render()
//    {
//        return view('livewire.show-log');
//    }
}
