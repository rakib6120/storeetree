<?php

namespace App\Http\Controllers\frontend;

use App\Models\PaymentLog;
use Illuminate\Http\Request;
use App\Repositories\VideoParse;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use net\authorize\api\contract\v1\PaymentType;
use net\authorize\api\constants\ANetEnvironment;
use App\Http\Controllers\frontend\BaseController;
use net\authorize\api\contract\v1\CreditCardType;
use net\authorize\api\contract\v1\TransactionRequestType;
use net\authorize\api\contract\v1\CreateTransactionRequest;
use net\authorize\api\contract\v1\MerchantAuthenticationType;
use net\authorize\api\controller\CreateTransactionController;

class PaymentController extends BaseController
{
    public function pay()
    {
        $cart       = Session::get('cart');
        $storyItems = collect(Session::get('storyItems'));

        // Cheking is cart necessary data.
        if(!$cart) return redirect()->route('create-your-story.step-1');

        // Cheking is all cart story was uploaded or redirect to upload.
        if (array_diff($cart['questions'], $storyItems->pluck('question_id')->toArray())) {
            return redirect()->route('create-your-story.step-4');
        }

        return view('frontend.payment');
    }

    public function handlePayment(Request $request)
    {
        $request->validate([
            'owner' => "required|string|min:3",
            'cardNumber' => "required|digits:16",
            'expiration' => "required|date_format:m/Y",
            'cvv' => "required|integer|digits_between:3,4"
        ]);

        $cart = Session::get('cart');
        if(!$cart) return redirect()->route('create-your-story.step-1');

        $storyItems = collect(Session::get('storyItems'));

        // Cheking is all cart story was uploaded or redirect to upload.
        if (array_diff($cart['questions'], $storyItems->pluck('question_id')->toArray())) {
            return redirect()->route('create-your-story.step-4');
        }

        $expirations = explode('/', $request->expiration);
        $input = $request->except('expiration', '_token') + ['expiration-month' => $expirations[0], 'expiration-year' => $expirations[1], 'amount' => config('plans.' . $cart['plan']. '.price')];

        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchantAuthentication = new MerchantAuthenticationType();
        $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $input['cardNumber']);

        // Create the payment data for a credit card
        $creditCard = new CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($input['expiration-year'] . "-" . $input['expiration-month']);
        $creditCard->setCardCode($input['cvv']);

        // Add the payment data to a paymentType object
        $paymentOne = new PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($input['amount']);
        $transactionRequestType->setPayment($paymentOne);

        // Assemble the complete transaction request
        $requests = new CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new CreateTransactionController($requests);
        $response = $controller->executeWithApiResponse(ANetEnvironment::SANDBOX);

        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $message_text = $tresponse->getMessages()[0]->getDescription() . ", Transaction ID: " . $tresponse->getTransId();

                    $paymentLog = PaymentLog::create([
                        'amount' => $input['amount'],
                        'response_code' => $tresponse->getResponseCode(),
                        'transaction_id' => $tresponse->getTransId(),
                        'auth_id' => $tresponse->getAuthCode(),
                        'message_code' => $tresponse->getMessages()[0]->getCode(),
                        'name_on_card' => trim($input['owner']),
                        'quantity' => 1
                    ]);

                    VideoParse::mergeChunkVideos($paymentLog->id, $cart, $storyItems);
                    Alert::success($message_text);

                    return redirect('/');
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type = "error_msg";

                    if ($tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = "error_msg";
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $message_text = 'There were some issue with the payment. Please try again later.';
                $msg_type = "error_msg";

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                    $msg_type = "error_msg";
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                    $msg_type = "error_msg";
                }
            }
        } else {
            $message_text = "No response returned";
            $msg_type = "error_msg";
        }
        return back()->with($msg_type, $message_text);
    }
}
