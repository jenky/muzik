<?php

namespace App\Http\Requests\API\v1;

use App\Http\Requests\ApiRequest;
use App\Models\Artist;

class ArtistRequest extends ApiRequest
{
    /**
     * The resource name.
     * 
     * @var string
     */
    protected $resource = 'artist';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return get_rules(Artist::$rules, $this->route('artists'));
    }
}
