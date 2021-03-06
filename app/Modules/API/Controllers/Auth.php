<?php

namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use Modules\API\Models\AuthModel;

class Auth extends ResourceController
{
	use ResponseTrait;
	protected $authModel;

	public function __construct()
	{
		$this->authModel = new AuthModel();
	}

	public function index()
	{
		$data = ["name" => "John Doe", "email" => "john@mail.com"];
		return view("\Modules\API\Views\index", $data);
	}

	public function privateKey()
	{
		$privateKey = <<<EOD
		-----BEGIN RSA PRIVATE KEY-----
		MIICWwIBAAKBgHgkntgvxvaBGz2rrhbXSf9UpUf9h2TdLjlNPSWS9B5QtEdpjhLh
		E+4bBgTifKdTXv9F6d17p/kNqfZ4V9fD/VCj4dBgXNRYVXegnFnlMqMZ0PIz2noj
		Tnxx1i8BMW4M48YVnoMZWLns6JxXd1u+2r87j3V0UDKoEiKEBupuoJlbAgMBAAEC
		gYAtDganqhsiHD6b/QL3O9tbLmIhQjmBINUR1h5lNdvodnl1AmeuOswfkfDK6ii3
		EzPf5VcToSjX5EDl1jGTD8Ox8enta8cRfpttpZD+uQyEVBIXSVC/e5TFfSnStCQ6
		5LK26Uab5lc1/PA1L/oQ5bv9tgmx7EesMdN2NxKzS/reAQJBAM0xNXPPQFToOCf1
		e/R0afmseaC5EOJiEoDLLWi4rOIinClC2ayjIDKl9/ldAO4mx3DkEIiVHYuJKV+A
		VzmAsFsCQQCV5El+MBbtmFkDEQwQJUG2fHQKGBSOQu4v1tp+TomDhp491sJXQDIS
		8TI2zMFK1ajrafhfmEmKqL4JDGt+ZAsBAkEAuPT8W5GbSW2xAMPUobs1s2p2kBuB
		Tq5cQ1/hZJ3iqEvOO5sYnvbDlSPpbAsbRZALAoVxKcxPv3E5q+4BscGANQJAcJWE
		ohRq1FEu4n/GaMYjInc+DWri3avmDea6PE6vOSw+5UHOvQxJ0DJ8Pe7zbEspUpFI
		7jyLWGvAOTmr78YjAQJAW55B8vNu1FPV/TJzDycD0HU0oCx6dDkkd6N89QF8NGQx
		rg3ivVcDXYWiBPg9+Mq4SOAcGgrNeL8CkaHU7id80A==
		-----END RSA PRIVATE KEY-----
		EOD;

		return $privateKey;
	}

	public function login()
	{
		$nip            = htmlspecialchars($this->request->getVar('nip'));
		$sysPassword   	= htmlspecialchars($this->request->getVar('sysPassword'));

		$pegawai = $this->authModel->getAuth($nip);

		if ($pegawai) :
			if ($pegawai['0']['sysActive'] == 'y') :
				if ($pegawai['0']['sysPassword'] == sha1($sysPassword)) :
					$secretKeys			= $this->privateKey();
					$issue_claim		= 'THE_CLAIM';
					// $audience_claim		= 'THE_AUDIENCE';
					$issuedate_claim	= time();
					$notbefore_claim	= $issuedate_claim + 10;
					$expire_claim		= $issuedate_claim + (60 * 525600); // 6 sec * 525600 min = 1 year in Calendar Year
					$alg 				= 'HS256';

					$payload = array(
						"iss" 	=> $issue_claim,
						"aud" 	=> $issue_claim,
						"iat" 	=> $issuedate_claim,
						"nbf" 	=> $notbefore_claim,
						"exp" 	=> $expire_claim
					);

					$token = JWT::encode($payload, $secretKeys, $alg);

					$status = [
						'status'	=> 200,
						'message'	=> 'Success!',
						'token'		=> $token,
						'expired'	=> $expire_claim,
						'data'		=> $pegawai
					];
					return $this->respond($status, 200);
				else :
					$status = [
						'status'	=> 401,
						'message'	=> 'Password tidak cocok dengan akun yang terdaftar'
					];
					return $this->respond($status, 401);
				endif;
			else :
				$status = [
					'status'	=> 401,
					'message'	=> 'Akun belum diaktifkan'
				];
				return $this->respond($status, 401);
			endif;
		else :
			$status = [
				'status'	=> 401,
				'message'	=> 'Akun tidak terdaftar'
			];
			return $this->respond($status, 401);
		endif;
	}

	public function otherMethod()
	{
		$segment = $this->request->uri->getSegment(3);

		$status = [
			'status'	=> 200,
			'message'	=> 'This is other method from Auth controller in API Module with data segment value = ' . $segment
		];
		return $this->respond($status, 200);
	}
}
