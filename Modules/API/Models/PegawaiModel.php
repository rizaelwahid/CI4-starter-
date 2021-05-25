<?php

namespace Modules\API\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table      = 'ms_pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $allowedFields = ['nip', 'nama'];

    protected $useTimestamps = FALSE;
    protected $useSoftDeletes = FALSE;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getPegawai($id_pegawai)
    {
        return $this->db->query('SELECT ms_pegawai.*, ms_agama.agama AS pAgama, ms_golongan.golongan, ms_golongan.keterangan, MAX(rip_pendidikan.pendidikan), ms_pendidikan.pendidikan, ms_spp.spp AS satuanKerja, ms_unit.unit AS unitKerja, ms_pekerjaan.pekerjaan AS istpekerjaan, bp.pekerjaan AS bppekerjaan, ib.pekerjaan AS ibpekerjaan, ms_jabatan.jabatan, rip_syscontact_attribute_value.cavValue AS email FROM `ms_pegawai` LEFT JOIN `ms_agama` ON `ms_agama`.id_agama = `ms_pegawai`.agama LEFT JOIN `ms_golongan` ON `ms_golongan`.id_golongan = `ms_pegawai`.golpkt INNER JOIN `rip_pendidikan` ON `rip_pendidikan`.id_pegawai = `ms_pegawai`.id_pegawai LEFT JOIN `ms_pendidikan` ON `ms_pendidikan`.id_pendidikan = `rip_pendidikan`.pendidikan LEFT JOIN `ms_spp` ON `ms_spp`.id_spp = `ms_pegawai`.spp LEFT JOIN `ms_unit` ON `ms_unit`.id_unit = `ms_pegawai`.unit LEFT JOIN `ms_pekerjaan` ON `ms_pekerjaan`.id_pekerjaan = `ms_pegawai`.sikerja LEFT JOIN `ms_pekerjaan` bp ON `bp`.id_pekerjaan = `ms_pegawai`.bpkerja LEFT JOIN `ms_pekerjaan` ib ON `ib`.id_pekerjaan = `ms_pegawai`.ibukerja LEFT JOIN `rip_jabatan` ON `rip_jabatan`.id_pegawai = `rip_jabatan`.id_pegawai LEFT JOIN `ms_jabatan` ON `ms_jabatan`.id_jabatan = `rip_jabatan`.namajbt LEFT JOIN `rip_syscontact_attribute_value` ON `rip_syscontact_attribute_value`.id_pegawai = `ms_pegawai`.id_pegawai WHERE ms_pegawai.`id_pegawai` = "'.$id_pegawai.'" AND ms_pendidikan.id_pendidikan = (SELECT MAX(pendidikan) FROM `rip_pendidikan` WHERE `id_pegawai` = "'.$id_pegawai.'" ) AND rip_jabatan.id_rip = (SELECT MAX(rip_jabatan.`id_rip`) FROM `rip_jabatan` WHERE `id_pegawai` = "'.$id_pegawai.'" )')->getResultArray();
    }
}