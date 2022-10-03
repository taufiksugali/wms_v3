<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $logged_in = session()->get('logged_in');
			if($logged_in != TRUE || empty($logged_in))
			{
				#user not logged in
				session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your session has been expired. Please sign in again.</div>
            	<div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            	
				return redirect()->to(base_url('auth'));
			}
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}