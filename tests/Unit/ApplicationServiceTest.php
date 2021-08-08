<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Application;
use App\Models\ReadApproval;
use App\Models\User;
use App\Repositories\ReadApproval\ReadApprovalRepository;
use App\Services\ApplicationService;
use Tests\TestCase;

class ApplicationServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ApplicationService(
            new ReadApprovalRepository,
        );
    }

    public function testJustApprovedMethod(): void
    {
        // 適当なモデルデータをインスタンス化
        $application = new Application();

        $application->readApproval = collect(
            new ReadApproval([
                'application_id' => $application->id,
                'user_id' => $application->user_id,
            ])
        );

        // 申請中なのでfalse
        $application->status = 1;
        $inProgress = $this->service->justApproved($application);
        $this->assertFalse($inProgress);

        // 承認済みだが既読があるのでfalse
        $application->status = 2;
        $approved = $this->service->justApproved($application);
        $this->assertFalse($approved);

        // 拒否されているのでfalse
        $application->status = 3;
        $denied = $this->service->justApproved($application);
        $this->assertFalse($denied);

        // 承認済かつ既読なしなのでtrue
        $application->status = 2;
        $application->readApproval = collect();
        $justApproved = $this->service->justApproved($application);
        $this->assertTrue($justApproved);
    }

    public function testFetchApplicationsMethod(): void
    {
        // サンプルデータ投入
        $mentor = User::factory()->create();
        $mentees = User::factory(5)->create()
        ->each(function($mentee) use ($mentor) {
            $applications = Application::factory()->create([
                'mentor_id' => $mentor->id,
                'mentee_id' => $mentee->id,
                'status' => 1 // 申請中
            ]);
        }); 
        
        // メンターとしてfetch
        $applications = $this->service->fetchApplications($mentor);
        // 取得した申請の数はメンティーの数と一致する
        $this->assertTrue($applications->count() === $mentees->count());
    }
}
