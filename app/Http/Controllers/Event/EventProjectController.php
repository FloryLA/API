<?php

namespace App\Http\Controllers\Event;

use App\Event;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class EventProjectController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $projects=$event->project;
        return $this->showAll($projects);
    }

 
}
