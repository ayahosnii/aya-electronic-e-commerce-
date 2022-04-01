<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Models\Languages;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{

    public function index()
    {
        $languages = Language::select()->paginate();
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }


    public function store(LanguageRequest $request)
    {
        //validation request
        // [DONE]

        //insert db
        try{
            Language::create($request -> except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'حدث خطأ برجاء المحاولة فيما بعد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function show(Languages $languages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $language = Language::find($id);
            if(!$language) {
                return redirect()->route('admin.languages', $id)
                    ->with(['error' => 'هذه اللغة غير موجوده']);
            }

            $language -> delete();
            return redirect()->route('admin.languages')
                ->with(['success' => 'تم حذف اللغة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'حدث خطأ برجاء المحاولة فيما بعد']);{

            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $languages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $language = Language::select()->find($id);

        if(!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة']);
        }
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\language  $languages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, LanguageRequest $request)
    {
        try {
            $language = Language::find($id);
            if(!$language) {
                return redirect()->route('admin.languages.edit', $id)
                    ->with(['error' => 'هذه اللغة غير موجوده']);
        }

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            $language -> update($request -> except('_token'));
            return redirect()->route('admin.languages')
                ->with(['success' => 'تم تحديث اللغة بنجاح']);

        } catch (\Exception $ex) {
                return redirect()->route('admin.languages')->with(['error' => 'حدث خطأ برجاء المحاولة فيما بعد']);{

            }
        }
    }
}
