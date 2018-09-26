<?php

namespace App\Models\Common;

use App\Mail\Subscribe;
use DrewM\MailChimp\MailChimp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Subscriber extends Model
{
    public $timestamps = false;
    protected $fillable = ['state'];

    /**
     * @param $hash
     * @param $email
     */
    public function sendConfirmationMessage($hash, $email)
    {
        $activationLink  = request()->secure() ? 'https://' : 'http://';
        $activationLink .= request()->getHttpHost();
        $activationLink .= '/subscribers/activate?hash=' . $hash;

        Mail::to($email)->send( new Subscribe($activationLink) );
    }

    /**
     * @param $request
     * @return mixed|string
     */
    public function saveSubscriber($request)
    {
        $this->email = $request->email;
        $this->hash  = md5(uniqid(rand(), true));
        $this->type = 'subscriber';

        if( $this->where('email', $this->email)->first() )
            return false;
        else
            $this->save();

        return $this->hash;
    }

    /**
     * @param $email
     * Save user email to mailchimp service
     */
    public static function saveToMailChimp($email)
    {
        $mailChimp = new MailChimp('ecdee058c55cc8ff7440b1b8b818cfd2-us18');
        $result = $mailChimp->get('lists');
        $list_id = $result['lists'][0]['id'];

        $mailChimp->post("lists/$list_id/members", [
                'email_address' => $email,
                'status'        => 'subscribed',
            ]
        );
    }

    /**
     * @param $data
     * @return bool
     * save discount subscriber
     */
    public function saveDiscountSubscriber($data)
    {
        $this->email = $data['email'];
        $this->name  = $data['name'];
        $this->phone = $data['phone'];
        $this->hash  = md5(uniqid(rand(), true));
        $this->type  = 'discount';

        if( $this->where('email', $this->email)->first() )
            return false;
        else
            $this->save();

        return $this->hash;
    }
}
