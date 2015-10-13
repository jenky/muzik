<?php

namespace App\Http\Requests\API\v1;

use App\Http\Requests\ApiRequest;
use App\Models\Track;

class TrackRequest extends ApiRequest
{
    /**
     * The resource name.
     * 
     * @var string
     */
    protected $resource = 'track';

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
        return get_rules(Track::$rules, $this->route('tracks'));
    }
}
