<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommonRequest;
use App\Models\Common\Document;
use App\Models\Admin\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $page = $request->has('page') ? $request->page*$paginate-$paginate : 0;
        $reports = Report::paginate($paginate);

        return view('admin.reports.index', compact('reports', 'page'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function edit($id)
    {
        $report = Report::with('documents')->findOrFail($id);

        return view('admin.reports.create', compact('report'));
    }

    public function store(CommonRequest $request)
    {
        $report = new Report;

        $this->saveReport($request, $report);

        return redirect()->route('reports.index')
            ->with(['message' => 'Отчет сохранён', 'class' => 'success']);
    }

    private function saveReport(CommonRequest $request, $report)
    {
        $input = $request->except('_token', '_method', 'documents', 'image', 'url', 'document_titles');
        $input['alias'] = $request->alias ? $request->alias : str_slug($request->title_ru);

        if ($request->has('image')) {
            $input['certificate'] = $report->saveCertifecate($request->image, 'reports', 2000);
        }
        if ($request->has('document_titles')) {
            foreach ($request->document_titles as $document_id => $document_title){
//                if ($document_title){
//                    Document::whereId($document_id)->update(['title' => $document_title]);
//                }
                Document::whereId($document_id)->update(['title' => $document_title]);
            }

        }
        $report->fill($input);
        $report->save();

        if ($request->has('documents')){

            foreach ($request->documents as $document){
                $doc_name = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME).'_'.$report->id.'.'.$document->getClientOriginalExtension();
                $doc = Document::firstOrCreate([
                    'path' => $doc_name,
                    'type' => $document->getClientOriginalExtension(),
                    'report_id' => $report->id
                ]);
                $doc->save();
                $document->move(storage_path() . '/app/documents', $doc_name);
            }
        }
    }

    public function update(CommonRequest $request, $id)
    {
        $report = Report::findOrFail($id);

        $this->saveReport($request, $report);

        return redirect($request->url)
            ->with(['message' => 'Отчет сохранён', 'class' => 'success']);
    }

    public function destroyAll(Request $request)
    {
        if($request->reports && count($request->reports)){

            Report::destroy($request->reports);

            return redirect()->route('reports.index')
                ->with(['message' => 'Отчеты удалены', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одного отчета', 'class' => 'warning']);
        }

    }
    public function destroy( Report $report ) {

        if ($report->delete()){
            return response()->json( [
                "class" => "success", "message" => 'Отчет удален'
            ] );
        }
    }
}