<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;
 
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

      $data['latest'] = DB::table('products')
                          ->where('status',1)
                          ->orderBy('id','desc')
                          ->limit(1)
                          ->get();

      $data['populars'] = DB::table('products')->where('popular',1)
                          ->limit(5)
                           ->orderBy('id','desc')
                           ->get();

      $data['products'] = DB::table('products')
                          ->where('status',1)
                          ->orderBy('id','desc')
                          ->get();

       return view('index', $data);
    }

    public function products($name)
    {

      $categories  = DB::table('categories')->where('name',str_replace('_', ' ', $name))->first();

      $data['products'] = DB::table('products')
                        ->where('category_id',$categories->id)
                        ->where('products.status',1)
                        ->latest()
                        ->paginate(10);
                      
       return view('products', $data);
    }


    public function productdetail($slug)   
    {
      $data['menus'] = DB::table('categories')->where('status',1)->get();
      $data['products'] = DB::table('products')
                        ->where('slug',$slug)
                         ->join('categories','categories.id','=','products.category_id')
                        ->select('products.*','categories.name as catname')
                        ->where('products.status',1)->first();
      $data['reviews'] = DB::table('rating_review')
                            ->join('users','users.id','=','rating_review.user_id')
                            ->select('rating_review.*','users.name')
                            ->where('product_id',$slug)->get();

     return view('product_detail', $data);
    }

    public function generatePDF($slug)   
    {
            $pdfdata = DB::table('products')
                        ->where('slug',$slug)
                        ->where('status',1)->first();
            $data = [ 
                      'title' => $pdfdata->title,
                      'image' => $pdfdata->e_file
            ];
          
            $pdf = PDF::loadView('epaper-pdf', $data);
        
            return $pdf->stream('E-Paper.pdf');
    }

   public function myaccount($slug)     
    {
      $data['user'] = User::where('slug',Auth::user()->slug)->first();
      //dd($user);
      return view('front.myaccount',$data);
    } 

   public function composeEmail(Request $request) {
      $mail = new PHPMailer(true);     // Passing `true` enables exceptions

      try {

          // Email server settings
          $mail->SMTPDebug = 0;
          $mail->isSMTP();
          $mail->Host = 'smtp.example.com';             //  smtp host
          $mail->SMTPAuth = true;
          $mail->Username = 'urmila.codewire@gmail.com';   //  sender username
          $mail->Password = 'Urmila@0129';       // sender password
          $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
          $mail->Port = 587;                          // port - 587/465

          $mail->setFrom('urmila.codewire@gmail.com', 'SenderName');
          $mail->addAddress($request->emailRecipient);
          $mail->addCC($request->emailCc);
          $mail->addBCC($request->emailBcc);

          $mail->addReplyTo('urmila.codewire@gmail.com', 'SenderReplyName');

          if(isset($_FILES['emailAttachments'])) {
              for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                  $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
              }
          }


          $mail->isHTML(true);                // Set email content format to HTML

          $mail->Subject = "for testing";
          $mail->Body    = "This is testing mail.";

          // $mail->AltBody = plain text version of email body;

          if( !$mail->send() ) {
              return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
          }
          
          else {
              return back()->with("success", "Email has been sent.");
          }

      } catch (Exception $e) {
           return back()->with('error','Message could not be sent.');
      }
  }
}
