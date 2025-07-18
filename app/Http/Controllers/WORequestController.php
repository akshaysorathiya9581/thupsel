<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use App\Models\WORequest;
use Illuminate\Http\Request;

class WORequestController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage wo request')) {
            $woRequests = WORequest::where('parent_id', parentId())->get();
            return view('wo_request.index', compact('woRequests'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $clients = User::where('parent_id', parentId())->where('type', 'client')->get()->pluck('name', 'id');
        $clients->prepend(__('Select Client'), '');

        $users = User::where('parent_id', parentId())->where('type', '!=', 'client')->get()->pluck('name', 'id');
        $users->prepend(__('Select User'), '');

        $assets = Asset::where('parent_id', parentId())->get()->pluck('name', 'id');
        $assets->prepend(__('Select Asset'), '');

        $priority=WORequest::$priority;
        $status=WORequest::$status;
        $time=WORequest::$time;
        return view('wo_request.create', compact('users', 'assets','clients','priority','status','time'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create wo request')) {
            $validator = \Validator::make(
                $request->all(), [
                    // 'request_detail' => 'required',
                    // 'client' => 'required',
                    // 'asset' => 'required',
                    // 'priority' => 'required',
                    // 'due_date' => 'required',
                    // 'assign' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $wORequest = new WORequest();
            $wORequest->request_detail = !empty($request->request_detail) ? $request->request_detail : null;
            $wORequest->client         = !empty($request->client) ? $request->client : 0;
            $wORequest->asset          = !empty($request->asset) ? $request->asset : 0;
            $wORequest->priority       = !empty($request->priority) ? $request->priority : null;
            $wORequest->due_date       = !empty($request->due_date) ? $request->due_date : null;
            $wORequest->status         = !empty($request->status) ? $request->status : null;
            $wORequest->assign         = !empty($request->assign) ? $request->assign : 0;
            $wORequest->notes = !empty($request->notes)?$request->notes:null;
            $wORequest->preferred_date = !empty($request->preferred_date)?$request->preferred_date:null;
            $wORequest->preferred_time = !empty($request->preferred_time)?$request->preferred_time:null;
            $wORequest->preferred_note = !empty($request->preferred_note)?$request->preferred_note:null;
            $wORequest->parent_id = parentId();
            $wORequest->save();

            return redirect()->route('wo-request.index')->with('success', __('WO Request successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        $wORequest=WORequest::find($id);
        return view('wo_request.show', compact('wORequest'));
    }


    public function edit($id)
    {

        $wORequest=WORequest::find($id);

        $clients = User::where('parent_id', parentId())->where('type', 'client')->get()->pluck('name', 'id');
        $clients->prepend(__('Select Client'), '');

        $users = User::where('parent_id', parentId())->where('type', '!=', 'client')->get()->pluck('name', 'id');
        $users->prepend(__('Select User'), '');

        $assets = Asset::where('parent_id', parentId())->get()->pluck('name', 'id');
        $assets->prepend(__('Select Asset'), '');

        $priority=WORequest::$priority;
        $status=WORequest::$status;
        $time=WORequest::$time;

        return view('wo_request.edit', compact('users', 'assets','wORequest','clients','priority','status','time'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit wo request')) {
            $validator = \Validator::make(
                $request->all(), [
                    // 'request_detail' => 'required',
                    // 'client' => 'required',
                    // 'asset' => 'required',
                    // 'priority' => 'required',
                    // 'due_date' => 'required',
                    // 'assign' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $wORequest=WORequest::find($id);
            $wORequest->request_detail = !empty($request->request_detail) ? $request->request_detail : null;
            $wORequest->client         = !empty($request->client) ? $request->client : 0;
            $wORequest->asset          = !empty($request->asset) ? $request->asset : 0;
            $wORequest->priority       = !empty($request->priority) ? $request->priority : null;
            $wORequest->due_date       = !empty($request->due_date) ? $request->due_date : null;
            $wORequest->status         = !empty($request->status) ? $request->status : null;
            $wORequest->assign         = !empty($request->assign) ? $request->assign : 0;
            $wORequest->notes = !empty($request->notes)?$request->notes:null;
            $wORequest->preferred_date = !empty($request->preferred_date)?$request->preferred_date:null;
            $wORequest->preferred_time = !empty($request->preferred_time)?$request->preferred_time:null;
            $wORequest->preferred_note = !empty($request->preferred_note)?$request->preferred_note:null;
            $wORequest->save();

            return redirect()->route('wo-request.index')->with('success', __('WO Request successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete wo request')) {
            $wORequest=WORequest::find($id);
            $wORequest->delete();
            return redirect()->route('wo-request.index')->with('success', __('WO Request successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
