<?php

namespace App\Services;

use App\Models\Library;
use App\Traits\ApiException;

class LibraryService
{
    use ApiException;

    public function update(Library $library, array $data): Library
    {
        $library = tap($library)->update($data);
        if(!$library){
            $this->badRequestException(['error' => 'Could not register library']);
        }
        return $library;
    }
}
