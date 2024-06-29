<?php

namespace App\Livewire\Public;

use App\Models\Article;
use App\Models\Translation;
use Illuminate\Http\Request;
use Livewire\Component;

class Articles extends Component
{

    public $heroData = ['h1' => false, 'h2' => false,'p' => false, 'action' => false ];
    public $pageId = 'articles';
    public $pageTitle = 'Articulos';
    public $slug = null;

    public function mount(Request $request, string $year = null, string $month = null, string $slug = null)
    {
        $this->slug = $slug;

        if (!$this->slug) {
            $this->heroData['h1'] = __('pages/articles.hero.h1');
            $this->heroData['h2'] = __('pages/articles.hero.h2');
            $this->heroData['p'] = __('pages/articles.hero.p');
        }

        $this->pageTitle = __('Articulos');
    }

    public function render()
    {
        $layoutSet = [
            'heroData' => $this->heroData,
            'pageId' => $this->pageId,
            'pageTitle' => $this->pageTitle
        ];

        if ($this->slug) {
            unset($layoutSet['heroData']);

            $Articles = $this->getSlugTranslation();

            if ($Articles) {
                $Articles = $Articles;
            } else {
                abort(404);
            }
            
            $layoutSet['pageTitle'] = $Articles['name'];
            $this->pageTitle = $Articles['name'];
        } else {
            $Articles = \App\Models\Article::orderBy('title')->get();
        }

        return view('livewire.public.articles' . ($this->slug ? '_slug' : ''), ['articles' => $Articles])
            ->layout('components.layouts.app', $layoutSet);
    }


    /**
     * Get slug translation
     * @return Article
     */

     private function getSlugTranslation(): Article
     {
        if(app()->getLocale() === 'es') {
            return Article::where('slug', $this->slug)->get()->first();
        }

        $Translation = Translation::where('model_name', 'Article')->whereJsonContains('value->slug',$this->slug)->get()->first();

        if(!$Translation){
            return Article::where('slug', $this->slug)->get()->first();
        }

        $Article = Article::find($Translation->model_id);

        if(!$Article){
            return Article::where('slug', $this->slug)->get()->first();
        }

        return $Article;
     }

}

