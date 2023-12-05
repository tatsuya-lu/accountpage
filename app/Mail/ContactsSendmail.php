<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactsSendmail extends Mailable
{
    use Queueable, SerializesModels;

    //プロパティを定義
    private $company;
    private $name;
    private $tel;
    private $email;
    private $birthday;
    private $gender;
    private $profession;
    private $body;

    /**
     * Create a new message instance.
     */
    public function __construct($inputs)
    {
        //コンストラクタでプロパティに値を格納
        $this->company = $inputs['company'];
        $this->name = $inputs['name'];
        $this->tel = $inputs['tel'];
        $this->email = $inputs['email'];
        $this->birthday = $inputs['birthday'];
        $this->gender = $inputs['gender'];
        $this->profession = $inputs['profession'];
        $this->body = $inputs['body'];
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('example@gmail.com')
            ->subject('自動送信メール')
            ->view('contact.mail')
            ->with([
                'company' => $this->company,
                'name' => $this->name,
                'tel' => $this->tel,
                'email' => $this->email,
                'birthday' => $this->birthday,
                'gender' => $this->gender,
                'profession' => $this->profession,
                'body'  => $this->body,
            ]);
    }
}
