<?php

namespace App\Http\Controllers;

use App\Models\ServicePart;
use App\Models\ServiceTask;
use App\Models\Category;
use Illuminate\Http\Request;

class ServicePartController extends Controller
{

    public function index(Request $request)
    {
        if (\Auth::user()->can('manage service & part')) {
            $category = Category::where('type', 'inventory')->orderBy('id', 'desc')->pluck('name', 'id')->toArray();

            $query = ServicePart::with('category')->where('parent_id', parentId());

            // Apply category filter if it's an AJAX request
            if ($request->ajax() && $request->has('category_id')) {
                if (!empty($request->category_id)) {
                    $query->where('cat_id', $request->category_id);
                }

                $serviceParts = $query->get();

                return response()->json([
                    'html' => view('service_part.service_parts_table_rows', compact('serviceParts'))->render()
                ]);
            }

            // For normal page load
            $serviceParts = $query->get();
            return view('service_part.index', compact('serviceParts', 'category'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function create()
    {   
        $category = Category::where('type', 'inventory')->orderBy('id', 'desc')->pluck('name', 'id')->toArray();

        return view('service_part.create', compact('category'));
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create service & part')) {
            $validator = \Validator::make(
                $request->all(), [
                    'cat_id' => 'required',
                    'title' => 'required',
                    'sku' => 'required',
                    'unit' => 'required',
                    'price' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $servicePart = new ServicePart();
            $servicePart->cat_id = $request->cat_id;
            $servicePart->title = $request->title;
            $servicePart->sku = $request->sku;
            $servicePart->price = $request->price;
            $servicePart->unit = $request->unit;
            $servicePart->description = $request->description;
            $servicePart->type = $request->type;
            $servicePart->parent_id = parentId();
            $servicePart->save();

            if ($request->type=='service' && count($request->task) > 0 && count($request->duration) > 0) {
                $tasks = $request->task;
                $durations = $request->duration;
                $task_descriptions = $request->task_description;
                foreach ($tasks as $key => $task) {
                    if(!empty($task) && !empty($durations)){
                        $serviceTask = new ServiceTask();
                        $serviceTask->service_id = $servicePart->id;
                        $serviceTask->task = $task;
                        $serviceTask->duration = $durations[$key];
                        $serviceTask->description = $task_descriptions[$key];
                        $serviceTask->save();
                    }

                }
            }
            return redirect()->route('services-parts.index')->with('success', __('Service & Part successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function show($id)
    {
        $servicePart=ServicePart::find($id);
        return view('service_part.show',compact('servicePart'));
    }

    public function edit($id)
    {   
        $category = Category::where('type', 'inventory')->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
        $servicePart = ServicePart::find($id);

        return view('service_part.edit',compact('servicePart', 'category'));
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit service & part')) {
            $validator = \Validator::make(
                $request->all(), [
                    'cat_id' => 'required',
                    'title' => 'required',
                    'sku' => 'required',
                    'unit' => 'required',
                    'price' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $servicePart=ServicePart::find($id);
            $servicePart->cat_id = $request->cat_id;
            $servicePart->title = $request->title;
            $servicePart->sku = $request->sku;
            $servicePart->price = $request->price;
            $servicePart->unit = $request->unit;
            $servicePart->description = $request->description;
            $servicePart->save();

            if ($servicePart->type=='service' && count($request->task) > 0 && count($request->duration) > 0) {
                $id = $request->id;
                $tasks = $request->task;
                $durations = $request->duration;
                $task_descriptions = $request->task_description;
                foreach ($tasks as $key => $task) {

                    if (isset($id[$key]) && !empty($id[$key])) {
                        $serviceTask = ServiceTask::find($id[$key]);
                    } else {
                        $serviceTask = new ServiceTask();
                        $serviceTask->service_id = $servicePart->id;
                    }

                    $serviceTask->task = $task;
                    $serviceTask->duration = $durations[$key];
                    $serviceTask->description = $task_descriptions[$key];
                    $serviceTask->save();
                }
            }

            return redirect()->route('services-parts.index')->with('success', __('Service & Part successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('delete service & part')) {
            $servicePart=ServicePart::find($id);
            $servicePart->delete();
            return redirect()->route('services-parts.index')->with('success', __('Service & Part successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function taskDestroy(Request $request)
    {

        if(!empty($request->id)){
            $task = ServiceTask::find($request->id);
            $task->delete();
        }
        return 1;
    }
}