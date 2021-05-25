<?php

namespace Modules\API\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table      = 'rip_sysaccess';
    protected $primaryKey = 'sysId';
    protected $allowedFields = ['sysPassword'];

    protected $useTimestamps = FALSE;
    protected $useSoftDeletes = FALSE;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAuth($nip)
    {
        return $this->db->query('SELECT ms_pegawai.id_pegawai, ms_pegawai.nip, ms_pegawai.gelardpn, ms_pegawai.gelarblk, ms_pegawai.nama, rip_sysaccess.* FROM `ms_pegawai` LEFT JOIN `rip_sysaccess` ON `rip_sysaccess`.id_pegawai = `ms_pegawai`.id_pegawai WHERE ms_pegawai.`nip` = "'.$nip.'"')->getResultArray();        
    }
}