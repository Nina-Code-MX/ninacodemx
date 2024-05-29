<?php

namespace App\Livewire\Public;

use App\Helpers\LocaleHelper;
use App\Models\ContactForm;
use App\Models\Service;
use App\Models\Translation;
use App\Traits\ReCaptchaV3;
use App\Traits\SendGridTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Livewire\Component;
use SendGrid;
use Illuminate\Support\Facades\Cookie;

class Pricing extends Component
{
    use ReCaptchaV3, SendGridTrait;

    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'pricing';
    public $pageTitle = 'Precios';
    public $formData = [
        'first_name' => '',
        'last_name' => '',
        'company' => '',
        'email' => '',
        'phone' => '',
        'phoneCountry' => '',
        'country' => '',
        'service' => '',
        'message' => '',
        'reCaptcha' => '',
        'ip' => ''
    ];
    public $submit_message = '';
    private $sendgrid;

    /**
     * Mount
     * @param Request $request
     * @param null $lang
     * @return void
     */
    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);

        $this->heroData['h1'] = __('Precios');
        $this->heroData['h2'] = __('pages/pricing.h2');
        $this->heroData['p'] = __('pages/pricing.hero.p');
        $this->pageTitle = __('Precios');
        $this->sendgrid = new SendGrid(env('SENDGRID_API_KEY', ''));

        if ($request->has('service')) {
            $this->formData['service'] = $this->getSlugTranslation($request->get('service'));
        }
    }

    /**
     * Render view
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $services = Service::orderBy('order')->get();

        return view('livewire.public.pricing', ['services' => $services])
            ->layout('components.layouts.app', [
                'heroData' => $this->heroData,
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }

    /**
     * Send contact form data
     * @return \Livewire\Redirector | void
     */
    public function formDataProcess()
    {
        $this->submit_message = '';

        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                // Get reCaptcha response
                $reCaptchaResponse = $this->reCaptchaV3($this->formData['reCaptcha'], $this->formData['ip']);

                if ($reCaptchaResponse == false) {
                    $response['text'] = __('Google reCaptcha inválido.');
                    $validator->errors()->add('formData.reCaptcha', __('Google reCaptcha inválido.'));
                }
            });
        })->validate([
            'formData.first_name' => 'required|min:2',
            'formData.last_name' => 'required|min:2',
            'formData.company' => 'required|min:2',
            'formData.email' => 'required|email',
            'formData.phone' => 'required|min:10',
            'formData.phoneCountry' => 'required|min:2',
            'formData.country' => 'required|min:2|max:50',
            'formData.service' => 'required|exists:services,id',
            'formData.message' => 'required|min:5|max:100',
            'formData.reCaptcha' => 'required|min:1',
            'formData.ip' => 'required|ip',
        ],
        [],
        [
            'formData.first_name' => __('Nombre(s)'),
            'formData.last_name' => __('Apellido(s)'),
            'formData.company' => __('Company'),
            'formData.email' => __('Email'),
            'formData.phone' => __('Teléfono'),
            'formData.phoneCountry' => __('País'),
            'formData.country' => __('País'),
            'formData.service' => __('mainmenu.services'),
            'formData.message' => __('Mensaje'),
            'formData.reCaptcha' => __('ReCaptcha'),
            'formData.ip' => __('IP')
        ]);

        $service = Service::find($this->formData['service']);

        $contactData = array_merge($this->formData, ['lang' => Cookie::get('lang') ?: config('app.locale'), 'service_name' => $service->name ?? 'Desconocido']);
        $createContact = $this->createContact(env('SENDGRID_LIST_PRICING', ''), $contactData);

        try {
            ContactForm::create([
                'page' => url()->current(),
                'service' => $service->name,
                'ip_address' => $contactData['ip'],
                'first_name' => $contactData['first_name'],
                'last_name' => $contactData['last_name'],
                'company' => $contactData['company'],
                'phone' => $contactData['phoneCountry'] . $contactData['phone'],
                'email' => $contactData['email'],
                'message' => $contactData['message']
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        if (isset($createContact['status']) && $createContact['status'] == 202) {
            $template = view(
                'emails.generic',
                [
                    'lang' => app()->getLocale(),
                    'code_short' => 'SLCTD',
                    'code_long' => __('Cotización'),
                    'subject' => __('pages/pricing.mail.subject', ['service' => $service->name ?? 'Desconocido']),
                    'welcome' => __('pages/pricing.mail.welcome', ['full_name' => $contactData['first_name'] . ' ' . $contactData['last_name']]),
                    'message' => __('pages/pricing.mail.message', ['service' => $service->name ?? 'Desconocido']) . ' <p style="font-family: courier;background: #f0f0f0; border: 1px solid #cccccc; font-size: .75rem; font-style: italic; padding: 0.5rem; text-align: center;">' . $contactData['message']
                ]
            )->render();

            $sendEmail = $this->mailSend(
                __('pages/pricing.mail.subject', ['service' => $service->name ?? 'Desconocido']),
                'text/html',
                $template,
                ['services'],
                $contactData
            );

            if (isset($sendEmail['status']) && $sendEmail['status'] == 202) {
                return redirect(request()->header('Referer'))->with('success', __('Gracias, en breve nos pondremos en contacto contigo'));
            }
        }

        $this->submit_message = __('Hubo un error al procesar la petición');
    }

    /**
     * Get slug translation
     * @return int
     */
    private function getSlugTranslation(string $slug): int
    {
        if (app()->getLocale() === 'es') {
            return Service::where('slug', $slug)->get()->first()->id ?? '';
        }

        $Translation = Translation::where('model_name', 'Service')->whereJsonContains('value->slug', $slug)->get()->first();

        if (!$Translation) {
            return Service::where('slug', $slug)->get()->first()->id ?? '';
        }

        $Service = Service::find($Translation->model_id);

        if (!$Service) {
            return Service::where('slug', $slug)->get()->first()->id ?? '';
        }

        return $Service->id;
    }
}
