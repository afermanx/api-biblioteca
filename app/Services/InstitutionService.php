<?php

namespace App\Services;

use App\Models\Institution;
use App\Traits\ApiException;

class InstitutionService
{
    use ApiException;

   /**
    * It creates a new institution.
    *
    * @param array data The data to be used to create the institution.
    *
    * @return Institution An instance of the Institution model.
    */
    public function create(array $data): Institution
    {
        $institution  = Institution::create($data);
        if (!$institution) {
            $this->badRequestException(['error' => 'Unable to register the institution.']);
        }
        return $institution;
    }
}
