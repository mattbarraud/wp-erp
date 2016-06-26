<?php
namespace WeDevs\ERP\HRM\Models;
use WeDevs\ERP\Framework\Model;
/**
 * Class Education
 *
 * @package WeDevs\ERP\HRM\Models
 */
class Qualifications extends Model {
    protected $table = 'erp_hr_qualification';
    protected $fillable = [ 'employee_id', 'qualification_provider', 'course_name', 'finished', 'notes' ];
}
