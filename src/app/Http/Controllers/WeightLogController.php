<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\WeightTargetRequest;
use App\Http\Requests\GoalWeightRequest;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $latestLog = $user->weightLogs()->latest('date')->first();
        $targetWeight = $user->weightTarget?->target_weight;

        $logs = $user->weightLogs()->orderBy('date', 'desc')->paginate(8);

        return view('logs', compact('user', 'logs', 'latestLog', 'targetWeight'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $latestLog = $user->weightLogs()->latest('date')->first();
        $targetWeight = $user->weightTarget?->target_weight;

        $from = $request->input('from');
        $to = $request->input('to');

        $query = WeightLog::where('user_id', auth()->id());

        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        } elseif ($from) {
            $query->where('date', '>=', $from);
        } elseif ($to) {
            $query->where('date', '<=', $to);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        return view('logs', [
            'logs' => $logs,
            'from' => $from,
            'to' => $to,
            'count' => $logs->count(),
            'latestLog' => $latestLog,
            'targetWeight' =>$targetWeight
        ]);
    }

    public function show()
    {
        $user = Auth::user();
        $targetWeight = $user->weightTarget?->target_weight;

        return view('goal_setting', compact('user', 'targetWeight'));
    }

    public function store(WeightLogRequest $request)
    {
        WeightLog::create(
            $request->only([
                'date',
                'weight',
                'calories',
                'exercise_time',
                'exercise_content'
            ]) + ['user_id' => auth()->id()]
        );

        return redirect('/weight_logs');
    }

    public function goalUpdate(GoalWeightRequest $request)
    {
        $weightTarget = WeightTarget::find($request->id);

        if (!$weightTarget) {
            return redirect('/weight_logs/goal_setting')->withErrors(['goal_weight' => '目標体重が見つかりません。']);
        }

        $weightTarget->update([
            'target_weight' => $request->goal_weight,
        ]);

        return redirect('/weight_logs');
    }

    public function detail($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
        return view('detail', compact('log'));
    }

    public function logUpdate(WeightLogRequest $request, $weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);

        $log->date = $request->date;
        $log->weight = $request->weight;
        $log->calories = $request->calories;
        $log->exercise_time = $request->exercise_time;
        $log->exercise_content = $request->exercise_content;
        $log->save();

        return redirect('/weight_logs');
    }

    public function destroy($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
        $log->delete();

        return redirect('/weight_logs');
    }
}
