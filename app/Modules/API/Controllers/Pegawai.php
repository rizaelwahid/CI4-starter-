<?php

namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\Key;
use \Firebase\JWT\JWT;
use Modules\API\Controllers\Auth;
use Modules\API\Models\PegawaiModel;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control, Authorization, X-Requested_With");
header("Access-Control-Allow-Age: 3000");
header("Access-Control-Allow-Methods: GET");

class Pegawai extends ResourceController
{
	use ResponseTrait;
	protected $pegawaiModel;

	public function __construct()
	{
		$this->forKey = new Auth();
		$this->pegawaiModel = new PegawaiModel();
	}

	public function index()
	{
		$secretKey		= $this->forKey->privateKey();
		$token			= null;
		$authHeader		= $this->request->getServer('HTTP_AUTHORIZATION');
		$arr			= explode(' ', $authHeader);
		$token			= $arr[1];

		$id_pegawai = htmlspecialchars($this->request->uri->getSegment(2));
		$pegawai 	= $this->pegawaiModel->getPegawai($id_pegawai);

		if ($token) :
			try {
				$decoded	= JWT::decode($token,  new Key($secretKey, 'HS256'));
				if ($decoded) {
					if ($pegawai['0']['id_pegawai']) :
						$status = [
							'status' => true,
							'data' 	 => $pegawai
						];
						return $this->respond($status, 200);
					else :
						$status = [
							'status' 	=> false,
							'message'	=> 'Data with id ' . $id_pegawai . ' not found',
						];
						return $this->respond($status, 404);
					endif;
				}
			} catch (\Exception $error) {
				$status = [
					'status'	=> false,
					'message'	=> 'Access denied, token invalid or expired',
					'error'		=> $error->getMessage()
				];
				return $this->respond($status, 400);
			}
		endif;
	}
}
