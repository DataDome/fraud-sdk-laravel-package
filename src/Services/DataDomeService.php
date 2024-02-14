<?php

namespace DataDome\FraudSdkLaravel\Services;

use DataDome\FraudSdkSymfony\DataDome;
use DataDome\FraudSdkSymfony\Models\DataDomeEvent;
use Illuminate\Http\Request;

class DataDomeService
{
    private DataDome $dd;

    public function __construct(DataDome $dd) {
        $this->dd = $dd;
    }

    public function collect(Request $request, DataDomeEvent $event) {
        return $this->dd->collect($request, $event);
    }

    public function validate(Request $request, DataDomeEvent $event) {
        return $this->dd->validate($request, $event);
    }
}
