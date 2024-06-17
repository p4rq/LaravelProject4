<?php

namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Models\MainTopic;

class TopicController extends Controller
{
    public function index()
    {
        $mainTopics = MainTopic::with('subTopics.concepts')->get();
        return view('topics.index', compact('mainTopics'));
    }

    public function show($id)
    {
        $mainTopic = MainTopic::with('subTopics.concepts')->findOrFail($id);
        return view('topics.oop', compact('mainTopic'));
    }
}
