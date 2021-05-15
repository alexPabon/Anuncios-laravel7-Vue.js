<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageStoreRequest;
use App\Mail\MessageRecivied;
use Illuminate\Support\Facades\Mail;

use Stevebauman\Purify\Facades\Purify;
use App\Traits\AddressIp;

class MessageContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         
        return $this->create();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //guarda la direccion Ip del cliente
        AddressIp::guardarIp();     

        return view('mailContact.formContact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MessageStoreRequest  $storeRequest
     * @return \Illuminate\Http\Response
     */
    public function store(MessageStoreRequest $storeRequest)
    {
        //guarda la direccion Ip del cliente
        AddressIp::guardarIp(); 
        
        $contact = env('MAIL_CONTACT');

        $requestClean = Purify::clean($storeRequest->post());        
        
        Mail::to($contact)->queue(new MessageRecivied($requestClean));       
        return ['success'=>"El Email se ha enviado correctamente!"];
    }
}

    
