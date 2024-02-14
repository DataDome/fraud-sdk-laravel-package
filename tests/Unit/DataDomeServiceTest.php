<?php

namespace DataDome\FraudSdkLaravel\Tests\Unit;

use DataDome\FraudSdkSymfony\DataDome;
use DataDome\FraudSdkLaravel\Services\DataDomeService;
use DataDome\FraudSdkSymfony\Models\LoginEvent;
use DataDome\FraudSdkSymfony\Models\StatusType;
use DataDome\FraudSdkSymfony\Models\RegistrationEvent;
use DataDome\FraudSdkSymfony\Models\Session;
use DataDome\FraudSdkSymfony\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class DataDomeServiceTest extends TestCase
{
    /** @test */
    public function it_can_collect_login_event()
    {
        $dataDomeMock = $this->createMock(DataDome::class);

        $request = new Request();
        $account = "unittest@datadome.us";
        $loginEvent = new LoginEvent($account);

        $dataDomeMock->expects($this->once())
            ->method('collect')
            ->with($request, $loginEvent)
            ->willReturn('collected_data');

        $dataDomeService = new DataDomeService($dataDomeMock);

        $result = $dataDomeService->collect($request, $loginEvent);

        $this->assertEquals('collected_data', $result);
    }

    /** @test */
    public function it_can_collect_registration_event()
    {
        $dataDomeMock = $this->createMock(DataDome::class);

        $request = new Request();
        $account = "unittest@datadome.us";
        $registrationStatus = StatusType::Succeeded;
        $session = new Session();
        $user = new User();
        $registrationEvent = new RegistrationEvent($account, $registrationStatus, $session, $user);

        $dataDomeMock->expects($this->once())
            ->method('collect')
            ->with($request, $registrationEvent)
            ->willReturn('collected_data');

        $dataDomeService = new DataDomeService($dataDomeMock);

        $result = $dataDomeService->collect($request, $registrationEvent);

        $this->assertEquals('collected_data', $result);
    }

    /** @test */
    public function it_can_validate_login_event()
    {
        $dataDomeMock = $this->createMock(DataDome::class);

        $request = new Request();
        $account = "unittest@datadome.us";
        $loginEvent = new LoginEvent($account);

        $dataDomeMock->expects($this->once())
            ->method('validate')
            ->with($request, $loginEvent)
            ->willReturn(true);

        $dataDomeService = new DataDomeService($dataDomeMock);

        $result = $dataDomeService->validate($request, $loginEvent);

        $this->assertTrue($result);
    }

    /** @test */
    public function it_can_validate_registration_event()
    {
        $dataDomeMock = $this->createMock(DataDome::class);

        $request = new Request();
        $account = "unittest@datadome.us";
        $registrationStatus = StatusType::Succeeded;
        $session = new Session();
        $user = new User();
        $registrationEvent = new RegistrationEvent($account, $registrationStatus, $session, $user);

        $dataDomeMock->expects($this->once())
            ->method('validate')
            ->with($request, $registrationEvent)
            ->willReturn(true);

        $dataDomeService = new DataDomeService($dataDomeMock);

        $result = $dataDomeService->validate($request, $registrationEvent);

        $this->assertTrue($result);
    }
}
