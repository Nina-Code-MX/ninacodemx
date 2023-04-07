<?php

namespace App\Http\Controllers\Api\V1\MailChimp;

use App\Http\Controllers\Controller;
use App\Traits\GuzzleHttp;
use App\Traits\ReCaptchaV3;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;

class NewsletterController extends Controller
{
    use GuzzleHttp, ReCaptchaV3;

    /**
     * Index
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $response = ['status' => 200, 'message' => 'Gracias! Se ha registrado a nuestra lista de distribución.'];

        $reCaptcha = $request->get('reCaptcha') ?? null;
        $email = $request->get('email') ?? null;
        $userIp = $request->get('userIp') ?? null;

        if (!$reCaptcha || !$email) {
            $response['status'] = 400;
            $response['message'] = 'Petición inválida.';

            return response()->json($response, $response['status']);
        }

        $reCaptchaResponse = $this->reCaptchaV3($reCaptcha, $userIp);

        if ($reCaptchaResponse == false) {
            $response = ['status' => 400, 'message' => 'reCaptcha inválido.'];
        }

        try {
            $Mailchimp = new ApiClient();
            $Mailchimp->setConfig([
                'apiKey' => env('MAILCHIMP_API_KEY', ''),
                'server' => env('MAILCHIMP_SERVER_PREFIX', '')
            ]);

            $member = $Mailchimp->lists->addListMember(env('MAILCHIMP_LIST_ID', ''), [
                'email_address' => $email,
                'status' => 'subscribed',
                'tags' => ['newsletter']
            ]);

            if (!isset($member->status) || $member->status != 'subscribed') {
                $response['status'] = 400;
                $response['message'] = 'No se pudo registrar a la lista de distribución.';
            }
        } catch (ApiException $e) {
            \Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $e->getResponseBody()]);

            $response['status'] = 400;
            $response['message'] = 'No se pudo registrar a la lista de distribución.';
        } catch (ClientException $e) {
            \Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $e->getResponse()->getBody()->getContents() ?? []]);

            $response['status'] = 400;
            $response['message'] = 'No se pudo registrar a la lista de distribución.';
        } catch (\Exception $e) {
            \Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $e->getMessage()]);

            $response['status'] = 400;
            $response['message'] = 'No se pudo registrar a la lista de distribución.';
        }

        return response()->json($response, $response['status']);
    }
}
